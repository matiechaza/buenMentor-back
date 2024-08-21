<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('name' => 'English', 'code' => 'en'),
            array('name' => 'Arabic', 'code' => 'ar'),
            array('name' => 'Catalan', 'code' => 'ca'),
            array('name' => 'German', 'code' => 'de'),
            array('name' => 'Greek', 'code' => 'el'),
            array('name' => 'Spanish', 'code' => 'es'),
            array('name' => 'French', 'code' => 'fr'),
            array('name' => 'Armenian', 'code' => 'hy'),
            array('name' => 'Italian', 'code' => 'it'),
            array('name' => 'Japanese', 'code' => 'ja'),
            array('name' => 'Korean', 'code' => 'ko'),
            array('name' => 'Dutch', 'code' => 'nl'),
            array('name' => 'Polish', 'code' => 'pl'),
            array('name' => 'Portuguese', 'code' => 'pt'),
            array('name' => 'Russian', 'code' => 'ru'),
            array('name' => 'Swedish', 'code' => 'sv'),
            array('name' => 'Ukrainian', 'code' => 'uk'),
            array('name' => 'Chinese', 'code' => 'zh'),
        );

        DB::table('languages')->insert($data);
    }
}
