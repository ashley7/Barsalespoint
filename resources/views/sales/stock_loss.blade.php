@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                 

                    <h1>Add stock loss</h1>

                    <a href="{{route('stock_loss.index')}}" style="float: right;" class="btn btn-primary"> Stock losses</a>
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('stock_loss.store')}}">
                        @csrf
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">

                            <label>Quntity</label>
                            <input type="number" step="any" name="size" class="form-control">

                            <label>Reason</label>
                            <input type="text" name="description" class="form-control">

                            <label>Shift</label>
                            <select name="workshift_id" class="form-control">
                                @foreach($record_check as $shifts)
                                  <option value="{{$shifts->id}}">{{$shifts->name}},{{$shifts->description}}, {{$shifts->date}}</option>
                                @endforeach
                            </select> 
                            
                            <br><br>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                         
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

 