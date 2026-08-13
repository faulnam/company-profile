<aside class="fixed inset-y-0 left-0 z-50 w-56 bg-white border-r border-gray-200 shadow-[2px_0_10px_-5px_rgba(0,0,0,0.1)] transition-transform duration-300 md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center text-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-900 rounded-full flex items-center justify-center text-white text-xs font-bold">
                    NP
                </div>
                <span class="text-lg font-bold text-gray-800">Admin Panel</span>
            </div>
            <span class="text-[10px] text-gray-500 mt-1">Sistem Informasi Sekolah</span>
        </a>
    </div>

    <!-- Nav Links -->
    <nav class="py-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)] custom-scrollbar">
        
        <div class="px-4 mb-2 mt-2">
            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">MAIN MENU</p>
        </div>

        <!-- DASHBOARD LINK DYNAMIC BASED ON ROLE -->
        @php
            $dashboardRoute = 'dashboard';
            if (auth()->user()->hasRole('admin')) $dashboardRoute = 'admin.dashboard';
            elseif (auth()->user()->hasRole('tu')) $dashboardRoute = 'tu.dashboard';
            elseif (auth()->user()->hasRole('walikelas')) $dashboardRoute = 'guru.dashboard';
            elseif (auth()->user()->hasRole('walimurid')) $dashboardRoute = 'wali.dashboard';
        @endphp
        <a href="{{ route($dashboardRoute) }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs($dashboardRoute) ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
            <i class="fa-solid fa-border-all w-6 text-center text-[15px] {{ request()->routeIs($dashboardRoute) ? 'text-gray-900' : 'text-gray-400' }}"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- ADMIN ONLY MENUS -->
        @if(auth()->user()->hasRole('admin'))
        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">MANAGE</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('admin.announcements.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.announcements.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-bullhorn w-6 text-center text-[15px] {{ request()->routeIs('admin.announcements.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Pengumuman</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.posts.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-regular fa-newspaper w-6 text-center text-[15px] {{ request()->routeIs('admin.posts.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Berita</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.categories.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-list-ul w-6 text-center text-[15px] {{ request()->routeIs('admin.categories.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Kategori Berita</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.pages.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-regular fa-file-lines w-6 text-center text-[15px] {{ request()->routeIs('admin.pages.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Halaman Statis</span>
                </a>

                <a href="{{ route('admin.teachers.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.teachers.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-user-group w-6 text-center text-[15px] {{ request()->routeIs('admin.teachers.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Guru & Staff</span>
                </a>

                <a href="{{ route('admin.majors.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.majors.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-graduation-cap w-6 text-center text-[15px] {{ request()->routeIs('admin.majors.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Jurusan</span>
                </a>

                <a href="{{ route('admin.test-questions.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.test-questions.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-clipboard-question w-6 text-center text-[15px] {{ request()->routeIs('admin.test-questions.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Soal PPDB</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: true }">
            <div @click="open = !open" class="pt-4 pb-2 px-4 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">MASTER DATA AKADEMIK</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('admin.academic-years.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.academic-years.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-calendar-check w-6 text-center text-[15px] {{ request()->routeIs('admin.academic-years.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Tahun Ajaran</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.users.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-users-gear w-6 text-center text-[15px] {{ request()->routeIs('admin.users.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Manajemen Pengguna</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: true }">
            <div @click="open = !open" class="pt-4 pb-2 px-4 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">Pengaturan</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('admin.settings.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-gear w-6 text-center text-[15px] {{ request()->routeIs('admin.settings.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Informasi Sekolah</span>
                </a>
            </div>
        </div>
        @endif

        <!-- TU ONLY MENUS -->
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('tu'))
        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">AKADEMIK & KEUANGAN</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('tu.ppdb.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.ppdb.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-user-plus w-6 text-center text-[15px] {{ request()->routeIs('tu.ppdb.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">PPDB Baru</span>
                </a>

                <a href="{{ route('tu.students.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.students.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-users w-6 text-center text-[15px] {{ request()->routeIs('tu.students.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Data Siswa</span>
                </a>

                <a href="{{ route('tu.parents.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.parents.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-user-tie w-6 text-center text-[15px] {{ request()->routeIs('tu.parents.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Data Wali Murid</span>
                </a>

                <a href="{{ route('tu.classrooms.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.classrooms.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-chalkboard-user w-6 text-center text-[15px] {{ request()->routeIs('tu.classrooms.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Data Kelas</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">KURIKULUM & JADWAL</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('tu.subjects.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.subjects.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-book w-6 text-center text-[15px] {{ request()->routeIs('tu.subjects.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Mata Pelajaran</span>
                </a>

                <a href="{{ route('tu.schedules.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.schedules.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-regular fa-calendar-days w-6 text-center text-[15px] {{ request()->routeIs('tu.schedules.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Jadwal Pelajaran</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">ADMINISTRASI KEUANGAN</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('tu.finance.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('tu.finance.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-file-invoice-dollar w-6 text-center text-[15px] {{ request()->routeIs('tu.finance.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Keuangan SPP</span>
                </a>
            </div>
        </div>
        @endif

        <!-- GURU ONLY MENUS -->
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('walikelas'))
        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">TUGAS GURU</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('guru.schedules.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('guru.schedules.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-person-chalkboard w-6 text-center text-[15px] {{ request()->routeIs('guru.schedules.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Jadwal Mengajar</span>
                </a>

                <a href="{{ route('guru.absensi.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('guru.absensi.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-clipboard-user w-6 text-center text-[15px] {{ request()->routeIs('guru.absensi.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Absensi Siswa</span>
                </a>

                <a href="{{ route('guru.nilai.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('guru.nilai.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-award w-6 text-center text-[15px] {{ request()->routeIs('guru.nilai.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Input Nilai</span>
                </a>

                <a href="{{ route('guru.rapor.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('guru.rapor.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-file-pdf w-6 text-center text-[15px] {{ request()->routeIs('guru.rapor.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Cetak e-Rapor</span>
                </a>
            </div>
        </div>
        @endif

        <!-- WALI MURID ONLY MENUS -->
        @if(auth()->user()->hasRole('walimurid'))
        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">PENGUMUMAN & JADWAL</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('wali.announcements.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('wali.announcements.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-bullhorn w-6 text-center text-[15px] {{ request()->routeIs('wali.announcements.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Pengumuman</span>
                </a>

                <a href="{{ route('wali.schedules.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('wali.schedules.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-regular fa-calendar-days w-6 text-center text-[15px] {{ request()->routeIs('wali.schedules.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Jadwal Pelajaran</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: true }">
            <div @click="open = !open" class="px-4 mb-2 mt-6 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">AKADEMIK ANAK</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                <a href="{{ route('wali.tagihan.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('wali.tagihan.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-money-check-dollar w-6 text-center text-[15px] {{ request()->routeIs('wali.tagihan.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Tagihan & SPP</span>
                </a>

                <a href="{{ route('wali.absensi.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('wali.absensi.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-chart-line w-6 text-center text-[15px] {{ request()->routeIs('wali.absensi.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Kehadiran Siswa</span>
                </a>

                <a href="{{ route('wali.rapor.index') }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs('wali.rapor.*') ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-file-pdf w-6 text-center text-[15px] {{ request()->routeIs('wali.rapor.*') ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Download Rapor</span>
                </a>
            </div>
        </div>
        @endif

        <!-- ADMIN & TU MENUS -->
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('tu'))
        <div x-data="{ open: true }">
            <div @click="open = !open" class="pt-4 pb-2 px-4 flex justify-between items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                <p class="text-[10px] font-semibold uppercase tracking-wider">Komunikasi</p>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </div>

            <div x-show="open" x-collapse>
                @php
                    $liveChatRoute = auth()->user()->hasRole('admin') ? 'admin.live-chat' : 'tu.live-chat';
                @endphp
                <a href="{{ route($liveChatRoute) }}" class="flex items-center px-4 py-2.5 text-[13px] font-medium transition-colors border-l-4 {{ request()->routeIs($liveChatRoute) ? 'bg-[#e2e8f0] text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:bg-gray-50 hover:text-gray-700' }}">
                    <i class="fa-solid fa-comments w-6 text-center text-[15px] {{ request()->routeIs($liveChatRoute) ? 'text-gray-900' : 'text-gray-400' }}"></i>
                    <span class="ml-3">Live Chat</span>
                </a>
            </div>
        </div>
        @endif

        <div class="mt-8 pt-4 border-t border-gray-100">
            <a href="/" target="_blank" class="flex items-center px-4 py-2.5 text-[13px] font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square w-6 text-center text-[15px] text-gray-400"></i>
                <span class="ml-3">View Website</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full text-left px-4 py-2.5 text-[13px] font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fa-solid fa-right-from-bracket w-6 text-center text-[15px] text-gray-400"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
