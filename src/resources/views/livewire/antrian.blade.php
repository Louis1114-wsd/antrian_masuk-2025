<div>
    <form action="{{ route('antrian.store') }}" method="POST" class="mb-6">
    @csrf

    <label for="kategori" class="block mb-1">Pilih Kategori:</label>
    <select name="kategori_id" id="kategori" class="border p-2 rounded mb-4 w-full">
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
        @endforeach
    </select>

    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
        Ambil Nomor Antrian
    </button>
</form>
</div>
