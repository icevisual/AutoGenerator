<?php
namespace App\Extensions\DataSeeder\Seeds;

use App\Extensions\DataSeeder\SeedsFactory;

class StringSeeds implements SeedsFactory
{

    /**
     * Generate random phone number
     *
     * @return string
     */
    public function randomString()
    {
        return \Illuminate\Support\Str::random();
    }
    
    public function newSeed()
    {
        return $this->randomString();
    }

    public function destoryAllSeed(array $seeds)
    {}
}