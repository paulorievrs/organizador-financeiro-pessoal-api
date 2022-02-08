<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\CreateExpenseRequest;
use App\Http\Requests\Expenses\UpdateExpenseRequest;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private ExpenseRepository $expenseRepository;
    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }


    /**
     * List all expenses according to the auth user and a custom filter
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $search = $request->search ?? '';
        $startDate = $request->start_date ?? '';
        $endDate = $request->end_date ?? '';
        $rows = $request->rows ?? 10;
        $orderBy = $request->orderBy ?? 'date';
        $order = $request->order ?? 'desc';
        $typeId = $request->type_id ?? null;

        $expenses = $this->expenseRepository->list($userId, $search, $startDate, $endDate, $rows, $orderBy, $order, $typeId);
        return response()->json($expenses);

    }

    /**
     * Create an expense according the request and using the auth user
     * @param CreateExpenseRequest $request
     * @return JsonResponse
     */
    public function create(CreateExpenseRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $payload['user_id'] = Auth::id();

        $created = $this->expenseRepository->create($payload);

        return response()->json($created);

    }

    /**
     * Create an expense according the request and using the auth user
     * @param UpdateExpenseRequest $request
     * @param int $expenseId
     * @return JsonResponse
     */
    public function update(UpdateExpenseRequest $request, int $expenseId): JsonResponse
    {
        $payload = $request->validated();

        $updated = $this->expenseRepository->update($payload, $expenseId);

        return response()->json($updated);

    }

    /**
     * Delete a expense of an user
     * @param int $expenseId
     * @return JsonResponse
     */
    public function delete(int $expenseId): JsonResponse
    {
        $deleted = $this->expenseRepository->delete($expenseId);
        return response()->json($deleted);
    }

}
