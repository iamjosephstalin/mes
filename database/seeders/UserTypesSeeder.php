<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
  /**
   * Insert the data in the user_types table.
   *
   * @return void
   */
  public function run()
  {
    $userTypes = [
      ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Worker', 'created_at' => now(), 'updated_at' => now()],
    ];
    DB::table('user_types')->insert($userTypes);
  }
}
