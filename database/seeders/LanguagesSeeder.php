<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
  /**
   * Insert the data in the languages table.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      ['name' => 'English', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Español', 'created_at' => now(), 'updated_at' => now()],
    ];
    DB::table('languages')->insert($data);
  }
}
