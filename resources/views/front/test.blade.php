@extends('layouts.public')

@section('title', 'Tes Online PPDB')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-school p-6 md:p-8 text-white">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Tes Online PPDB</h1>
                <p class="text-school-100">Silakan kerjakan soal-soal berikut. Waktu dan kesempatan Anda terbatas.</p>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('ppdb.test.submit', $registration->id) }}" method="POST">
                    @csrf
                    
                    @if($questions->isEmpty())
                        <div class="bg-yellow-50 text-yellow-800 p-4 rounded-lg mb-6">
                            Belum ada soal tes yang tersedia. Anda dapat langsung menyimpan dan menyelesaikan proses.
                        </div>
                    @else
                        @foreach($questions as $index => $q)
                        <div class="mb-8 border-b border-gray-100 pb-6 last:border-0">
                            <h3 class="font-bold text-gray-800 mb-4">{{ $index + 1 }}. {{ $q->question }}</h3>
                            
                            <div class="space-y-3">
                                <label class="flex items-start p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="A" class="mt-1 text-school focus:ring-school" required>
                                    <span class="ml-3 text-gray-700"><strong>A.</strong> {{ $q->option_a }}</span>
                                </label>
                                <label class="flex items-start p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="B" class="mt-1 text-school focus:ring-school" required>
                                    <span class="ml-3 text-gray-700"><strong>B.</strong> {{ $q->option_b }}</span>
                                </label>
                                <label class="flex items-start p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="C" class="mt-1 text-school focus:ring-school" required>
                                    <span class="ml-3 text-gray-700"><strong>C.</strong> {{ $q->option_c }}</span>
                                </label>
                                <label class="flex items-start p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="D" class="mt-1 text-school focus:ring-school" required>
                                    <span class="ml-3 text-gray-700"><strong>D.</strong> {{ $q->option_d }}</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-school hover:bg-school-dark text-white px-8 py-3 rounded-lg font-bold shadow-md transition-all flex items-center" onclick="return confirm('Apakah Anda yakin sudah selesai mengerjakan?');">
                            <span>Selesai & Kirim Jawaban</span>
                            <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
