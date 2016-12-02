<?php

use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_access')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1 = Guest
        // 2 = Streamer
        // 3 = Admin

        $accessLevels = [
            [
                'email'  => 'stygian.warlock.v2@gmail.com',
                'role_id' => 3,
            ],
            [
                'email'  => 'dylanakhawais@live.co.uk',
                'role_id' => 3,
            ],
            [
                'email'  => 'gibbs@yogscast.com',
                'role_id' => 3,
            ],
            [
                'email'  => 'harry@yogscast.com',
                'role_id' => 3,
            ],
            [
                'email'  => 'mark@yogscast.com',
                'role_id' => 3,
            ],
            [
                'email'  => 'lewisbrindley@gmail.com',
                'role_id' => 3,
            ],
        ];

        // Add any data to the table.
        DB::table('user_access')->insert($accessLevels);
    }
}
