<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['tanggal_mulai','nama_training','tanggal_selesai','ruangan'];

public function instructors()
{
    return $this->belongsToMany(Instructor::class, 'training_instructors', 'training_id', 'instructor_id')
                ->withTimestamps();
}
    
public function material()
{
    return $this->belongsTo(Material::class, 'nama_training', 'nama');
}

public function participants()
{
    return $this->hasMany(\App\Models\Participant::class, 'training_id');
}

}
