<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class RisetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tahun = $this->faker->numberBetween(2016,2022);

        $folder = uniqid().'-'.now()->timestamp;
        $image = $this->faker->image(null, 360, 360);
        // $image = 'https://source.unsplash.com/random';
        $imageFile = new File($image);
        Storage::copy('files/default.pdf', 'files/'.$folder.'/default.pdf');
        Storage::copy('penelitian/default.pdf', 'penelitian/'.$folder.'/default.pdf');
         
        return [
            'tahun' => $tahun,
            'tahun_data' => $this->faker->numberBetween(2016,$tahun),
            'tgl_mulai' => $this->faker->dateTimeBetween('-1 year', '-1 year'),
            'tgl_selesai' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'sumber_dana' => $this->faker->randomElement(['Dalam Negeri', 'Luar Negeri']),
            'judul' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'kategori_id' => mt_rand(1,6).','.mt_random(7,15).','.mt_random(16,21),
            'penyelenggara' => $this->faker->randomElement(['Individu', 'Kementerian/Lembaga', 'Perguruan Tinggi','Organisasi Masyarakat','Badan Usaha']),
            'pelaksana' => $this->faker->name(),
            'penanggungjawab' => $this->faker->name(),
            'nik' => $this->faker->numerify('################'),
            'kontak' => $this->faker->phoneNumber(),
            'no_surat_izin' => $this->faker->bothify('B-###/???-???/0#/'.$tahun),
            'tgl_surat_izin' => $this->faker->date($tahun.'-m-d'),
            'ktp' => Storage::disk('public')->putFile('ktp/'.$folder, $imageFile),
            'proposal' => 'files/'.$folder.'/default.pdf',
            'abstrak' => $this->faker->paragraphs(mt_rand(6,10),true),
            'hasil_penelitian' => 'penelitian/'.$folder.'/default.pdf',
            'resume' => $this->faker->paragraphs(mt_rand(6,10),true),
            'wilayah_id' => $this->faker->randomElement(['1', '6']),
            'created_at' => now()
        ];
    }
}
