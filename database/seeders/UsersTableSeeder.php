<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        $faker = Faker::create('vi_VN');
        $limit = 100;
        for ($i = 0; $i < $limit; $i++) {
            User::create([
                'email' => preg_replace('/@example\..*/', '@gmail.com', $faker->unique()->safeEmail),
                'password' => Hash::make(12345678),
                'name' => $faker->userName,
                'address' => $faker->streetAddress,
                'phone' => $faker->numerify('0###-###-###'),
            ]);
        }
    }
}
