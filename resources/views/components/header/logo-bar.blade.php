<div class="relative py-8 overflow-hidden flex justify-center items-center">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="School Background" class="w-full h-full object-cover">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 text-center flex flex-col items-center max-w-7xl mx-auto w-full px-4">
        <!-- Logo -->
        <div class="w-20 h-20 bg-white rounded-full p-1 shadow-lg mb-2 flex items-center justify-center">
            <!-- Using a dummy logo placeholder -->
            <div class="w-full h-full border-2 border-school rounded-full flex items-center justify-center text-school font-bold text-2xl heading-font">
                S1
            </div>
        </div>
        
        <h1 class="heading-font text-3xl md:text-4xl font-bold text-white tracking-wide shadow-black drop-shadow-md">{{ $global_settings['school_name'] ?? 'SMK Negeri' }}</h1>
        <p class="text-sm md:text-base text-gray-200 mt-1 font-medium tracking-widest uppercase shadow-black drop-shadow-md">Tiada Hari Tanpa Prestasi</p>
    </div>
</div>
