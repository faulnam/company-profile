<x-public-layout>
    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-lg w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 text-center p-10">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-100 mb-6">
                    <i class="fa-solid fa-check-circle text-5xl text-green-500"></i>
                </div>
                
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-4">Pendaftaran Berhasil!</h1>
                <p class="text-gray-600 mb-8">
                    Terima kasih, pembayaran formulir PPDB Anda telah kami terima. Data pendaftaran sedang diverifikasi oleh tim Tata Usaha kami.
                </p>

                <div class="bg-blue-50 rounded-xl p-6 text-left mb-8 border border-blue-100">
                    <h3 class="font-bold text-blue-900 mb-2">Langkah Selanjutnya:</h3>
                    <ul class="text-sm text-blue-800 space-y-2 list-disc list-inside">
                        <li>Menunggu persetujuan (penerimaan) dari pihak sekolah.</li>
                        <li>Jika diterima, Anda dapat menggunakan Email dan Password yang didaftarkan tadi untuk Login ke <strong>Portal Wali Murid</strong>.</li>
                        <li>Informasi kelulusan akan diumumkan melalui portal sekolah.</li>
                    </ul>
                </div>

                <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-school bg-blue-50 hover:bg-blue-100 transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-public-layout>
