<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'name', 'address', 'latitude', 'longitude', 'company_id', 'contact', 'site_code'
    ];
    public function company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
