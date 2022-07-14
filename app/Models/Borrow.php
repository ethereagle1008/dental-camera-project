<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'amount', 'repay_type', 'repay_amount', 'start_date'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
