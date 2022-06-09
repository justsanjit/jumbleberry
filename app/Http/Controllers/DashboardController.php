<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $getProducts = fn($status) => $request->user()
            ->products()
            ->wherePivot('status', $status)
            ->get();

        return view('dashboard', [
            'approvedProducts' => $getProducts('approved'),
            'pendingProducts' => $getProducts('pending'),
            'rejectedProducts' => $getProducts('rejected')
        ]);
    }
}
