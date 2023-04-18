<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeOrderByCreatedAt($query) {
        return $query->orderBy('created_at', 'desc');
        
    }

    public function scopeFilterBySearch($query, $input) {
        return $query->whereHas('user', function ($query) use ($input) {
            $query->where('name', 'LIKE', '%' . $input . '%');
        });
    }

    public function scopeFilterByRole($query, $filter_by_role) {
        return $query->whereHas('user', function ($query) use ($filter_by_role) {
            $query->whereHas('UserRole',function($query) use ($filter_by_role) {
                $query->where('role_name','=',$filter_by_role);
            });
        });
    }
}
