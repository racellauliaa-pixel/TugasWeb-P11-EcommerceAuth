<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kategori</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('categories.store') }}" class="bg-white p-6 rounded-md shadow space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md">
                    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-slate-200 rounded-md">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
