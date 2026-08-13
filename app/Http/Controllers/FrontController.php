<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function pendaftaran()
    {
        $majors = \App\Models\Major::all();
        return view('front.pendaftaran', compact('majors'));
    }

    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'origin_school' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'parent_name' => 'required|string|max:255',
            'parent_email' => 'required|email|unique:users,email', // Email cannot be in users table yet
            'parent_password' => 'required|string|min:6',
            'major_id' => 'required|exists:majors,id',
        ]);

        $registration = Registration::create([
            'name' => $request->name,
            'origin_school' => $request->origin_school,
            'phone' => $request->phone,
            'parent_name' => $request->parent_name,
            'parent_email' => $request->parent_email,
            'parent_password' => Hash::make($request->parent_password), // Hash it immediately for security
            'major_id' => $request->major_id,
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);

        return redirect()->route('ppdb.pembayaran', $registration->id);
    }

    public function pembayaran($id)
    {
        $registration = Registration::findOrFail($id);
        if ($registration->payment_status == 'Paid') {
            return redirect()->route('ppdb.berhasil');
        }
        return view('front.pembayaran', compact('registration'));
    }

    public function processPembayaran(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->update([
            'payment_status' => 'Paid',
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('ppdb.test', $id)->with('success', 'Pembayaran berhasil dikonfirmasi. Silakan kerjakan tes berikut.');
    }

    public function showTest($id)
    {
        $registration = Registration::findOrFail($id);
        
        // Cek jika sudah tes
        if ($registration->test_score !== null) {
            return redirect()->route('ppdb.berhasil')->with('success', 'Anda sudah mengerjakan tes.');
        }

        // Ambil maksimal 10 soal acak
        $questions = \App\Models\TestQuestion::inRandomOrder()->take(10)->get();
        
        return view('front.test', compact('registration', 'questions'));
    }

    public function submitTest(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        if ($registration->test_score !== null) {
            return redirect()->route('ppdb.berhasil')->with('error', 'Anda sudah mengerjakan tes.');
        }

        $answers = $request->input('answers', []);
        $questions = \App\Models\TestQuestion::whereIn('id', array_keys($answers))->get();
        
        $correctCount = 0;
        $totalQuestions = $questions->count();
        
        if ($totalQuestions > 0) {
            foreach ($questions as $question) {
                if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
                    $correctCount++;
                }
            }
            $score = ($correctCount / $totalQuestions) * 100;
        } else {
            $score = 0; // Jika tidak ada soal
        }

        $registration->update([
            'test_score' => $score
        ]);

        return redirect()->route('ppdb.berhasil')->with('success', 'Tes berhasil disubmit. Data Anda sedang diproses oleh Tata Usaha.');
    }

    public function berhasil()
    {
        return view('front.berhasil');
    }
}
