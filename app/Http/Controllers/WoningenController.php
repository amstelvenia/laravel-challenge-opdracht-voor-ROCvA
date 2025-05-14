<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Woningen;
use App\Models\User;
use Spatie\Image\Manipulation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WoningenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $woningen = Woningen::all();

        return view('woningen.index', compact('woningen'));
    }

    public function user()
    {
        $beheer = User::all();
        $model_has_roles = DB::table('model_has_roles')->get();
        $roles = DB::table('roles')->get();
        $permissions = DB::table('permissions')->get();
        $role_has_permissions = DB::table('role_has_permissions')->get();

        return view('woningen.beheer', compact('beheer', 'model_has_roles', 'roles', 'permissions', 'role_has_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('woningen.create');
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
        'prijs'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
        'images.*' => 'required|image'
    ]);
    // Getting values from the blade template form
    $woning = new Woningen([
        'naam' => $request->get('naam'),
        'beschrijving' => $request->get('beschrijving'),
        'oppervlakte' => $request->get('oppervlakte'),
        'prijs' => $request->get('prijs')
    ]);
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $woning->addMedia($image)->toMediaCollection('images');
        }
    }
    $woning->save();
    return redirect('/woningen')->with('success', 'Woning toegevoegd.');
    }

    public function show(string $id)
    {
        // Zoek de post met het gegeven id
        $woning = Woningen::find($id);

        // Retourneer een view en geef de post-data door
        return view('woningen.show', ['woning' => $woning]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $woning = Woningen::find($id);
        return view('woningen.edit',['woning'=>$woning]);
    }

    public function editPermission($id)
    {
        $roles = DB::table('roles')->where('id', $id)->first();
        $permissions = DB::table('permissions')->get();
        return view('woningen.editPermission', compact('roles', 'permissions'));
    }

    public function editRole($id)
    {
        $user = User::findOrFail($id);
        $roles = DB::table('roles')->get();
        $currentRoleId = DB::table('model_has_roles')->where('model_id', $id)->value('role_id');

        return view('woningen.edit-role', compact('user', 'roles', 'currentRoleId'));
    }

    public function updateRole(Request $request, $id)
    {
        $roleId = $request->role;

        // Check if user already has a role entry
        $exists = DB::table('model_has_roles')->where('model_id', $id)->exists();

        if ($exists) {
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->update(['role_id' => $roleId]);
        } else {
            DB::table('model_has_roles')
                ->insert([
                    'role_id' => $roleId,
                    'model_type' => 'App\\Models\\User', // Replace with actual User model if different
                    'model_id' => $id,
                ]);
        }

        // Get current user's role to determine redirect
        $currentUserRoleId = DB::table('model_has_roles')
            ->where('model_id', Auth::id())
            ->value('role_id');

        if ($currentUserRoleId == 1) {
            return redirect('/beheer')->with('success', 'Role updated successfully.');
        } else {
            return redirect('/woningen')->with('success', 'Role updated successfully.');
        }
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
        'prijs'=>'required|max:8|regex:/^[0-9]+(?:\.[0-9]{1,2})?$/',
        'images.*' => 'required|image'
    ]);
    $woning = Woningen::find($id);
    // Getting values from the blade template form
    $woning->naam =  $request->get('naam');
    $woning->beschrijving = $request->get('beschrijving');
    $woning->oppervlakte = $request->get('oppervlakte');
    $woning->prijs = $request->get('prijs');
    if ($request->hasFile('image')) {
        // Delete old images if they exist
        if ($woning->getMedia('images')->isNotEmpty()) {
            $woning->clearMediaCollection('images');
        }

        // Add new images
        foreach ($request->file('image') as $image) {
            $woning->addMedia($image)->toMediaCollection('images');
        }
    }
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
