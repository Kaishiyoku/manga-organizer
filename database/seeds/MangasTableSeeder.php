<?php

use App\Models\Volume;
use Illuminate\Database\Seeder;

class MangasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxNumberOfVolumes = 100;

        factory(App\Models\Manga::class, 10)->create()->each(function ($manga) use ($maxNumberOfVolumes) {
            for ($i = 1; $i <= rand(5, $maxNumberOfVolumes); $i++) {
                $volume = new Volume(['no' => $i]);

                $manga->volumes()->save($volume);
            }
        });
    }
}
