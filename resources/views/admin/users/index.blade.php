<x-admin-layout>
    @section('header', 'Manajemen Pengguna')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Pengguna Sistem</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Pengguna
            </a>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="role" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Peran</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="tu" {{ request('role') == 'tu' ? 'selected' : '' }}>Tata Usaha</option>
                    <option value="walikelas" {{ request('role') == 'walikelas' ? 'selected' : '' }}>Guru / Wali Kelas</option>
                    <option value="walimurid" {{ request('role') == 'walimurid' ? 'selected' : '' }}>Wali Murid</option>
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Peran (Role)</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            @foreach($user->roles as $role)
                                <span class="inline-block bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded border border-blue-200 uppercase font-bold tracking-wide">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 p-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.users.reset_password', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Reset password untuk {{ $user->name }} menjadi password123?');">
                                    @csrf
                                    <button type="submit" class="text-yellow-500 hover:text-yellow-700 p-1" title="Reset Password">
                                        <i class="fa-solid fa-key"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Data pengguna tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
