<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'username', 'preferred_timezone'];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'user_appointments');
    }

    public function createdAppointments()
    {
        return $this->hasMany(Appointment::class, 'creator_id');
    }
}
