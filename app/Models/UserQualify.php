<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualify extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'qualify_id'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function qualify(){
        return $this->hasOne(Qualify::class, 'id', 'qualify_id');
    }
}
