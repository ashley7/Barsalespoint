@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Create a new work shift</h1>
 
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('work_shifts.index')}}" style="float: right;" class="btn btn-primary">View shifts</a>
                        <div class="col-md-6">
                            <form method="POST" action="{{route('work_shifts.store')}}">

                                @csrf
                              
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"> 
     
                                <label>Workers on shift</label>
                                <input type="text" name="description" class="form-control">

                                <br>
                                
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection