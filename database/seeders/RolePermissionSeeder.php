<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'lihat-akun']);
        Permission::create(['name'=>'tambah-akun']);
        Permission::create(['name'=>'edit-akun']);
        Permission::create(['name'=>'hapus-akun']);

        Permission::create(['name'=>'lihat-pendaftaran']);
        Permission::create(['name'=>'tambah-pendaftaran']);
        Permission::create(['name'=>'edit-pendaftaran']);
        Permission::create(['name'=>'hapus-pendaftaran']);

        Permission::create(['name'=>'lihat-skema']);
        Permission::create(['name'=>'tambah-skema']);
        Permission::create(['name'=>'edit-skema']);
        Permission::create(['name'=>'hapus-skema']);

        Permission::create(['name'=>'lihat-jadwal']);
        Permission::create(['name'=>'tambah-jadwal']);
        Permission::create(['name'=>'edit-jadwal']);
        Permission::create(['name'=>'hapus-jadwal']);

        Permission::create(['name'=>'lihat-transaksi']);
        Permission::create(['name'=>'tambah-transaksi']);
        Permission::create(['name'=>'edit-transaksi']);
        Permission::create(['name'=>'hapus-transaksi']);

        Permission::create(['name'=>'lihat-peserta']);
        Permission::create(['name'=>'tambah-peserta']);
        Permission::create(['name'=>'edit-peserta']);
        Permission::create(['name'=>'hapus-peserta']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo(['lihat-akun']);
        $roleAdmin->givePermissionTo(['tambah-akun']);
        $roleAdmin->givePermissionTo(['edit-akun']);
        $roleAdmin->givePermissionTo(['hapus-akun']);

        $roleAdmin->givePermissionTo(['lihat-pendaftaran']);
        $roleAdmin->givePermissionTo(['tambah-pendaftaran']);
        $roleAdmin->givePermissionTo(['edit-pendaftaran']);
        $roleAdmin->givePermissionTo(['hapus-pendaftaran']);

        $roleAdmin->givePermissionTo(['lihat-skema']);
        $roleAdmin->givePermissionTo(['tambah-skema']);
        $roleAdmin->givePermissionTo(['edit-skema']);
        $roleAdmin->givePermissionTo(['hapus-skema']);

        $roleAdmin->givePermissionTo(['lihat-jadwal']);
        $roleAdmin->givePermissionTo(['tambah-jadwal']);
        $roleAdmin->givePermissionTo(['edit-jadwal']);
        $roleAdmin->givePermissionTo(['hapus-jadwal']);

        $roleAdmin->givePermissionTo(['lihat-transaksi']);
        $roleAdmin->givePermissionTo(['tambah-transaksi']);
        $roleAdmin->givePermissionTo(['edit-transaksi']);
        $roleAdmin->givePermissionTo(['hapus-transaksi']);

        $roleAdmin->givePermissionTo(['lihat-peserta']);
        $roleAdmin->givePermissionTo(['tambah-peserta']);
        $roleAdmin->givePermissionTo(['edit-peserta']);
        $roleAdmin->givePermissionTo(['hapus-peserta']);

        // $roleAdmin->givePermissionTo(['lihat-skema', 'tambah-skema', 'edit-skema', 'hapus-skema']);
        // $roleAdmin->givePermissionTo(['lihat-jadwal', 'tambah-jadwal', 'edit-jadwal', 'hapus-jadwal']);
        // $roleAdmin->givePermissionTo(['lihat-transaksi', 'tambah-transaksi', 'edit-transaksi', 'hapus-transaksi']);
        // $roleAdmin->givePermissionTo(['lihat-peserta', 'tambah-peserta', 'edit-peserta', 'hapus-peserta']);
        
        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo(['lihat-akun']);
        $roleUser->givePermissionTo(['tambah-akun']);
        $roleUser->givePermissionTo(['edit-akun']);

        $roleUser->givePermissionTo(['lihat-pendaftaran']);
        $roleUser->givePermissionTo(['tambah-pendaftaran']);
        $roleUser->givePermissionTo(['edit-pendaftaran']);

        $roleUser->givePermissionTo(['lihat-skema']);

        $roleUser->givePermissionTo(['lihat-jadwal']);

        $roleUser->givePermissionTo(['lihat-transaksi']);
        $roleUser->givePermissionTo(['tambah-transaksi']);

        $roleUser->givePermissionTo(['lihat-peserta']);
        $roleUser->givePermissionTo(['tambah-peserta']);
    }
}
