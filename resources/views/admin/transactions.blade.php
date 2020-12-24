@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h3  class="balance">Transactions</h3>

                        <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Description</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td><a href="{{route('show.user', [$transaction->user_id])}}">{{ $transaction->user->name }}</a></td>
{{--                                <td>{{ $transaction->user->name }}</td>--}}
                                <td>{{ $transaction->description }}</td>
                                <td>{{ isset($transaction->recipient->name) ? $transaction->recipient->name : '' }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>

                        <div class="text-center">
                            @if($transactions->total() > $transactions->count())
                                <div class="row justify-content-center">
                                    {{ $transactions->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
