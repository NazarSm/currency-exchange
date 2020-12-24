@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="balance">Balance: {{ $currentUser->balance }} ₴</h4>
                    </div>

                    <div class="card-body">
                        <h5 style=" text-align: center; margin-bottom: 20px" >{{ __('Transfer money') }}</h5>

                        <form action="{{ route('transfer.money', ['user']) }}" method="POST" class="form">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div>
                                <label for="inputValue">Sum</label>
                                <input type="number"
                                       step="0.01"
                                       id="inputValue"
                                       name="inputValue"
                                       value="{{ old('inputValue') }}"
                                       style="width: 3cm"> ₴

                                <label style="margin-left: 1cm" for="idRecipient">User</label>
                                <select style="width: 3cm; height: 0.8cm" name="idRecipient" id="idRecipient">
                                    @foreach($users as $user)
                                        {{-- there can be number of account or card  --}}
                                        <option  value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary"
                            >
                                Send
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
