<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'office_manager_id', 'parent_identify', 'parent_office'
    ];

    public function officeManager(){
        return $this->hasOne(User::class, 'id', 'office_manager_id');
    }
}
