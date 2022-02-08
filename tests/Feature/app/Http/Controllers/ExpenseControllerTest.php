<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Utilities;

class ExpenseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_auth_user_view_expenses()
    {
        $headers = Utilities::getAuthHeaders(true);
        Utilities::generateStandards();
        Expense::factory(3)->create();

        $response = $this->get('/api/expenses', $headers);

        $response->assertOk();
    }

    public function test_auth_user_create_expenses()
    {
        $headers = Utilities::getAuthHeaders(true);
        Utilities::generateStandards();

        $expense = [
            'description' => $this->faker->realText(20),
            'value' => $this->faker->randomDigitNotNull(),
            'type_id' => ExpenseTypes::all()->random(1)->first()->id,
            'is_archived' => $this->faker->boolean(),
            'date' => $this->faker->date(),
            'deadline' => $this->faker->date(),
        ];

        $response = $this->post('/api/expenses', $expense, $headers);
        $response->assertOk();
        $expenseResponse = Expense::find($response->json()['id'])->toArray();
        $this->assertNotNull($expenseResponse);
    }

    public function test_auth_user_update_expenses()
    {
        $headers = Utilities::getAuthHeaders(true);
        Utilities::generateStandards();

        Expense::factory(1)->create();

        $expense = Expense::all()->first();
        $expenseId = $expense->id;

        $payload = [
            'description' => $this->faker->realText(20),
        ];

        $response = $this->put("/api/expenses/$expenseId", $payload, $headers);

        $response->assertOk();
        $this->assertTrue($response->json());
        $expense = Expense::find($expenseId);
        $this->assertTrue($expense['description'] === $expense->description);
    }

    public function test_delete_expense()
    {
        $headers = Utilities::getAuthHeaders(true);
        Utilities::generateStandards();

        Expense::factory(5)->create();
        $beforeDeleteSize = Expense::all()->count();

        $expense = Expense::all()->random(1)->first();

        $response = $this->delete("/api/expenses/$expense->id", [], $headers);
        $response->assertOk();

        $this->assertDatabaseCount('expenses', $beforeDeleteSize - 1);
        $this->assertDatabaseMissing('expenses', $expense->toArray());

    }
}
