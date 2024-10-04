<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atat extends Model
{
    use HasFactory;

    protected $table = 'atat';
    protected $fillable = ['no_lot', 'no_hakmilik', 'cpc', 'jkr66a', 'doc_auc'];

    public function ata()
    {
        return $this->belongsTo(aset_tak_alih::class, 'no_lot', 'no_lot')
                    ->where('no_hakmilik', $this->no_hakmilik);
    }

}
