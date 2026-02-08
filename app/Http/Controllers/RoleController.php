<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        // Modules based on seeded data
        $modules = ['data_pasien', 'data_obat', 'rekam_medis', 'pembayaran', 'poli', 'tindakan', 'lab_radiologi', 'laporan', 'users', 'roles'];
        $permissionsMap = $permissions->pluck('id', 'slug');

        return view('roles.index', compact('roles', 'permissions', 'permissionsMap', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|in:admin,dokter,perawat,kasir,apotek|unique:roles,name',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissionsMap = $permissions->pluck('id', 'slug');

        // Modules based on seeded data
        $modules = ['data_pasien', 'data_obat', 'rekam_medis', 'pembayaran', 'poli', 'tindakan', 'lab_radiologi', 'laporan', 'users', 'roles'];

        return view('roles.edit', compact('role', 'permissions', 'permissionsMap', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->except('permissions'));
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('roles.index')->with('error', 'Cannot delete role because it is assigned to one or more users.');
            }
            return redirect()->route('roles.index')->with('error', 'An error occurred while deleting the role.');
        }
    }
}
