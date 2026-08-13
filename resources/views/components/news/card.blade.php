@props(['post'])

<article class="flex flex-col bg-white overflow-hidden group">
    <div class="relative h-44 w-full overflow-hidden mb-3">
        <a href="{{ route('berita.show', $post->slug) }}">
            <img src="{{ $post->image ?? 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </a>
    </div>
    <div class="flex-grow flex flex-col">
        <div class="flex gap-1 mb-2 flex-wrap">
            @foreach($post->categories->take(3) as $category)
                <span style="background-color: {{ $category->color }}" class="text-white text-[9px] font-bold uppercase px-1.5 py-0.5 rounded shadow-sm">{{ $category->name }}</span>
            @endforeach
        </div>
        <h3 class="text-[15px] font-bold text-gray-900 leading-tight mb-2 group-hover:text-school transition line-clamp-2">
            <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        <div class="text-[11px] text-gray-400 flex items-center mb-2">
            <span class="mr-3"><i class="fa-regular fa-user mr-1"></i> {{ $post->author->name ?? 'Admin' }}</span>
            <span><i class="fa-regular fa-clock mr-1"></i> {{ $post->created_at->translatedFormat('d F Y') }}</span>
        </div>
        <p class="text-xs text-gray-600 line-clamp-2">
            {{ Str::limit($post->excerpt, 100) }}
        </p>
    </div>
</article>
