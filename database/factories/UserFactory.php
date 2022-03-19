<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->unique()->safeEmail();
        $username = Str::beforeLast($email,'@'); 
        $i=1;
        do{
            if(User::where('username', $username)->exists()){
                $username = $username."(".$i.")";
                $i++;
            }
        }while(User::where('username', $username)->exists());

        return [
            'name' => $this->faker->name(),
            'username' => $username,
            'email' => $email,
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => bcrypt('coba'),
            'role_id' => $this->faker->numberBetween(2,6),
            'phone' => $this->faker->phoneNumber(),
            'photo' => 'profil/avatar-'.$this->faker->numberBetween(1,5).'.png',
            'nip' => $this->faker->numerify('##################'),
            'is_active' => 1,
            'wilayah_id' => $this->faker->randomElement(['1', '6']),
            'last_login' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ];  
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
