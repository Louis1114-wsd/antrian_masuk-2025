<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    public function show(Kategori $kategori)
{
    $kategori->load('rujukanKe'); // Eager load relasi rujukan
    return view('kategori.show', compact('kategori'));
}
}
