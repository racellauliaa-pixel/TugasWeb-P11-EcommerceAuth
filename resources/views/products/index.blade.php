<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Katalog Produk</h2>
            @auth
                @if (auth()->user()->hasRole('admin', 'editor'))
                    <a href="{{ route('products.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                        + Produk Baru
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md">{{ session('success') }}</div>
            @endif

            <form method="GET" class="flex flex-wrap gap-3 bg-white p-4 rounded-md shadow">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..."
                       class="flex-1 min-w-[200px] border-gray-300 rounded-md shadow-sm">
                <select name="category" class="border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button class="px-4 py-2 bg-slate-800 text-white rounded-md">Filter</button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="h-40 w-full object-cover">
                        @else
                            <div class="h-40 w-full bg-slate-100 flex items-center justify-center text-slate-400">No Image</div>
                        @endif
                        <div class="p-4 flex-1 flex flex-col">
                            <span class="text-xs text-indigo-600 font-semibold">{{ $product->category->name }}</span>
                            <h3 class="font-semibold text-gray-800 mt-1">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">Stok: {{ $product->stock }} · dibuat oleh {{ $product->creator->name }}</p>
                            <div class="mt-auto pt-3 flex gap-2 text-sm">
                                <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:underline">Detail</a>
                                @can('update', $product)
                                    <a href="{{ route('products.edit', $product) }}" class="text-amber-600 hover:underline">Edit</a>
                                @endcan
                                @can('delete', $product)
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">Belum ada produk yang cocok.</p>
                @endforelse
            </div>

            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>