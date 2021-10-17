<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'name' => 'Farel Putra Hidayat',
            'nip_nim' => '1232671823',
            'class' => 'TI-3C',
            'username' => 'admin',
            'password' => \Hash::make('password'),
            'majors' => 'Sistem Informasi',
            'level' => 'admin',
            'prodi' => 'Teknik Informatika'
        ]);

        $mahasiswa = \App\User::create([
            'name' => 'Alhamdi Ferdiawan',
            'nip_nim' => '3891273687126',
            'class' => 'TI-3C',
            'username' => 'mahasiswa',
            'password' => \Hash::make('password'),
            'majors' => 'Sistem Informasi',
            'level' => 'mahasiswa',
            'prodi' => 'Teknik Informatika'
        ]);

        $dosen = \App\User::create([
            'name' => 'Pramana Yoga',
            'nip_nim' => '126318723687',
            'class' => 'TI-3C',
            'username' => 'dosen',
            'password' => \Hash::make('password'),
            'majors' => 'Sistem Informasi',
            'level' => 'dosen',
            'prodi' => 'Teknik Informatika'
        ]);
    }
}
