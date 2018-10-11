@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              
                <div class="card-body">
                    <h4>Add Expense account</h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::model($expense_account,['files' => true,'method'=>'PATCH', 'action'=>['ExpenseaccountController@update', $expense_account->id]])}}  
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" value="{{$expense_account->name}}" class="form-control">

                        <label>Description</label>
                        <input type="text" value="{{$expense_account->description}}" name="description" class="form-control">
                       
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    {{Form::close() }}                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection