<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->whereDoesntHave('users', function(QueryBuilder $query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('products.index', [
            'products' => $products
        ]);
    }
}
