<?php

use Illuminate\Database\Seeder;
use \App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Template::factory(50)->create();
    }
}
