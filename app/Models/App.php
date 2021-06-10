<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class App extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name'
    ];
}
