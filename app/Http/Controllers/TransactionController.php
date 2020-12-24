<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    protected $userRepository;
    protected $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function formCurrencyExchange()
    {
        $currentUser = $this->userRepository->getCurrentUser();

        return view('user.currency-exchange', compact('currentUser'));
    }

    public function formSendMoney()
    {
        $currentUser = $this->userRepository->getCurrentUser();
        $users = $this->userRepository->getAllWithoutCurrentUsers();

        return view('user.transfer-money', compact('currentUser', 'users'));
    }

    public function transferMoney(Request $request, $typeTransfer)
    {
        $currency = $request->input('currency');
        $transferValue = $request->input('inputValue');
        $outputValue = $request->input('outputValue');
        $currentUser = $this->userRepository->getCurrentUser();

        if($currentUser->balance < $transferValue){
            return back()
                ->with('msg', 'Non-sufficient funds')
                ->withInput();
        }else if($transferValue == 0){
            return back()
                ->with('msg', 'The entered value must not be zero 0')
                ->withInput();
        }

        if ($typeTransfer == 'card') {
            $this->userRepository->decrementMoneyUser($currentUser, $transferValue);

            $dataTransaction = [
                'user_id' => $currentUser->id,
                'recipient_id' => null,
                'description' => "exchanged for $outputValue $currency and transfer to the card",
            ];
            $this->transactionRepository->createTransaction($dataTransaction);

            return redirect()->route('home')->with('success', 'Exchange and transfer to the card success');

        } else if ($typeTransfer == 'user') {
            $recipientUser = $this->userRepository->getUserById($request->input('idRecipient'));

            DB::transaction(function () use ($transferValue, $currentUser, $recipientUser) {
                $this->userRepository->decrementMoneyUser($currentUser, $transferValue);
                $this->userRepository->incrementMoneyUser($recipientUser, $transferValue);
            }, 2);

            $dataTransaction = [
                'user_id' => $currentUser->id,
                'recipient_id' => $recipientUser->id,
                'description' => 'transfer money to the user'
            ];
            $this->transactionRepository->createTransaction($dataTransaction);

            return redirect()->route('home')
                ->with('success', 'Translation completed success');
        }
    }

}
