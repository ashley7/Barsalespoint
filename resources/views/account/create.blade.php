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

                    <form method="POST" action="{{route('account.store')}}">
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">

                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection