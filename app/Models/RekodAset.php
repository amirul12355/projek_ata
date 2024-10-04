<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekodAset extends Model
{
    use HasFactory;

    // Nama jadual yang berkaitan dengan model ini
    protected $table = 'aset_tak_alih';

    // Senarai kolum yang boleh diisi (fillable) melalui form
    protected $fillable = [
        'kod_ao',
        'kod_ptj',
        'nama_ptj',
        'negeri',
        'daerah',
        'bandar',
        'no_lot',
        'no_hakmilik',
        'luas_tanah',
        'no_lot_lama',
        'no_hakmilik_lama',
        'luas_tanah_lama',
        'nilai_tanah_jpph',
        'nilai_bangunan_jpph',
        'nilai_tanah_igfmas',
        'nilai_bangunan_igfmas',
        'catatan'
    ];

    

    // Relasi kepada ATAT berdasarkan no_lot dan no_hakmilik
    public function atat()
    {
        return $this->hasOne(ATAT::class, 'no_lot', 'no_lot')
                    ->where('no_hakmilik', $this->no_hakmilik);
    }

    // Relasi kepada ATAB berdasarkan no_lot dan no_hakmilik
    public function atab()
    {
        return $this->hasOne(ATAB::class, 'no_lot', 'no_lot')
                    ->where('no_hakmilik', $this->no_hakmilik);
    }

}
