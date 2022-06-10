<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        /** @var Product */
        $product = $request->user()
            ->approvedProducts()
            ->where('id', $request->product_id)
            ->first();

        // User should not allow to add the transactions if product was not approved for him
        if($product === null) {
            throw ValidationException::withMessages([
                'message' => 'You cannot promote a product that is not approved'
            ]);
        }

        // Throw validation error is product is out of stock
        if ($product->monthly_inventory <= 0) {
            throw ValidationException::withMessages([
                'message' => 'Product out of stock'
            ]);
        }

        // Create a transaction and decrement inventory count
        DB::transaction(function() use ($product) {
            Transaction::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            $product->decrement('monthly_inventory');
        });

        // Go to previous page with success message
        return back()->with('success', 'Transaction created.');
    }
}
