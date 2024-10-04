<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATAB extends Model
{
    use HasFactory;

    protected $table = 'atab';
    protected $fillable = ['bil', 'no_lot', 'no_hakmilik', 'jpph', 'sap', 'geran', 'lain_lain'];
    protected $casts = [
        'lain_lain' => 'array', // Menyimpan fail dalam format JSON
    ];

    public function ata()
    {
        return $this->belongsTo(aset_tak_alih::class, 'no_lot', 'no_lot')
                    ->where('no_hakmilik', $this->no_hakmilik);
    }

}

