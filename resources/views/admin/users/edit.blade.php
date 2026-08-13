<x-admin-layout>
    @section('header', 'Edit Pengguna')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Pengguna</h2>
            <p class="text-xs text-gray-500 mt-1">Gunakan form ini untuk mengupdate akun login.</p>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('name', $user->name) }}" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('email', $user->email) }}" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                    <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" minlength="8">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Peran (Role)</label>
                    <select name="role" id="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" required>
                        <option value="">Pilih Peran...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>{{ strtoupper($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Update Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
