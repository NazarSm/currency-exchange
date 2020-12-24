<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepository;
    protected $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = $this->userRepository->getCurrentUser();

        if($currentUser->role == User::ROLE_ADMIN){
            $transactions  = $this->transactionRepository->getAllTransactions();
            return view('admin.transactions' ,compact('transactions'));
        }

        return view('user.home', compact('currentUser') );
    }

}
