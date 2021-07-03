<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateDefaultAdminUser::class);
    }
}
