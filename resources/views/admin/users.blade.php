@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3  class="balance">Users</h3>

                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Date registration</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{route('show.user', [$user->id ])}}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->balance }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                       {{-- <div class="text-center">
                            @if($users->total() > $users->count())
                                <div class="row justify-content-center">
                                    {{ $users->links() }}
                                </div>
                            @endif
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
