<?php

namespace App\Http\Controllers;

use App\Events\ProductStatusChanged;
use App\Models\Product;
use App\Notifications\ProductStatusChangedNotification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index()
    {
        // Admin can see entire catalog where normal user can only view active products
        // excluding items that are already approval for promotion.
        $products = Product::query()
            ->when(Auth()->user()->cannot('manage_products'), function (Builder $query) {
                $query->active()->whereDoesntHave('users', function(QueryBuilder $query) {
                    $query->where('user_id', Auth::id());
                });
            })
           ->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function patch(Product $product, Request $request)
    {
        $this->authorize('manage_products');

        $request->validate([
            'status' => 'required|in:active,on-hold,expired'
        ]);

        // Updating the product status, even if new status is same as old one.
        // This can be improved to save one query
        $product->update([
            'status' => $request->status
        ]);

        // Dispatch an event only if the status was actually changed
        if ($product->wasChanged('status')) {
            event(new ProductStatusChanged($product));
        }

        return back()->with('success', 'Product status updated successfully.');
    }
}
