@extends('layouts.app') {{-- Ubah ke layout kamu kalau beda --}}

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Sistem Antrian</h1>

    {{-- Antrian Aktif --}}
    <div class="bg-blue-100 border border-blue-300 p-4 rounded mb-6">
        <h2 class="text-xl font-semibold mb-2">Antrian Aktif</h2>
        @if ($antrian_aktif)
            <p class="text-4xl font-bold text-blue-700">#{{ $antrian_aktif->nomor }}</p>
        @else
            <p class="text-gray-600">Belum ada yang aktif</p>
        @endif
    </div>

    {{-- Form Ambil Antrian --}}
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

    {{-- Tombol Undo --}}
    @if(session()->has('undo_stack') && count(session('undo_stack')) > 0)
        <form method="POST" action="{{ route('antrian.undo') }}" class="mb-6">
            @csrf
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
               Undo Antrian Terakhir
            </button>
        </form>
    @endif

    {{-- Daftar Menunggu --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Antrian Menunggu</h2>
        @forelse ($antrian_menunggu as $item)
            <div class="flex items-center justify-between bg-white border p-2 rounded mb-2">
                <span>#{{ $item->nomor }}</span>
                <form action="{{ route('antrian.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Panggil</button>
                </form>
            </div>
        @empty
            <p class="text-gray-600">Tidak ada antrian menunggu</p>
        @endforelse
    </div>

    {{-- Daftar Selesai --}}
    <div>
        <h2 class="text-lg font-semibold mb-2">Antrian Selesai</h2>
        @forelse ($antrian_selesai as $item)
            <p class="text-gray-600">#{{ $item->nomor }}</p>
        @empty
            <p class="text-gray-600">Belum ada</p>
        @endforelse
    </div>
</div>
@endsection
