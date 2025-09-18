<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Participant extends Model
{
    protected $fillable = [
        'training_id',
        'name',
        'email',
        'token',
        'confirmed_at',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'confirmed_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($participant) {
            if (! $participant->token) {
                $participant->token = Str::random(40);
            }
        });

        // kirim email undangan setelah record dibuat (queue jika aktif)
        static::created(function ($participant) {
            // pastikan mail driver + queue sudah dikonfigurasi
            \Illuminate\Support\Facades\Mail::to($participant->email)
                ->queue(new \App\Mail\ParticipantInvitation($participant));
        });
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function confirm(array $data = [])
    {
        $this->fill($data);
        $this->confirmed_at = now();
        $this->token = null;
        $this->save();
    }
}
