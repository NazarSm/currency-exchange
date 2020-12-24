<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userRepository;
    protected $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;

    }

    public function indexUsers()
    {
        $users = $this->userRepository->getAllWithoutCurrentUsers();
        return view('admin.users', compact('users'));

    }

    public function showUser($userId)
    {
        $selectedUser = $this->userRepository->getUserById($userId);
        $userTransactions = $this->transactionRepository->getAllTransactionsByUser($userId);

        return view('admin.show-user', compact('selectedUser', 'userTransactions'));
    }
}
