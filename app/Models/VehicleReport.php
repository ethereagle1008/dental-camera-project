<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id', 'site_id', 'report_type', 'report_date', 'etc_value', 'etc_apply', 'oil_value', 'oil_apply', 'parking_value', 'parking_apply', 'other_value', 'other_apply'
    ];
    public function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id')->with('office')->with('team');
    }
    public function site(){
        return $this->hasOne(Site::class, 'id', 'site_id')->with('company');
    }
}
