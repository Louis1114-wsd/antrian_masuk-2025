<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kategori;

use Illuminate\Http\Request;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $antrian_aktif = Antrian::where('status', 'aktif')->first();
        $antrian_menunggu = Antrian::where('status', 'menunggu')->orderBy('nomor')->get();
        $antrian_selesai = Antrian::where('status', 'selesai')->orderBy('nomor', 'desc')->get();
        $kategoris = Kategori::all();
        
        return view('antrian.index', compact('antrian_aktif', 'antrian_menunggu', 'antrian_selesai', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $last = Antrian::orderBy('nomor', 'desc')->first();
        $nomor_baru = $last ? $last->nomor + 1 : 1;

        Antrian::create([
            'nomor' => $nomor_baru,
            'status' => 'menunggu',
        ]);

        return redirect()->route('antrian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
   {
         $aktif = Antrian::where('status', 'aktif')->first();
         if ($aktif) {
             $aktif->update(['status' => 'selesai']);
        // Simpan ke stack di session
             $stack = session()->get('undo_stack', []);
             array_push($stack, $aktif->id);
             session(['undo_stack' => $stack]);
        }

    // Set yang dipilih jadi aktif
    $antrian = Antrian::findOrFail($id);
    $antrian->update(['status' => 'aktif']);

    return redirect()->route('antrian.index');
   }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }

    /**
     * Undo the last action.
     */
    public function undo()
    {
        $stack = session()->get('undo_stack', []);
        
        if (!empty($stack)) {
            $last_id = array_pop($stack);
            session(['undo_stack' => $stack]);

            $last = Antrian::find($last_id);
            if ($last) {
                $last->update(['status' => 'aktif']);
            }

            // Kembalikan antrian yang tadi aktif (sekarang aktif kembali) ke status menunggu
            $aktif = Antrian::where('status', 'aktif')->where('id', '!=', $last_id)->first();
            if ($aktif) {
                $aktif->update(['status' => 'menunggu']);
            }
        }

        return redirect()->route('antrian.index');
    }    

    /**
     * Get the JSON representation of the antrian.
     */
    public function json()
    {
        $semua_antrian = Antrian::orderBy('nomor')->get();
        return response()->json($semua_antrian);
    }
    
    
}
        

    


