@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('price_tag.index')}}" style="float: right;" class="btn btn-primary">View Tags</a>
                    <br>

                    <h1>Add price tags</h1>
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('price_tag.store')}}">
                        @csrf
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">                            
                            <label>Normal Price</label>
                            <input type="text" name="normal_price" class="form-control number">

                            <label>VIP Price</label>
                            <input type="text" name="vip_price" class="form-control next_number">

                            <label>Scan the barcode</label>
                            <input type="text" name="barcode" class="form-control">
                            
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

 