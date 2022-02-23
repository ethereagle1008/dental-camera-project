<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'team_manager_id'
    ];
    public function teamManager(){
        return $this->hasOne(User::class, 'id', 'team_manager_id');
    }
}
