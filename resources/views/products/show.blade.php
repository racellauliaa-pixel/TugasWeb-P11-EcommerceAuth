<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $product->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-md shadow p-6">
                @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="h-56 w-full object-cover rounded-md mb-4">
                @endif
                <span class="text-xs text-indigo-600 font-semibold">{{ $product->category->name }}</span>
                <h1 class="text-2xl font-bold mt-1">{{ $product->name }}</h1>
                <p class="text-lg text-gray-700 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Stok: {{ $product->stock }} · dibuat oleh {{ $product->creator->name }}</p>
                <p class="mt-4 text-gray-700">{{ $product->description }}</p>

                <div class="mt-4 flex gap-2 text-sm">
                    @can('update', $product)
                        <a href="{{ route('products.edit', $product) }}" class="px-3 py-1.5 bg-amber-500 text-white rounded-md">Edit</a>
                    @endcan
                    @can('delete', $product)
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-600 text-white rounded-md">Hapus</button>
                        </form>
                    @endcan
                    <a href="{{ route('products.index') }}" class="px-3 py-1.5 bg-slate-200 rounded-md">Kembali</a>
                </div>
            </div>

            <div class="bg-white rounded-md shadow p-6">
                <h3 class="font-semibold mb-3">Review ({{ $product->reviews->count() }})</h3>
                @forelse ($product->reviews as $review)
                    <div class="border-b py-2 last:border-0">
                        <p class="text-sm font-medium">{{ $review->user->name }} — {{ $review->rating }}/5</p>
                        <p class="text-sm text-gray-600">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada review.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>