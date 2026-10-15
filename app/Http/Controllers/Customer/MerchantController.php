<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $merchants = Merchant::query()
            ->when($request->location, fn($q) => $q->where('location', 'like', "%{$request->location}%"))
            ->when($request->menu, function ($q) use ($request) {
                $q->whereHas('menus', fn($m) => $m->where('name', 'like', "%{$request->menu}%"));
            })
            ->withCount('menus')
            ->paginate(9);

        return view('customer.merchants.index', compact('merchants'));
    }

    public function show(Merchant $merchant)
    {
        $merchant->load('menus');
        return view('customer.merchants.show', compact('merchant'));
    }
}
