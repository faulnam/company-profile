<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 shadow-sm border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 border-b-2 border-school pb-2 mb-6 uppercase">Kompetensi Keahlian (Jurusan)</h1>
                
                <div class="space-y-6">
                    @foreach($majors as $major)
                    <div class="flex flex-col md:flex-row bg-gray-50 border border-gray-200 rounded overflow-hidden">
                        <div class="md:w-1/3">
                            <img src="{{ $major->image }}" alt="{{ $major->name }}" class="w-full h-48 md:h-full object-cover">
                        </div>
                        <div class="p-5 md:w-2/3 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-school text-white text-[10px] font-bold px-2 py-1 uppercase rounded">{{ $major->acronym }}</span>
                                <h2 class="text-lg font-bold text-gray-900">{{ $major->name }}</h2>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ $major->description }}</p>
                            @if($major->head_of_major)
                            <div class="text-xs text-gray-500 font-medium border-t border-gray-200 pt-3">
                                <i class="fa-solid fa-user-tie mr-1"></i> Kepala Program: <span class="text-gray-800">{{ $major->head_of_major }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
