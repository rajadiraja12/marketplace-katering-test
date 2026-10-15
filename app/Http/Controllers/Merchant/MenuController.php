<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = auth()->user()->merchant->menus()->latest()->get();
        return view('merchant.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('merchant.menus.form', ['menu' => new Menu()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['merchant_id'] = auth()->user()->merchant->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('menus', 'public');
        }

        Menu::create($data);
        return redirect()->route('merchant.menus.index')->with('success', 'Menu ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $this->authorizeMenu($menu);
        return view('merchant.menus.form', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $this->authorizeMenu($menu);
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            if ($menu->photo) Storage::disk('public')->delete($menu->photo);
            $data['photo'] = $request->file('photo')->store('menus', 'public');
        }

        $menu->update($data);
        return redirect()->route('merchant.menus.index')->with('success', 'Menu diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $this->authorizeMenu($menu);
        if ($menu->photo) Storage::disk('public')->delete($menu->photo);
        $menu->delete();
        return back()->with('success', 'Menu dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'photo'       => 'nullable|image|max:2048',
        ]);
    }

    private function authorizeMenu(Menu $menu): void
    {
        if ($menu->merchant_id !== auth()->user()->merchant->id) {
            abort(403);
        }
    }
}
