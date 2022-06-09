<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => ProductStatus::class
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInStock(Builder $query)
    {
        return $query->where('monthly_inventory', '>', 0);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
