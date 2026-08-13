<div class="bg-school shadow" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-0 items-center w-full relative">
                <a href="{{ route('home') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->routeIs('home') ? 'bg-school-dark' : 'hover:bg-school-dark' }}"><i class="fa-solid fa-home text-sm"></i></a>
                
                <a href="{{ route('home') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->routeIs('home') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->routeIs('profil') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Profil</a>
                <a href="{{ route('page', 'kurikulum') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->is('halaman/kurikulum') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Kurikulum</a>
                <a href="{{ route('page', 'program-sekolah') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->is('halaman/program-sekolah') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Program Sekolah</a>
                <a href="{{ route('gtk') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->routeIs('gtk') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">GTK</a>
                <a href="{{ route('berita.index') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->routeIs('berita.*') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Berita</a>
                
                <!-- Dropdown Jurusan -->
                <div class="relative group h-full" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="text-white group-hover:bg-school-dark px-3 py-3 text-[11px] font-bold uppercase flex items-center h-full transition {{ request()->routeIs('jurusan') ? 'bg-school-dark' : '' }}" @click="window.location='{{ route('jurusan') }}'">
                        Jurusan <i class="fa-solid fa-chevron-down ml-1 text-[9px]"></i>
                    </button>
                    <div x-show="open" x-transition.opacity class="absolute z-50 left-0 w-56 bg-white shadow-lg border-t-2 border-school py-2" style="display: none;">
                        <a href="#" class="block px-4 py-2 text-xs font-semibold text-gray-700 hover:text-school hover:bg-gray-50 border-b border-gray-100">Teknik Elektronika</a>
                        <a href="#" class="block px-4 py-2 text-xs font-semibold text-gray-700 hover:text-school hover:bg-gray-50 border-b border-gray-100">Teknik Ketenagalistrikan</a>
                        <a href="#" class="block px-4 py-2 text-xs font-semibold text-gray-700 hover:text-school hover:bg-gray-50 border-b border-gray-100">Teknik Mesin</a>
                        <a href="#" class="block px-4 py-2 text-xs font-semibold text-gray-700 hover:text-school hover:bg-gray-50 border-b border-gray-100">Teknik Otomotif</a>
                    </div>
                </div>

                <a href="{{ route('page', 'kesiswaan') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->is('halaman/kesiswaan') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Kesiswaan</a>
                <a href="{{ route('page', 'fitur') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->is('halaman/fitur') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Fitur</a>
                <a href="{{ route('page', 'kontak') }}" class="text-white px-3 py-3 text-[11px] font-bold uppercase transition h-full flex items-center {{ request()->is('halaman/kontak') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">Kontak</a>

                <!-- Search Icon right aligned -->
                <a href="{{ route('search') }}" class="text-white px-4 py-3 text-sm ml-auto h-full flex items-center transition {{ request()->routeIs('search') ? 'bg-school-dark' : 'hover:bg-school-dark' }}">
                    <i class="fa-solid fa-search"></i>
                </a>
            </nav>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden w-full justify-between h-full">
                <span class="text-white font-bold heading-font">MENU</span>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-gray-200 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="md:hidden bg-school-dark border-t border-school-darker" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->routeIs('home') ? 'bg-school' : 'hover:bg-school' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->routeIs('profil') ? 'bg-school' : 'hover:bg-school' }}">Profil</a>
            <a href="{{ route('page', 'kurikulum') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->is('halaman/kurikulum') ? 'bg-school' : 'hover:bg-school' }}">Kurikulum</a>
            <a href="{{ route('jurusan') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->routeIs('jurusan') ? 'bg-school' : 'hover:bg-school' }}">Jurusan</a>
            <a href="{{ route('gtk') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->routeIs('gtk') ? 'bg-school' : 'hover:bg-school' }}">GTK</a>
            <a href="{{ route('page', 'kesiswaan') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-white {{ request()->is('halaman/kesiswaan') ? 'bg-school' : 'hover:bg-school' }}">Kesiswaan</a>
        </div>
    </div>
</div>

<!-- Secondary Menu Bar -->
<div class="bg-[#0f766e] shadow-sm hidden md:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-6 h-8 items-center text-[10px] text-gray-200 uppercase font-semibold">
            <a href="#" class="hover:text-white transition"><i class="fa-solid fa-angle-right text-[8px] mr-1"></i> Beasiswa</a>
            <a href="#" class="hover:text-white transition"><i class="fa-solid fa-angle-right text-[8px] mr-1"></i> BKK SMK</a>
            <a href="#" class="hover:text-white transition"><i class="fa-solid fa-angle-right text-[8px] mr-1"></i> Dapodik</a>
            <a href="#" class="hover:text-white transition"><i class="fa-solid fa-angle-right text-[8px] mr-1"></i> E-Rapor</a>
            <a href="#" class="hover:text-white transition"><i class="fa-solid fa-angle-right text-[8px] mr-1"></i> JDIH Kemdikbud</a>
        </div>
    </div>
</div>
