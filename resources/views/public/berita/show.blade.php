<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content (Berita Show) -->
        <div class="lg:col-span-2 space-y-6">
            <article class="bg-white p-6 shadow-sm border border-gray-100">
                <!-- Header -->
                <header class="mb-6 border-b border-gray-200 pb-4">
                    <div class="flex gap-2 mb-3">
                        @foreach($post->categories as $category)
                            <span style="background-color: {{ $category->color }}" class="text-white text-xs font-bold uppercase px-2 py-1 rounded shadow-sm">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-4">
                        {{ $post->title }}
                    </h1>
                    <div class="flex flex-wrap items-center text-sm text-gray-500 gap-4">
                        <span><i class="fa-regular fa-user mr-1"></i> {{ $post->author->name ?? 'Admin' }}</span>
                        <span><i class="fa-regular fa-clock mr-1"></i> {{ $post->created_at->translatedFormat('l, d F Y') }}</span>
                        <span><i class="fa-regular fa-eye mr-1"></i> {{ $post->views }}x dibaca</span>
                    </div>
                </header>

                <!-- Featured Image -->
                @if($post->image)
                <div class="mb-6 w-full max-h-[500px] overflow-hidden">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                </div>
                @endif

                <!-- Content -->
                <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed">
                    {!! $post->content !!}
                </div>
            </article>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
