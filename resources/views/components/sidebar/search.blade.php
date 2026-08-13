<div class="bg-white border border-gray-200">
    <h3 class="bg-[#0f766e] text-white text-sm font-bold px-4 py-2 uppercase tracking-wider border-l-4 border-[#14b8a6]">Pencarian</h3>
    <div class="p-4 bg-gray-50">
        <form action="{{ route('search') }}" method="GET" class="relative">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
            <button type="submit" class="absolute right-0 top-0 bottom-0 px-3 text-gray-500 hover:text-school flex items-center justify-center">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>
</div>
