<?php

use App\Services\Donating\Models\Donation;
use App\Services\Donating\Models\Total;
use App\Services\Tweeting\Models\Tweet;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('donations')->truncate();
        DB::table('donation_totals')->truncate();
        DB::table('tweets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Total::create([
            'raised' => 4263,
            'reason' => 'Starting total',
        ]);

        // Donations
        for ($i = 0; $i < 50; $i++) {
            $data = [
                'hb_id'         => $faker->uuid,
                'amount'        => $faker->numberBetween(1, 1500),
                'name'          => $faker->userName,
                'email'         => $faker->email,
                'comment'       => $faker->paragraph(2),
                'hb_created_at' => $faker->dateTime->format('Y-m-d H:i:s'),
            ];

            Donation::create($data);

            $data = [
                'twitter_id'         => $faker->numberBetween(1, 20000),
                'text'               => $faker->text(140),
                'name'               => $faker->userName,
                'twitter_created_at' => $faker->dateTime->format('Y-m-d H:i:s'),
            ];

            Tweet::create($data);
        }
    }
}
