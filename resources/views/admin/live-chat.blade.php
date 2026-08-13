<x-admin-layout>
    @section('header', 'Live Chat')

    <div class="flex flex-col md:flex-row h-[calc(100vh-10rem)] bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Sidebar: Chat List -->
        <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col bg-gray-50/30">
            <!-- Search -->
            <div class="p-4 border-b border-gray-100 bg-white">
                <div class="relative">
                    <input type="text" placeholder="Cari percakapan..." class="w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- List -->
            <div class="flex-1 overflow-y-auto">
                <!-- Active Chat Item -->
                <div class="p-4 border-b border-gray-100 bg-blue-50/50 cursor-pointer border-l-4 border-l-gray-900 flex items-start space-x-3 transition">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold">
                            AF
                        </div>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="text-sm font-bold text-gray-900 truncate">Ahmad Fauzi (Orang Tua)</h4>
                            <span class="text-xs text-gray-500">10:42</span>
                        </div>
                        <p class="text-xs text-gray-600 truncate">Pak, apakah besok ada kegiatan pramuka?</p>
                    </div>
                </div>

                <!-- Inactive Chat Item 1 -->
                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer border-l-4 border-l-transparent flex items-start space-x-3 transition">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                            SB
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="text-sm font-medium text-gray-700 truncate">Siti Budiarti (Siswa)</h4>
                            <span class="text-xs text-gray-400">Kemarin</span>
                        </div>
                        <p class="text-xs text-gray-500 truncate">Terima kasih atas informasinya.</p>
                    </div>
                </div>
                
                <!-- Inactive Chat Item 2 -->
                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer border-l-4 border-l-transparent flex items-start space-x-3 transition">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold">
                            CN
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="text-sm font-medium text-gray-700 truncate">Calon Pendaftar Baru</h4>
                            <span class="text-xs text-gray-400">Senin</span>
                        </div>
                        <p class="text-xs text-gray-500 truncate">Mohon info syarat PPDB jalur prestasi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="w-full md:w-2/3 flex flex-col bg-white">
            
            <!-- Chat Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold">
                        AF
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Ahmad Fauzi (Orang Tua)</h3>
                        <p class="text-xs text-green-500 font-medium">Online</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition p-2 rounded-full hover:bg-gray-100">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-[#f8f9fa] custom-scrollbar">
                
                <div class="text-center">
                    <span class="text-xs text-gray-400 font-medium bg-white px-3 py-1 rounded-full border border-gray-200">Hari Ini</span>
                </div>

                <!-- Received Message -->
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs mr-3 flex-shrink-0 mt-1">
                        AF
                    </div>
                    <div class="bg-white border border-gray-200 p-3 rounded-2xl rounded-tl-none shadow-sm max-w-[75%]">
                        <p class="text-sm text-gray-800">Selamat pagi Bapak/Ibu Admin.</p>
                        <span class="text-[10px] text-gray-400 mt-1 block">10:40</span>
                    </div>
                </div>

                <!-- Received Message -->
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs mr-3 flex-shrink-0 mt-1">
                        AF
                    </div>
                    <div class="bg-white border border-gray-200 p-3 rounded-2xl rounded-tl-none shadow-sm max-w-[75%]">
                        <p class="text-sm text-gray-800">Pak, apakah besok ada kegiatan ekstrakurikuler pramuka wajib? Anak saya lupa jadwalnya.</p>
                        <span class="text-[10px] text-gray-400 mt-1 block">10:42</span>
                    </div>
                </div>
                
                <!-- Reply Box (Mockup) -->
                <div class="flex items-start flex-row-reverse mt-6">
                    <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-xs ml-3 flex-shrink-0 mt-1">
                        AD
                    </div>
                    <div class="bg-[#e2e8f0] p-3 rounded-2xl rounded-tr-none max-w-[75%] text-gray-800">
                        <p class="text-sm">Selamat pagi Bapak Ahmad. Ya benar, besok pramuka wajib tetap berjalan seperti biasa sepulang sekolah pukul 15.00 WIB.</p>
                        <div class="flex justify-end items-center mt-1 space-x-1">
                            <span class="text-[10px] text-gray-500">10:45</span>
                            <i class="fa-solid fa-check-double text-[10px] text-blue-500"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Chat Input Area -->
            <div class="p-4 bg-white border-t border-gray-100">
                <div class="flex items-end space-x-2">
                    <button class="p-2 text-gray-400 hover:text-gray-600 transition rounded-full hover:bg-gray-100">
                        <i class="fa-solid fa-paperclip"></i>
                    </button>
                    <div class="flex-1 relative">
                        <textarea rows="1" class="w-full rounded-2xl border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-20 transition text-sm py-3 pl-4 pr-12 resize-none custom-scrollbar" placeholder="Ketik pesan balasan..."></textarea>
                        <button class="absolute right-2 bottom-2 w-8 h-8 bg-gray-900 hover:bg-gray-800 text-white rounded-full flex items-center justify-center transition shadow">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
