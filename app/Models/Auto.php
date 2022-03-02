<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;
    protected $fillable=['modelo', 'marca', 'foto', 'user_id', 'kms', 'reservado'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
