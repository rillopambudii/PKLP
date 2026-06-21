<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterLocation;

class MasterLocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'area' => 'Vessel',
                'location' => 'HCA',
                'name' => 'TB. Dignity',
                'type' => 'Vessel',
            ],
            [
                'area' => 'Vessel',
                'location' => 'HCA',
                'name' => 'TB. Fortune Paramon',
                'type' => 'Vessel',
            ],
            [
                'area' => 'Shore',
                'location' => 'Shore',
                'name' => 'Office',
                'type' => 'Shore',
            ],
            [
                'area' => 'Shore',
                'location' => 'Balikpapan',
                'name' => 'Head Office Balikpapan',
                'type' => 'Office',
            ],
        ];

        foreach ($locations as $location) {
            MasterLocation::create($location);
        }
    }
}