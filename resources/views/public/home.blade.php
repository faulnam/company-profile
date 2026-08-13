<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content (Berita) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Hero Section Slider -->
            @if($heroSlides->count() > 0)
                <div x-data="{ currentSlide: 0, slides: {{ $heroSlides->count() }}, autoPlay: null }" 
                     x-init="autoPlay = setInterval(() => { currentSlide = (currentSlide + 1) % slides }, 5000)"
                     @mouseenter="clearInterval(autoPlay)"
                     @mouseleave="autoPlay = setInterval(() => { currentSlide = (currentSlide + 1) % slides }, 5000)"
                     class="relative w-full overflow-hidden mb-8 group">
                     
                    <!-- Slides Container -->
                    <div class="flex transition-transform duration-700 ease-in-out h-full" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                        @foreach($heroSlides as $slide)
                            @php
                                $main = $slide->first();
                                $small = $slide->skip(1)->take(2);
                            @endphp
                            <div class="w-full flex-shrink-0">
                                <x-hero.grid :main="$main" :small="$small" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Slide Controls -->
                    <div class="absolute bottom-4 right-4 flex space-x-2 z-20">
                        <template x-for="i in slides" :key="i">
                            <button @click="currentSlide = i - 1" 
                                    :class="{'bg-school w-6': currentSlide === i - 1, 'bg-white/50 hover:bg-white w-2': currentSlide !== i - 1}"
                                    class="h-2 rounded-full transition-all duration-300 shadow-sm"></button>
                        </template>
                    </div>
                </div>
            @endif
            
            <!-- News Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($recentNews as $post)
                    <x-news.card :post="$post" />
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center pt-4 pb-8 border-t border-gray-100 mt-6">
                {{ $recentNews->links('pagination::tailwind') }}
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
