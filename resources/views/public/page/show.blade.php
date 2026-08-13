<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content (Page Show) -->
        <div class="lg:col-span-2 space-y-6">
            <article class="bg-white p-6 md:p-8 shadow-sm border border-gray-100">
                <header class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 border-l-4 border-school pl-4 mb-2 uppercase">{{ $page->title }}</h1>
                </header>

                @if($page->image)
                <div class="mb-6 w-full max-h-[400px] overflow-hidden rounded">
                    <img src="{{ $page->image }}" alt="{{ $page->title }}" class="w-full h-auto object-cover">
                </div>
                @endif

                <!-- Content -->
                <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed text-justify">
                    {!! $page->content !!}
                </div>
            </article>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
