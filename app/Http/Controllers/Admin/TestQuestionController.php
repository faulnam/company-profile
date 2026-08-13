<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestQuestion;

class TestQuestionController extends Controller
{
    public function index()
    {
        $questions = TestQuestion::latest()->paginate(10);
        return view('admin.test-questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.test-questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        TestQuestion::create($request->all());
        return redirect()->route('admin.test-questions.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(TestQuestion $testQuestion)
    {
        return view('admin.test-questions.edit', compact('testQuestion'));
    }

    public function update(Request $request, TestQuestion $testQuestion)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $testQuestion->update($request->all());
        return redirect()->route('admin.test-questions.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(TestQuestion $testQuestion)
    {
        $testQuestion->delete();
        return redirect()->route('admin.test-questions.index')->with('success', 'Soal berhasil dihapus.');
    }
}
