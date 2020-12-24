<?php


namespace App\Repositories;


use App\Models\Transaction;

class TransactionRepository
{
    public function createTransaction($dataTransaction)
    {
        Transaction::create($dataTransaction);
    }
    public function gerTransactionById($id)
    {
        return Transaction::find($id);
    }

    public function getAllTransactions()
    {
        return Transaction::select()->orderBy('id','DESC')->paginate(10);
    }

    public function getAllTransactionsByUser($userId)
    {
        return Transaction::where('user_id', $userId)->orderBy('id','DESC')->paginate(10);
    }


}
