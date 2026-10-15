<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $merchant = auth()->user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    public function update(Request $request)
    {
        $merchant = auth()->user()->merchant;

        $data = $request->validate([
            'company_name' => 'required|string|max:150',
            'description'  => 'nullable|string',
            'location'     => 'nullable|string|max:150',
            'logo'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($merchant->logo) Storage::disk('public')->delete($merchant->logo);
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $merchant->update($data);
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
