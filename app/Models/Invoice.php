<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'month', 'site_id', 'amount'
    ];
    public function site(){
        return $this->hasOne(Site::class, 'id', 'site_id');
    }
}
