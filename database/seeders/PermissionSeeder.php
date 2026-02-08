<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate to reset
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $modules = [
            'data_pasien',
            'data_obat',
            'rekam_medis',
            'pembayaran',
            'poli',
            'tindakan',
            'lab_radiologi',
            'laporan',
            'users',
            'roles'
        ];

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::create([
                    'name' => ucfirst($action) . ' ' . ucwords(str_replace('_', ' ', $module)),
                    'slug' => $action . '_' . $module,
                ]);
            }
        }

        Permission::create(['name' => 'View Dashboard', 'slug' => 'view_dashboard']);

        // Roles lookup (case-insensitive fallback)
        $admin = Role::where('name', 'Admin')->first() ?? Role::where('name', 'admin')->first();
        $dokter = Role::where('name', 'Doctor')->first() ?? Role::where('name', 'dokter')->first();
        $kasir = Role::where('name', 'kasir')->first() ?? Role::where('name', 'Kasir')->first();
        $perawat = Role::where('name', 'perawat')->first() ?? Role::where('name', 'Perawat')->first();

        // 1. ADMIN
        if ($admin) {
            // Admin gets all permissions
            $admin->permissions()->sync(Permission::all());
        }

        // 2. DOKTER
        if ($dokter) {
            $dokterPerms = Permission::whereIn('slug', [
                'view_dashboard',
                'view_data_pasien',
                'view_rekam_medis',
                'create_rekam_medis',
                'edit_rekam_medis',
                'view_lab_radiologi',
                'view_data_obat', // To see prescription options
                'view_tindakan'
            ])->get();
            $dokter->permissions()->sync($dokterPerms);
        }

        // 3. KASIR
        if ($kasir) {
            $kasirPerms = Permission::whereIn('slug', [
                'view_dashboard',
                'view_data_pasien',
                'view_pembayaran',
                'create_pembayaran',
                'view_data_obat',
                'view_tindakan'
            ])->get();
            $kasir->permissions()->sync($kasirPerms);
        }

        // 4. PERAWAT
        if ($perawat) {
            $perawatPerms = Permission::whereIn('slug', [
                'view_dashboard',
                'view_data_pasien',
                'create_data_pasien',
                'view_rekam_medis',
                'edit_rekam_medis', // Edit for vital signs
                'view_tindakan',
                'view_data_obat'
            ])->get();
            $perawat->permissions()->sync($perawatPerms);
        }
    }
}
