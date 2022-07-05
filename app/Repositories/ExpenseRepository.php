<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Models\ExpenseTypes;
use Illuminate\Support\Facades\Auth;

class ExpenseRepository extends MainRepository
{
    private $expenseTypesModel;
    public function __construct(Expense $model, ExpenseTypes $expenseTypesModel)
    {
        $this->model = $model;
        $this->expenseTypesModel = $expenseTypesModel;

    }

    /**
     * List the expenses according to the filter parameters
     * @param int $userId
     * @param string $search
     * @param string $startDate
     * @param string $endDate
     * @param int $rows
     * @param string $orderBy
     * @param string $order
     * @param null $typeId
     * @return mixed
     */
    public function list(int $userId, string $search, string $startDate, string $endDate, int $rows, string $orderBy, string $order, $typeId = null)
    {
        if(!$startDate) {
            $startDate = '1500' . '-01' . '-01';
        }

        if(!$endDate) {
            $endDate = date('Y') . '-12' . '-31';
        }

        $expense = $this->model
            ->where('user_id', $userId)
            ->where('description', 'like', '%' . $search . '%')
            ->where(function ($query) use ($startDate, $endDate) {
               $query->whereDate('date', '>=', $startDate)
                   ->whereDate('date', '<=', $endDate);
            });

        if($typeId) {
            $expense->where('type_id', $typeId);
        }

        return $expense->orderBy($orderBy, $order)->paginate($rows);
    }

    /**
     * Find an expense that belongs to the auth user
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->where('user_id', Auth::id())->where('id', $id)->first();
    }

    /**
     * Update an expense
     * @param array $payload
     * @param int $id
     * @return mixed|null
     */
    public function update(array $payload, int $id)
    {
        $expense = $this->find($id);
        if(!$expense) return null;

        return $expense->update($payload);
    }

    /**
     * Delete and expense
     * @param int $id
     * @return null
     */
    public function delete(int $id)
    {
        $expense = $this->find($id);
        if(!$expense) return null;

        return $expense->delete();
    }

    public function fetchExpenseTypes()
    {
        return $this->expenseTypesModel->all();
    }
}
