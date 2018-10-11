@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Add stock</h1>
                    <a href="{{route('stock.index')}}" style="float: right;" class="btn btn-primary">View Stock</a>

                        <div class="col-md-6">
                            <label>Name</label>
                            <select id="category_id" autofocus="true" class="form-control">
                                <option></option>
                                @foreach($category as $categories)
                                  <option value="{{$categories->id}}">{{$categories->name}}</option>
                                @endforeach
                            </select>

                            <br>
                            <a href="{{route('category.create')}}">Add name</a>
                            <br>

                            <label>Quantity</label>
                            <input type="number" step="any" id="quantity" class="form-control">

                            <label>Date stocked</label>
                            <input type="date" id="date_recorded" class="form-control">
                            <br><br>
                            <button class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                        <h3 id="display" style="color: green;"></h3>
                        <input type="hidden" class="number">
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script>
       $("#saveBtn").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('stock.store') }}",
            data: {
                quantity: $("#quantity").val(),                              
                date_recorded: $("#date_recorded").val(),
                category_id: $("#category_id").val(),                             
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    // alert(result)
                    $("#quantity").val(" ")
                    $("#date_recorded").val(" ")
                  }
        })
    });
  </script>
@endpush