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
        $users = [
            ['name' => 'pemasaran','email' => 'bebas_pemasaran@gmail.com', 'role_id' => 2],
            ['name' => 'kerjasama','email' => 'bebas_kerjasama@gmail.com', 'role_id' => 3],
            ['name' => 'kabidpjt','email' => 'bebas_kabidpjt@gmail.com', 'role_id' => 4],
            ['name' => 'keuangan','email' => 'bebas_keuangan@gmail.com', 'role_id' => 5],
            ['name' => 'sertifikasi','email' => 'bebas_sertifikasi@gmail.com', 'role_id' => 6],
            ['name' => 'auditor','email' => 'bebas_auditor@gmail.com', 'role_id' => 7],
            ['name' => 'kabidpaskal','email' => 'bebas_kabidpaskal@gmail.com', 'role_id' => 8],
        ];
        for ($i=1; $i < 3; $i++) {
            array_push($users, [
                'name' => 'user'.$i,
                'email' => 'bebas'.$i.'@gmail.com',
                'role_id' => 1,
                'negeri' => $i,
                'nama_perusahaan' => 'PT.ADA1',
                'pimpinan_perusahaan' => 'Pimpinan'.$i
            ]);
        }

        foreach ($users as $key => $value) {
            $user = new User;
            $user->name = $value['name'];
            $user->email = $value['email'];
            $user->email_verified_at = strtotime('2019-07-16 03:32:20');
            $user->password = bcrypt('12345678');
            $user->role_id = isset($value['role_id']) ? $value['role_id'] : null;
            $user->negeri = isset($value['negeri']) ? $value['negeri'] : null;
            $user->nama_perusahaan = isset($value['nama_perusahaan']) ? $value['nama_perusahaan'] : null;
            $user->pimpinan_perusahaan = isset($value['pimpinan_perusahaan']) ? $value['pimpinan_perusahaan'] : null;
            $user->save();
        }
    }
}
