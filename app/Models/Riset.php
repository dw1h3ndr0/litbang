<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset extends Model
{
    use HasFactory;

    protected $table = 'risets';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class,'wilayah_id');
    }
}
