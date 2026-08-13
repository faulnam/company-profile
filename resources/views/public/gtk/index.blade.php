<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 shadow-sm border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 border-b-2 border-school pb-2 mb-6 uppercase">Direktori Guru & Staff (GTK)</h1>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($teachers as $teacher)
                    <div class="bg-gray-50 border border-gray-200 rounded p-4 text-center hover:shadow-md transition">
                        <img src="{{ $teacher->photo }}" alt="{{ $teacher->name }}" class="w-24 h-24 rounded-full mx-auto mb-3 object-cover border-2 border-school">
                        <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $teacher->name }}</h3>
                        <p class="text-xs text-gray-500 mb-2">NIP. {{ $teacher->nip ?? '-' }}</p>
                        <span class="inline-block bg-school-light text-white text-[10px] font-bold px-2 py-1 rounded">{{ $teacher->position }}</span>
                        @if($teacher->subject)
                            <p class="text-[11px] text-gray-600 mt-2 font-medium">{{ $teacher->subject }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center pt-4 pb-8 border-t border-gray-100 mt-6">
                    {{ $teachers->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
