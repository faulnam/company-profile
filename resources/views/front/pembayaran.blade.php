<x-public-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 sm:p-12">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                            <i class="fa-solid fa-file-invoice-dollar text-2xl text-green-600"></i>
                        </div>
                        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pembayaran Formulir PPDB</h1>
                        <p class="text-gray-500 mt-2">Selesaikan pembayaran untuk mengonfirmasi pendaftaran Anda.</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Calon Siswa</p>
                            <p class="text-lg font-bold text-gray-900">{{ $registration->name }}</p>
                            <p class="text-sm text-gray-600">{{ $registration->origin_school }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 font-medium">Total Tagihan</p>
                            <p class="text-2xl font-black text-school">Rp 250.000</p>
                        </div>
                    </div>

                    <form action="{{ route('ppdb.process_pembayaran', $registration->id) }}" method="POST">
                        @csrf
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Pilih Metode Pembayaran</h2>
                        
                        <div class="space-y-4 mb-8">
                            <!-- QRIS -->
                            <label class="relative block cursor-pointer border border-gray-200 rounded-xl p-4 hover:border-school hover:bg-blue-50/30 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="QRIS" class="h-4 w-4 text-school focus:ring-school border-gray-300" required>
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold text-gray-900">QRIS (Semua e-Wallet & M-Banking)</span>
                                            <span class="block text-xs text-gray-500">Scan QR Code instan</span>
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" class="h-6">
                                </div>
                            </label>

                            <!-- BCA VA -->
                            <label class="relative block cursor-pointer border border-gray-200 rounded-xl p-4 hover:border-school hover:bg-blue-50/30 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="BCA Virtual Account" class="h-4 w-4 text-school focus:ring-school border-gray-300">
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold text-gray-900">BCA Virtual Account</span>
                                            <span class="block text-xs text-gray-500">Bayar via m-BCA atau ATM</span>
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="h-6">
                                </div>
                            </label>

                            <!-- Mandiri VA -->
                            <label class="relative block cursor-pointer border border-gray-200 rounded-xl p-4 hover:border-school hover:bg-blue-50/30 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="Mandiri Virtual Account" class="h-4 w-4 text-school focus:ring-school border-gray-300">
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold text-gray-900">Mandiri Virtual Account</span>
                                            <span class="block text-xs text-gray-500">Bayar via Livin' by Mandiri</span>
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-6">
                                </div>
                            </label>

                            <!-- GoPay -->
                            <label class="relative block cursor-pointer border border-gray-200 rounded-xl p-4 hover:border-school hover:bg-blue-50/30 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="GoPay" class="h-4 w-4 text-school focus:ring-school border-gray-300">
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold text-gray-900">GoPay</span>
                                            <span class="block text-xs text-gray-500">Bayar langsung dari aplikasi Gojek</span>
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="GoPay" class="h-6">
                                </div>
                            </label>

                            <!-- Indomaret -->
                            <label class="relative block cursor-pointer border border-gray-200 rounded-xl p-4 hover:border-school hover:bg-blue-50/30 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="Indomaret" class="h-4 w-4 text-school focus:ring-school border-gray-300">
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold text-gray-900">Gerai Indomaret</span>
                                            <span class="block text-xs text-gray-500">Tunjukkan kode bayar ke kasir</span>
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" alt="Indomaret" class="h-6 object-contain">
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:-translate-y-1">
                            Bayar Sekarang <i class="fa-solid fa-check ml-2 mt-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
