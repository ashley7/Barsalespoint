@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              

                <div class="card-body">

                    <h1>Generate barcodes</h1>

                    <form method="POST" action="{{route('sales_barcodes.store')}}">
                        @csrf
                      <!--   <label>Drink name</label>
                        <input type="tex" name="name" class="form-control">
                        <br>
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control number"> -->

                        <label>Number of cards</label>
                        <input type="number" step="any" name="number" class="form-control">

                        <br><br>
                        <button class="btn btn-primary">Generate</button>
                    </form>                 
                                       
 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection