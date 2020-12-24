<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = Auth::user();

        if($currentUser->role == User::ROLE_ADMIN){
            $transactions  = Transaction::all();
            return view('admin.transactions' ,compact('transactions'));
        }

        return view('user.home', compact('currentUser') );
    }

}
