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
    return redirect('/woningen')->with('success', 'Woning toegevoegd.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $woning = Woningen::find($id);
        return view('woningen.edit',['woning'=>$woning]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    // Validation for required fields (and using some regex to validate our numeric value)
    $request->validate([
        'naam'=>'required',
        'beschrijving'=>'required',
        'oppervlakte'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
        'prijs'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/'
    ]);
    $woning = Woningen::find($id);
    // Getting values from the blade template form
    $woning->naam =  $request->get('naam');
    $woning->beschrijving = $request->get('beschrijving');
    $woning->oppervlakte = $request->get('oppervlakte');
    $woning->prijs = $request->get('prijs');
    $woning->save();

    return redirect('/woningen'); // -> resources/views/stocks/index.blade.php
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $woning = Woningen::find($id);
    $woning->delete(); // Easy right?

    return redirect('/woningen');  // -> resources/views/stocks/index.blade.php
    }
}
