<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
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
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $settings = [
            [
                'name'  => 'scroll_mode',
                'label' => 'Scroll Mode',
                'value' => 'twitter',
                'type'  => 'select',
            ],
            [
                'name'  => 'scroll_text',
                'label' => 'Scroll Text',
                'value' => null,
                'type'  => 'text',
            ],
            [
                'name'  => 'scroll_speed',
                'label' => 'Scroll Speed',
                'value' => 'marquee-off',
                'type'  => 'select',
            ],
            [
                'name'  => 'goal_mode',
                'label' => 'Goal Mode',
                'value' => 'goal',
                'type'  => 'select',
            ],
            [
                'name'  => 'max_tweets',
                'label' => 'Max tweets to store',
                'value' => 10,
                'type'  => 'number',
            ],
            [
                'name'  => 'twitter_search',
                'label' => 'Hashtag',
                'value' => '#yogscast',
                'type'  => 'text',
            ],
            [
                'name'  => 'total_display',
                'label' => 'Show Total',
                'value' => 0,
                'type'  => 'select',
            ],
        ];

        // Add any data to the table.
        DB::table('settings')->insert($settings);
    }
}
