<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Instructor extends Model
{
    use SoftDeletes;
    protected $fillable = ['nama','email'];

public function trainings()
{
    return $this->belongsToMany(Training::class, 'training_instructors', 'instructor_id', 'training_id')
                ->withTimestamps();
}

}
