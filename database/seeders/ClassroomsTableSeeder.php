<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Classroom;
use Faker\Factory as Faker;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Classroom::truncate();
        Schema::enableForeignKeyConstraints();
        $faker = Faker::create('vi_VN');
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            Classroom::create([
                'name' => $faker->colorName,
            ]);
        }
    }
}