<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'month',
        'year',
        'payable_salary',
        'leave_count',
        'paid_status',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeOrderByDate($query) {
        return $query
        ->orderBy('year','desc')
        ->orderBy('month','desc');
        
    }

    public function scopeFilterByRole($query, $filter_by_role) {
        return $query->whereHas('user', function($query) use($filter_by_role) {
            $query->whereHas('UserRole',function($query) use($filter_by_role) {
                $query->where('role_name','=',$filter_by_role);
            });
        });
    }

    public function scopeFilterBySearch($query,$input) {
        return $query->whereHas('user',function($query) use($input) {
            $query->where('name','Like','%'.$input.'%');
        });
    }
}
