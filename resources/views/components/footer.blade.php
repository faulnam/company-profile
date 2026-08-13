<footer class="bg-gray-900 pt-16 pb-8 border-t-4 border-school">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- About -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-school rounded-full flex items-center justify-center text-white text-xl font-bold">
                        S1
                    </div>
                    <div>
                        <h2 class="heading-font text-2xl font-bold text-white leading-tight">{{ mb_strtoupper($global_settings['school_name'] ?? 'SEKOLAH KAMI') }}</h2>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    {{ $global_settings['school_name'] ?? 'Sekolah Kami' }} berkomitmen mencetak lulusan yang kompeten dan berkarakter.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-school hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-school hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-school hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-school hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-white font-bold uppercase tracking-wider mb-6 text-sm">Tautan Penting</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-school transition">Profil Sekolah</a></li>
                    <li><a href="#" class="hover:text-school transition">Data GTK (Guru & Staff)</a></li>
                    <li><a href="#" class="hover:text-school transition">Informasi Kelulusan</a></li>
                    <li><a href="#" class="hover:text-school transition">PPDB Tahun Ajaran Baru</a></li>
                    <li><a href="#" class="hover:text-school transition">BKK (Bursa Kerja Khusus)</a></li>
                </ul>
            </div>

            <!-- Jurusan -->
            <div>
                <h3 class="text-white font-bold uppercase tracking-wider mb-6 text-sm">Jurusan</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-school transition">Teknik Elektronika</a></li>
                    <li><a href="#" class="hover:text-school transition">Teknik Ketenagalistrikan</a></li>
                    <li><a href="#" class="hover:text-school transition">Teknik Mesin</a></li>
                    <li><a href="#" class="hover:text-school transition">Teknik Otomotif</a></li>
                    <li><a href="#" class="hover:text-school transition">Pengembangan Perangkat Lunak</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-bold uppercase tracking-wider mb-6 text-sm">Hubungi Kami</h3>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li class="flex items-start">
                        <div class="w-6 shrink-0">
                            <i class="fa-solid fa-location-dot text-blue-500 mt-1"></i>
                        </div>
                        <span>{{ $global_settings['school_address'] ?? 'Alamat Belum Diatur' }}</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 shrink-0">
                            <i class="fa-solid fa-phone text-blue-500 mt-1"></i>
                        </div>
                        <span>{{ $global_settings['school_phone'] ?? 'Telepon Belum Diatur' }}</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 shrink-0">
                            <i class="fa-solid fa-envelope text-blue-500 mt-1"></i>
                        </div>
                        <span>{{ $global_settings['school_email'] ?? 'Email Belum Diatur' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $global_settings['school_name'] ?? 'Sekolah Kami' }}. Hak Cipta Dilindungi.</p>
            <p class="text-gray-600 text-sm mt-2 md:mt-0">Dibuat dengan Laravel & Tailwind CSS.</p>
        </div>
    </div>
</footer>
