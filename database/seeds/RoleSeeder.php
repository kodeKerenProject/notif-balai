<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['client', 'pemasaran', 'kerjasama', 'kabidpjt', 'keuangan', 'sertifikasi', 'auditor', 'kabidpaskal'];
    	foreach ($roles as $key => $value) {
            $role = new Role;
        	$role->role = $value;
        	$role->save();
        }
    }
}
