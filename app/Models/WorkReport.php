<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'site_id', 'report', 'report_date'
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id')->with('office')->with('team');
    }
    public function site(){
        return $this->hasOne(Site::class, 'id', 'site_id')->with('company');
    }
}
