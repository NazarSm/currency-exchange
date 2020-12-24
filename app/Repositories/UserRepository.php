<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getCurrentUser()
    {
       return Auth::user();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public  function getAllWithoutCurrentUsers()
    {
        $currentUser = $this->getCurrentUser();
        $admin = User::firstWhere('role', User::ROLE_ADMIN);

        return User::whereNotIn('id',[$currentUser->id, $admin->id] )
            ->get();
    }

    public function decrementMoneyUser($user, $sum)
    {
        $user->decrement('balance', $sum);
    }

    public function incrementMoneyUser($user, $sum)
    {
        $user->increment('balance', $sum);
    }
}
