<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreateDefaultAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@filebank.com', 
                'password' => Hash::make('filebankadmin'), 
                'admin' => config('env.user.admin'), 
                'created_at' => Carbon::now()->toDateTimeString(), 
                'updated_at' => Carbon::now()->toDateTimeString(), 
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
