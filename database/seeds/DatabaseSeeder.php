<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->command->call('passport:install');
        if ($this->command->confirm('Do you wish to  seed real story')) {
            
            $this->call(DbRealStorySeeder::class);

            $this->command->info('Real story successfully seeded!');
        }else{

            $this->call(DbTableSeeder::class);

            $this->command->info('Dummy story successfully seeded!');
        }

    }
}
