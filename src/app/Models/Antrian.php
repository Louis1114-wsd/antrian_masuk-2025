<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = ['nomor', 'status'];
    public function kategori()
   {
         return $this->belongsTo(Kategori::class);
   }
}
