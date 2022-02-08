<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseTypes;
use Illuminate\Database\Seeder;
use App\Models\User;
use Tests\Utilities;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        Utilities::generateStandards();

        Expense::factory(10)->create();

    }
}
