<?php

namespace Database\Seeders;

use App\Models\AccountName;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AccountNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the JSON file
        $json = File::get("database/seeders/data/account_names.json");
        $accountNames = json_decode($json, true);

        // Loop through each data and insert into the database
        foreach ($accountNames as $accountName) {
            AccountName::create([
                'id' => $accountName['id'],
                'name' => $accountName['name'],
                'parent_id' => $accountName['parent_id'],
                'account_type_id' => $accountName['account_type_id'],
                'created_at' => $accountName['created_at'],
                'updated_at' => $accountName['updated_at'],
            ]);
        }
    }
}
