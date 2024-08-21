<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Belarus', 'code' => 'BY'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Bolivia', 'code' => 'BO'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Republica Dominicana', 'code' => 'DO'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Nicaragua', 'code' => 'NI'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Panama', 'code' => 'PA'],
            ['name' => 'Paraguay', 'code' => 'PY'],
            ['name' => 'Peru', 'code' => 'PE'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Puerto Rico', 'code' => 'PR'],
            ['name' => 'Russian Federation', 'code' => 'RU'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'España', 'code' => 'ES'],
            ['name' => 'Swaziland', 'code' => 'SZ'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Uruguay', 'code' => 'UY'],
            ['name' => 'Venezuela', 'code' => 'VE'],
        ];

        DB::table('countries')->insert($countries);
    }
}
