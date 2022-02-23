<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdvance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'payment'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
