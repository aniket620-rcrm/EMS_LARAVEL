<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
}
