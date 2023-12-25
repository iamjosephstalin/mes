<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypesSeeder extends Seeder
{
  /**
   * Insert the data in the account_types table.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      ['name' => 'Worker', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Client', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Admin(OV)', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Production plan view', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Office', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Foreman', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Constructor CAD/CAM', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Sales Rep.', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Production Manager', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Production Manager without TNA', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Team Leader', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Warehouseman', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Manager without TNA', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Orders view only without TNA', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Technologer', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Production view only', 'created_at' => now(), 'updated_at' => now()],
    ];
    DB::table('account_types')->insert($data);
  }
}
