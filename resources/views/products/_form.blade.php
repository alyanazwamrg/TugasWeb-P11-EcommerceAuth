@php $p = $product ?? null; @endphp

<div>
    <x-input-label for="category_id" value="Kategori" />
    <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id', $p?->category_id) == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="name" value="Nama Produk" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $p?->name)" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="description" value="Deskripsi" />
    <textarea id="description" name="description" rows="4"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $p?->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="price" value="Harga (Rp)" />
    <x-text-input id="price" name="price" type="number" step="1" class="mt-1 block w-full" :value="old('price', $p?->price)" />
    <x-input-error :messages="$errors->get('price')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="stock" value="Stok" />
    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $p?->stock)" />
    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
</div>