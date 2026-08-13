<x-public-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 sm:p-12">
                    <div class="text-center mb-10">
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Pendaftaran Siswa Baru (PPDB)</h1>
                        <p class="text-lg text-gray-600">Lengkapi formulir di bawah ini untuk mendaftarkan putra/putri Anda.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pengisian:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('ppdb.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <!-- Data Calon Siswa -->
                        <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fa-solid fa-user-graduate text-school mr-3"></i> Data Calon Siswa
                            </h2>
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Siswa</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="focus:ring-school focus:border-school block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="Masukkan nama lengkap siswa">
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="origin_school" class="block text-sm font-medium text-gray-700">Asal Sekolah (SMP/MTs)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-school text-gray-400"></i>
                                        </div>
                                        <input type="text" name="origin_school" id="origin_school" value="{{ old('origin_school') }}" required class="focus:ring-school focus:border-school block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="Misal: SMPN 1 Jakarta">
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor WA/HP Siswa</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-phone text-gray-400"></i>
                                        </div>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="focus:ring-school focus:border-school block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="sm:col-span-2 mt-4">
                                    <label for="major_id" class="block text-sm font-medium text-gray-700">Pilih Jurusan yang Diminati</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-laptop-code text-gray-400"></i>
                                        </div>
                                        <select name="major_id" id="major_id" required class="focus:ring-school focus:border-school block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3 appearance-none bg-white">
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach($majors as $major)
                                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Orang Tua / Wali -->
                        <div class="bg-green-50/50 p-6 rounded-xl border border-green-100">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fa-solid fa-users text-green-600 mr-3"></i> Data Orang Tua / Wali
                            </h2>
                            <p class="text-sm text-gray-500 mb-6">Data ini akan digunakan untuk membuat akun Portal Wali Murid Anda.</p>
                            
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Lengkap Orang Tua/Wali</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-user-tie text-gray-400"></i>
                                        </div>
                                        <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name') }}" required class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="Masukkan nama lengkap Ayah/Ibu/Wali">
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="parent_email" class="block text-sm font-medium text-gray-700">Alamat Email (Untuk Login)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="parent_email" id="parent_email" value="{{ old('parent_email') }}" required class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="email@contoh.com">
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="parent_password" class="block text-sm font-medium text-gray-700">Buat Password (Untuk Login)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" name="parent_password" id="parent_password" required minlength="6" class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-3" placeholder="Minimal 6 karakter">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-school hover:bg-school-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-school transition-all transform hover:-translate-y-1">
                                Lanjutkan ke Pembayaran Formulir <i class="fa-solid fa-arrow-right ml-2 mt-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
