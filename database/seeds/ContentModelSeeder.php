<?php

use Illuminate\Database\Seeder;

class ContentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ContentModel::class, 50)->create();
    }
}
