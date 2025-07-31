<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
        protected $fillable = ['nama'];

        public function parent()
    {
        return $this->belongsTo(Kategori::class, 'parent_id');
    }  

        public function children()
    {
        return $this->hasMany(Kategori::class, 'parent_id');
    }

        public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }

        public function rujukanKe()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_rujukan', 'from_kategori_id', 'to_kategori_id');
    }
        public function rujukanDari()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_rujukan', 'to_kategori_id', 'from_kategori_id');
    }

}

