<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_type', 'user_id', 'number', 'type', 'manager'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
