<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $this->call([AdminUsersTableSeeder::class]);
        $this->call([PermissionTableSeeder::class]);
        $this->call([ MemberSeeder::class]); 
        $this->call([ SupportSeeder::class]);
        // $this->call([ ExecutiveSeeder::class]);
        // $this->call([ UserSeeder::class]);
        // $this->call([ VenueSeeder::class]);
        // $this->call([ EventSeeder::class]);
        // $this->call([ PartnerSeeder::class]);
    }
}
