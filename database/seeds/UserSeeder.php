<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 3; $i++) { 
            $user = new User;
            $user->name = 'user'.$i;
            $user->email = 'bebas'.$i.'@gmail.com';
            $user->email_verified_at = strtotime('2019-07-16 03:32:20');
            $user->password = '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.';
            $user->role_id = 1;
            $user->negeri = ''.$i;
            $user->nama_perusahaan = 'PT.ADA'.$i;
            $user->pimpinan_perusahaan = 'Pimpinan'.$i;
            $user->save();
        }

        $user = new User;
        $user->name = 'pemasaran';
        $user->email = 'bebas3@gmail.com';
        $user->email_verified_at = strtotime('2019-07-16 03:32:20');
        $user->password = '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.';
        $user->role_id = 2;
        $user->negeri = null;
        $user->save();
    }
}
