<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'shift_date', 'start_time', 'start_place', 'end_time', 'end_place', 'site_id', 'over', 'over_time'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function site(){
        return $this->hasOne(Site::class, 'id', 'site_id');
    }
}
