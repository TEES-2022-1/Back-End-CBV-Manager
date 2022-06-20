<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dir = dir(__DIR__);
        $currentFile = basename(__FILE__);
        $seeders = [];
        while($file = $dir->read()){
            if (Str::endsWith($file, ".php") && $file != $currentFile) {
                $classname = "Database\\Seeders\\" . str_replace(".php", "", $file);
                if (class_exists($classname)) {
                    $seeders[] = $classname;
                }
            }
        }

        $this->call($seeders);
    }
}
