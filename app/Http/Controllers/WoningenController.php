<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Woningen;

class WoningenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $woningen = Woningen::all();

        return view('woningen.index', compact('woningen')); // -> resources/views/stocks/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('woningen.create'); // -> resources/views/stocks/create.blade.php
    }

    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
    // Validation for required fields (and using some regex to validate our numeric value)
    $request->validate([
        'naam'=>'required',
        'beschrijving'=>'required',
        'oppervlakte'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
        'prijs'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/'
    ]);
    // Getting values from the blade template form
    $woning = new Woningen([
        'naam' => $request->get('naam'),
        'beschrijving' => $request->get('beschrijving'),
        'oppervlakte' => $request->get('oppervlakte'),
        'prijs' => $request->get('prijs')
    ]);
    $woning->save();
    return redirect('/woningen')->with('success', 'Woning toegevoegd.');   // -> resources/views/stocks/index.blade.php
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
