<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::create([
            "place"             => "Matara",
            "type"              => "Tsunami",
            "lat"               => 5.9549,
            "long"              => 80.5550,
            "level"             => "High",
            "description"       => "Tsunami came to Matara. everything has been destroyed",
            "reporter_id"       => 3,
            "verifier_id"       => 2,
            "status"            => true
        ]);

        Report::create([
            "place"             => "Colombo",
            "type"              => "Flood",
            "lat"               => 6.9271,
            "long"              => 79.8612,
            "level"             => "Guarded",
            "description"       => "Flood came to Colombo. everyone are safe.",
            "reporter_id"       => 3,
            "verifier_id"       => 2,
            "status"            => false
        ]);

    }
}
