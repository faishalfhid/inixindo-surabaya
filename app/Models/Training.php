<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['tanggal_mulai','tanggal_selesai','ruangan'];

public function instructors()
{
    return $this->belongsToMany(Instructor::class, 'training_instructors', 'training_id', 'instructor_id')
                ->withTimestamps();
}

public function materials()
{
    return $this->belongsToMany(Material::class, 'training_materials', 'training_id', 'kode_materi')
                ->withTimestamps();
}


}
