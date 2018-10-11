@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Add Bank</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('bank.store')}}">
                        @csrf           
                        <label>Bank Name</label>
                        <input type="text" name="name" class="form-control">
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection