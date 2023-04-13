<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Kontrak;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Supervisor',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat, nam!',
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Front end Developer',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias ipsa ea necessitatibus!',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Back end Developer',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At, laudantium. Culpa!',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Intern',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        ]);

        Kontrak::create([
            'lama_kontrak' => '3 Bulan',
            'gaji_per_bulan' => '4000000'
        ]);
        Kontrak::create([
            'lama_kontrak' => '6 Bulan',
            'gaji_per_bulan' => '5500000'
        ]);
        Kontrak::create([
            'lama_kontrak' => '12 Bulan',
            'gaji_per_bulan' => '8250000'
        ]);

        Pegawai::factory(5)->create();
    }
}
