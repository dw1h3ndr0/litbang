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
         
        return [
            'tahun' => $tahun,
            'judul' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'kategori_id' => mt_rand(1,5),
            'pelaksana' => $this->faker->name(),
            'nik' => $this->faker->numerify('################'),
            'no_surat_izin' => $this->faker->bothify('B-###/???-???/0#/'.$tahun),
            'tgl_surat_izin' => $this->faker->date($tahun.'-m-d'),
            'ktp' => Storage::disk('public')->putFile('ktp/'.$folder, $imageFile),
            'proposal' => 'files/'.$folder.'/default.pdf',
            'abstrak' => $this->faker->paragraphs(mt_rand(6,10),true),
            'created_at' => now()
        ];
    }
}
