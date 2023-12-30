<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    Schema::disableForeignKeyConstraints();
    if (Schema::hasTable('languages')) {
        DB::table('languages')->truncate();
        DB::table('languages')->insert($data);
    }
    Schema::enableForeignKeyConstraints();
  }
}
