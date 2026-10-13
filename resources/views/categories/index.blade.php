<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Kategori (Admin)</h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md">+ Kategori</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-md shadow divide-y">
                @forelse ($categories as $cat)
                    <div class="p-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $cat->name }}</p>
                            <p class="text-sm text-gray-500">{{ $cat->products_count }} produk</p>
                        </div>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 text-sm hover:underline">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="p-4 text-gray-500">Belum ada kategori.</p>
                @endforelse
            </div>

            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
