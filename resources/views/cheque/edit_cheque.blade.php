@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Edit Cheque dispatch</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::model($read_cheque,['files' => true,'method'=>'PATCH', 'action'=>['ChequeController@update',$read_cheque->id]])}}          
                        <label>Cheque number</label>
                        <input type="text" name="cheque_number" value="{{$read_cheque->cheque_number}}" class="form-control">
                        <br>
                        <label>Amount</label>
                        <input type="text" step="any" name="amount" value="{{$read_cheque->amount}}" class="form-control number">
                        <br>
                        <label>Particular</label>
                        <input type="text" name="particular" value="{{$read_cheque->particular}}" class="form-control">
                        <br>
                        <label>Date</label>
                        <input type="date" name="date" value="{{$read_cheque->date}}" class="form-control">
                        <br>
                        <label>Choose Bank</label>
                        <select class="form-control" name="bank_id">
                            <option></option>
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                     {{Form::close()}}                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection