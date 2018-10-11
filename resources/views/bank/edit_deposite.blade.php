@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Edit Bank Deposit</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  {{Form::model($read_bankdeposit,['files' => true,'method'=>'PATCH', 'action'=>['BankDepositController@update', $read_bankdeposit->id]])}}        
                        <label>Amount</label>
                        <input type="text" name="amount" value="{{$read_bankdeposit->amount}}" step="any" class="form-control number">

                        <label>Number</label>
                        <input type="text" name="voucher_number" value="{{$read_bankdeposit->voucher_number}}" class="form-control">

                        <label>Choose Bank</label>
                        <select class="form-control" name="bank_id">
                            <option></option>
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
                            @endforeach
                        </select>

                        <label>Deposited by</label>
                        <select class="form-control" name="deposited_by">
                            <option></option>
                            @foreach(App\User::all() as $users)
                              <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>

                        <label>Date of Deposit</label>
                        <input type="date" value="{{$read_bankdeposit->date}}" name="date" class="form-control">
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                   {{Form::close()}}                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection