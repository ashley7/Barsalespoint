@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Edit price tags</h1>
 
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" value="{{$read_tags->name}}" id="name" class="form-control"> 
 
                            <label>Scan the barcode</label>
                            <input type="text" id="barcode" value="{{$read_tags->barcode}}" class="form-control">

                            <label>Price</label>
                            <input type="text" id="price" value="{{$read_tags->price}}" class="form-control number">
                            <br><br>
                            <button class="btn btn-primary" id="saveBtn">Save</button>
                        </div>                       
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
                type: "PUT",
                url: "{{ route('price_tag.update',$read_tags->id) }}",
            data: {
                name: $("#name").val(),                           
                barcode: $("#barcode").val(),                           
                price: $("#price").val(),                           
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result)
                    $('#name').val(" ")
                  }
        })
    });
  </script>
@endpush

 