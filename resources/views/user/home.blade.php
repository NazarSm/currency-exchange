@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                    <h3  class="balance">{{ $currentUser->balance }} ₴</h3>
                </div>
            </div>
            <a class="btn btn-outline-success"  href="{{route('form.currency.exchange')}}">Currency exchange</a>
            <a style="margin-left: 42px" class="btn btn-outline-primary" href="{{route('form.send.money')}}">Send money</a>
        </div>
    </div>
</div>
@endsection
