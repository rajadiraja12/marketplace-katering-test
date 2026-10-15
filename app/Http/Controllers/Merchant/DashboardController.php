<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;
        $totalMenu  = $merchant->menus()->count();
        $totalOrder = $merchant->orders()->count();
        $revenue    = $merchant->orders()->where('status', 'completed')->sum('total_amount');

        return view('merchant.dashboard', compact('merchant', 'totalMenu', 'totalOrder', 'revenue'));
    }
}
