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
//        factory(\App\User::class, 50)->create();
        //students seeding
        $schoolsClasses = \App\SchoolClass::all();
        foreach ($schoolsClasses as $schoolsClass){
            $schoolsClass->student()->createMany(
                factory(\App\Student::class, 20)->make()->toArray()
            );
        }
    }
}
