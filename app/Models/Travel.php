<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'site_id', 'start_date', 'end_date'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function site(){
        return $this->hasOne(Site::class, 'id', 'site_id');
    }
}
