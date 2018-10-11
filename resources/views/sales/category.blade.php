@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Add category</h1>
                    <a href="{{route('stock.create')}}">Add stock</a>
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" id="name" autofocus="true" class="form-control">                          
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
                url: "{{ route('category.store') }}",
            data: {
                name: $("#name").val(),                              
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    // alert(result)
                    $('#name').val(" ")
                  }
        })
    });
  </script>
@endpush