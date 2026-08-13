@props(['main', 'small'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-1">
    <!-- Highlight Big -->
    @if($main)
    <div class="md:col-span-2 relative h-[380px] group overflow-hidden bg-gray-900">
        <img src="{{ $main->image }}" alt="{{ $main->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-6 w-full">
            @if($main->categories->count() > 0)
            <span style="background-color: {{ $main->categories->first()->color }}" class="text-white text-[10px] font-bold uppercase px-2 py-1 mb-3 inline-block">{{ $main->categories->first()->name }}</span>
            @endif
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight hover:text-gray-300 transition">
                <a href="{{ route('berita.show', $main->slug) }}">{{ $main->title }}</a>
            </h2>
            <div class="text-gray-300 text-xs flex items-center font-medium">
                <i class="fa-regular fa-user mr-1.5"></i> {{ $main->author->name ?? 'Admin' }} 
                <span class="mx-3 text-gray-500">|</span> 
                <i class="fa-regular fa-clock mr-1.5"></i> {{ $main->created_at->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>
    @endif

    <!-- 2 Small Grids Vertical -->
    <div class="grid grid-rows-2 gap-1 h-[380px]">
        @foreach($small as $post)
        <div class="relative group overflow-hidden bg-gray-900 h-full">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4 w-full">
                @if($post->categories->count() > 0)
                <span style="background-color: {{ $post->categories->first()->color }}" class="text-white text-[9px] font-bold uppercase px-1.5 py-0.5 mb-2 inline-block">{{ $post->categories->first()->name }}</span>
                @endif
                <h3 class="text-sm font-bold text-white leading-snug hover:text-school-light transition">
                    <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>
            </div>
        </div>
        @endforeach
    </div>
</div>
