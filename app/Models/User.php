<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_status_id',
        'user_role_id',
        'image_path',
        'city',
        'Bio',
        'joining_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserStatus() {
        return $this->belongsTo(UserStatus::class);
    }

    public function UserRole() {
        return $this->belongsTo(UserRole::class);
    }

    public function leaves() {
        return $this->hasMany(Leave::class);
    }

    public function salaries() {
        return $this->hasMany(Salary::class);
    }


    //scopes

    public function scopeNotAdmin($query) {
        return $query->whereHas('UserRole', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        });
    }

    public function scopeFilterBySearch($query,$input) {
        return $query->where('name', 'Like', '%' . $input . '%');
    }

    public function scopeFilterByRole($query, $filter_by_role) {
        return $query->whereHas('UserRole', function ($query) use ($filter_by_role) {
            $query->where('role_name', '=', $filter_by_role);
        });
    }

    public function scopeFilterByStatus($query, $filter_by_status) {
        return $query->whereHas('UserStatus', function($query)use($filter_by_status) {
            $query->where('status','=',$filter_by_status);
        });
    }
}
