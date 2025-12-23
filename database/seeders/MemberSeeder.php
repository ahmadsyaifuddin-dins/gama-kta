<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Pakai Data Indonesia

        // Kita bikin array Dusun supaya datanya terkelompok (Gasan tes Laporan Wilayah)
        $daftarDusun = ['Dusun Mawar', 'Dusun Melati', 'Dusun Anggrek', 'Dusun Kenanga'];

        for ($i = 1; $i <= 25; $i++) {

            // Random status cetak (ada yang sudah, ada yang belum)
            $isPrinted = $faker->boolean(40); // 40% kemungkinan sudah dicetak

            Member::create([
                'nomor_anggota' => 'KUD-GM-'.str_pad($i, 4, '0', STR_PAD_LEFT), // Contoh: KUD-GM-0001
                'nik' => $faker->nik(),
                'nama_lengkap' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'), // Lahir sebelum tahun 2000
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),

                'alamat_lengkap' => $faker->address(),
                'dusun' => $faker->randomElement($daftarDusun), // Pilih acak dari array dusun
                'desa' => 'Telaga Sari',
                'no_hp' => $faker->phoneNumber(),

                'pekerjaan' => $faker->jobTitle(),
                'tanggal_bergabung' => $faker->dateTimeBetween('-2 years', 'now'), // Gabung dalam 2 tahun terakhir

                'foto' => null, // Foto kosong dulu

                'status_cetak' => $isPrinted,
                'tanggal_cetak' => $isPrinted ? $faker->dateTimeBetween('-1 month', 'now') : null,
            ]);
        }
    }
}
