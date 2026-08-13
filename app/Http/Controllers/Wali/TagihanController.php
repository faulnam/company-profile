<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $query = Invoice::with('student')
                 ->whereHas('student', function($q) use ($userId) {
                     $q->where('parent_id', $userId);
                 })
                 ->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status == 'paid') {
                $query->where('is_paid', true);
            } elseif ($request->status == 'unpaid') {
                $query->where('is_paid', false);
            }
        }

        $invoices = $query->paginate(15)->withQueryString();
        return view('wali.tagihan.index', compact('invoices'));
    }

    public function pay(Invoice $invoice)
    {
        // Pastikan invoice ini milik anak wali murid yang login
        if ($invoice->student->parent_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $invoice->update(['is_paid' => true]);

        return redirect()->route('wali.tagihan.index')->with('success', 'Pembayaran berhasil dikonfirmasi secara simulasi.');
    }
}
