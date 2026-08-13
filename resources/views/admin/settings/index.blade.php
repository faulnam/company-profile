<x-admin-layout>
    @section('header', 'Informasi Sekolah')

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Pengaturan Profil</h2>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-6 mt-4 rounded-r">
            <div class="flex items-center text-green-700 text-sm">
                <i class="fa-solid fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="p-6">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Detail Utama</h3>
                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                        <input type="text" name="school_name" value="{{ $settings['school_name'] ?? '' }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="school_address" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition">{{ $settings['school_address'] ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="school_phone" value="{{ $settings['school_phone'] ?? '' }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Resmi</label>
                            <input type="email" name="school_email" value="{{ $settings['school_email'] ?? '' }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition">
                        </div>
                    </div>
                </div>

                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Sosial Media</h3>
                <div class="space-y-4 mb-8">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 w-12 h-10">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/..." class="flex-1 rounded-none rounded-r-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition h-10">
                    </div>

                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 w-12 h-10">
                            <i class="fa-brands fa-instagram"></i>
                        </span>
                        <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/..." class="flex-1 rounded-none rounded-r-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition h-10">
                    </div>

                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 w-12 h-10">
                            <i class="fa-brands fa-youtube"></i>
                        </span>
                        <input type="url" name="social_youtube" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/..." class="flex-1 rounded-none rounded-r-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition h-10">
                    </div>
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2 text-sm font-bold text-white bg-gray-900 rounded-lg hover:bg-gray-800 shadow transition flex items-center">
                        <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
