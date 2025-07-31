@extends('layouts.app') {{-- atau layoutmu sendiri --}}

@section('content')
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-2">Detail Kategori: {{ $kategori->nama }}</h2>

        <h3 class="text-lg font-semibold mt-4">Rujukan ke:</h3>
        @if ($kategori->rujukanKe->isEmpty())
            <p class="text-gray-500">Tidak ada rujukan.</p>
        @else
            <ul class="list-disc list-inside">
                @foreach ($kategori->rujukanKe as $target)
                    <li>{{ $target->nama }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
