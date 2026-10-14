@csrf

<div class="mb-5">
    <label class="block text-xs font-bold tracking-widest mb-2">NAMA</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-xs font-bold tracking-widest mb-2">DESKRIPSI</label>
    <textarea name="description" rows="3"
              class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-xs font-bold tracking-widest mb-2">HARGA</label>
    <input type="number" name="price" min="0" value="{{ old('price', $product->price ?? '') }}"
           class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
    @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-5">
    <label class="block text-xs font-bold tracking-widest mb-2">SEGMEN</label>
    <select name="segment"
            class="w-full border border-neutral-800 px-4 py-3 text-sm focus:ring-0 focus:border-red-600">
        @foreach(['suv' => 'SUV', 'sportcar' => 'Sportcar', 'sedan' => 'Sedan'] as $value => $label)
            <option value="{{ $value }}" @selected(old('segment', $product->segment ?? '') === $value)>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('segment') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-8">
    <label class="block text-xs font-bold tracking-widest mb-2">GAMBAR</label>

    @if(!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-48 mb-3 bg-neutral-100 p-2">
        <p class="text-xs text-neutral-500 mb-2">Kosongkan jika tidak ingin mengganti gambar.</p>
    @endif

    <input type="file" name="image" accept="image/*" class="text-sm">
    @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex items-center gap-4">
    <button class="bg-black text-white text-xs font-bold tracking-widest px-8 py-4 hover:bg-red-600 transition">
        SIMPAN
    </button>
    <a href="{{ route('admin.products.index') }}" class="text-sm text-neutral-500">Batal</a>
</div>