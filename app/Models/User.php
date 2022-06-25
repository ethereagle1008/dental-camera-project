<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'furi', 'gender', 'blood', 'birthday', 'phone', 'emergency_name', 'address',
        'emergency_number', 'contract_type', 'deal_type', 'contract_value', 'director_id', 'office_id', 'team_id', 'dormitory', 'cloth', 'business_phone',
        'insurance', 'insurance_cost', 'safe_cost', 'receive_type', 'loan', 'advance_pay', 'desire_start', 'desire_meet'
    ];
    public function director(){
        return $this->hasOne(User::class, 'id', 'director_id');
    }
    public function office(){
        return $this->hasOne(Office::class, 'id', 'office_id');
    }
    public function team(){
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
