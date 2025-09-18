<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'kode_materi'; // Primary key
    public $incrementing = false;          // Tidak auto-increment
    protected $keyType = 'string';         // Tipe string

    protected $fillable = [
        'kode_materi',
        'nama',
        'status',
        'sumber',
        'harga',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class, 'training_materials', 'training_id', 'kode_materi')
                    ->withTimestamps();
    }
}
