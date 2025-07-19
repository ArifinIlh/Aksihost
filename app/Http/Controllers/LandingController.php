<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DomainPrice;
use App\Models\Domain;

class LandingController extends Controller
{
    public function index()
    {
        $extensions = DomainPrice::all();
        return view('welcome', compact('extensions'));
    }

    public function checkDomain(Request $request)
    {
        $request->validate(['name' => 'required']);

        $name = strtolower(trim($request->input('name')));
        $extensions = DomainPrice::all();

        $results = $extensions->map(function ($ext) use ($name) {
            $fullDomain = $name . $ext->extension;

            $isTaken = Domain::where('name', $fullDomain)->exists();

            return [
                'domain' => $fullDomain,
                'available' => !$isTaken,
                'price' => $ext->price,
            ];
        });

        return view('welcome', [
            'extensions' => $extensions,
            'results' => $results,
            'searchedName' => $name,
        ]);
    }
}