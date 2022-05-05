<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([

            'name'=> 'Anso  ',

            'email'=>'hermanann-sophie@hotmail.com',

            'email_verified_at'=> \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt(12345678),
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([

            'name'=> 'Mirko',

            'email'=>'mirkobekaert@hotmail.be',

            'email_verified_at'=> \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt(12345678),
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        User::factory()->count(20)->create();
    }
}
