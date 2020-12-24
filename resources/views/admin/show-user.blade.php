@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h3  class="balance">{{ $selectedUser->name }} - {{$selectedUser->email}}</h3>

                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Description</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userTransactions as $transactionUser)
                                <tr>
                                    <td>{{ $transactionUser->id }}</td>
                                    <td>{{ $transactionUser->description }}</td>
                                    <td>{{ isset($transactionUser->recipient->name) ? $transactionUser->recipient->name : '' }}</td>
                                    <td>{{ $transactionUser->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            @if($userTransactions->total() > $userTransactions->count())
                                <div class="row justify-content-center">
                                    {{ $userTransactions->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

