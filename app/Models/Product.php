<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Events\ProductOutOfStock;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => ProductStatus::class
    ];

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::updated(function (Product $product) {
            if ($product->wasChanged('monthly_inventory') && $product->monthly_inventory <= 0) {
                ProductOutOfStock::dispatch($product);
            }
        });
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInStock(Builder $query)
    {
        return $query->where('monthly_inventory', '>', 0);
    }

    public function inStock(): bool
    {
        return $this->monthly_inventory > 0;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function approvedUsers()
    {
        return $this->users()->wherePivot('status', 'approved');
    }

}
