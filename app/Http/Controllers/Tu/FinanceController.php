<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('student')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('student', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            if ($request->status == 'paid') {
                $query->where('is_paid', true);
            } elseif ($request->status == 'unpaid') {
                $query->where('is_paid', false);
            }
        }

        // Calculate totals for recap cards before pagination
        $totalPaid = (clone $query)->where('is_paid', true)->sum('amount');
        $totalUnpaid = (clone $query)->where('is_paid', false)->sum('amount');
        $totalAmount = (clone $query)->sum('amount');

        $invoices = $query->paginate(15)->withQueryString();
        return view('tu.finance.index', compact('invoices', 'totalPaid', 'totalUnpaid', 'totalAmount'));
    }

    public function create()
    {
        $students = \App\Models\Student::all();
        $classrooms = \App\Models\Classroom::all();
        return view('tu.finance.create', compact('students', 'classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'billing_type' => 'required|in:per_student,per_class,all_classes',
            'student_id' => 'required_if:billing_type,per_student',
            'classroom_id' => 'required_if:billing_type,per_class',
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $isPaid = $request->has('is_paid') ? true : false;
            $title = $request->title;
            $amount = $request->amount;
            $dueDate = $request->due_date;

            if ($request->billing_type == 'per_student') {
                Invoice::create([
                    'student_id' => $request->student_id,
                    'title' => $title,
                    'amount' => $amount,
                    'due_date' => $dueDate,
                    'is_paid' => $isPaid,
                ]);
            } else {
                $students = [];
                if ($request->billing_type == 'per_class') {
                    $students = \App\Models\Student::where('classroom_id', $request->classroom_id)->get();
                } else if ($request->billing_type == 'all_classes') {
                    $students = \App\Models\Student::all();
                }

                $invoicesToInsert = [];
                foreach ($students as $student) {
                    $invoicesToInsert[] = [
                        'student_id' => $student->id,
                        'title' => $title,
                        'amount' => $amount,
                        'due_date' => $dueDate,
                        'is_paid' => $isPaid,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if (!empty($invoicesToInsert)) {
                    Invoice::insert($invoicesToInsert);
                }

                // Buat pengumuman otomatis
                $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');
                $dueDateText = $dueDate ? \Carbon\Carbon::parse($dueDate)->format('d F Y') : 'sesegera mungkin';
                $content = "Telah diterbitkan tagihan baru sebesar **{$formattedAmount}** untuk **{$title}**. Harap segera melakukan pembayaran sebelum **{$dueDateText}**.";
                
                \App\Models\Announcement::create([
                    'title' => "Informasi Tagihan Baru: $title",
                    'content' => $content,
                    'is_active' => true,
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->route('tu.finance.index')->with('success', 'Tagihan berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses tagihan massal: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Invoice $finance)
    {
        $students = \App\Models\Student::all();
        return view('tu.finance.edit', ['invoice' => $finance, 'students' => $students]);
    }

    public function update(Request $request, Invoice $finance)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_paid'] = $request->has('is_paid') ? true : false;

        $finance->update($data);
        return redirect()->route('tu.finance.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy(Invoice $finance)
    {
        $finance->delete();
        return redirect()->route('tu.finance.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}
