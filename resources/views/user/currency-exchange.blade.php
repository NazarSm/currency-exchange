@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4  class="balance" >Balance: {{ $currentUser->balance }} ₴</h4>
                </div>
                <div class="card-body">
                    <h5 style=" text-align: center" >{{ __('Currency Exchange') }}</h5>

                    <form action="{{ route('transfer.money', ['card']) }}" method="POST" class="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div>
                            <label for="inputValue">Exchange</label>
                            <input id="inputValue"
                                   name="inputValue"
                                   type="number"
                                   step="0.01"
                                   value="{{ old('inputValue') }}"
                            >
                        </div>
                        <div>
                            <label for="currencyOutput">Currency</label>
                            <select class="currency"
                                    id="currency"
                                    style="margin-left: 4px; height: 29px; width: 168px;"
                                    name="currency"
                            >
                                <option value="{{ old('currency') }}" >{{ old('currency') }}</option>
                            </select>

                        </div>
                        <div>
                            <label for="outputValue">Getting</label>
                            <input id="outputValue"
                                   style="margin-left: 13px"
                                   name="outputValue"
                                   readonly
                            >

                        </div>

                        <button id="btn-submit"
                                type="submit"
                                class="btn btn-success"
                                disabled
                        >
                            Send to card
                        </button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
