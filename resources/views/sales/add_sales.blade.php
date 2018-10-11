@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Record sales</h1>
                        <a  href="{{route('sales.index')}}"  class="btn btn-primary">View Sales</a> 
                        <a  href="{{route('sales_report.create')}}" class="btn btn-primary">Generate report</a> 
                        <a  href="{{route('sales_barcodes.create')}}" class="btn btn-primary">Generate barcodes</a> 
                        <br><br>
                        <div class="col-md-4">
                            <label>Place the Computer Cursor here</label>
                            <input type="text" id="data" autofocus="true" class="form-control">                          
                            <br>
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
    <script type="text/javascript">  
        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 1500;  //time in ms, 1.5 second
        var $input = $('#data');

        //on keyup, start the countdown
        $input.on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function () {
          clearTimeout(typingTimer);
        });

        //Barcode scanner has "finished typing," do something
        function doneTyping () {
          //save the sale
          $('#display').text(" ");
            $.ajax({
                    type: "POST",
                    url: "{{ route('sales.store') }}",
                data: {
                     data: $("#data").val(),                           
                    _token: "{{Session::token()}}"
                },
                success: function(result){
                    $('#display').text(result);
                    $('#data').val(" ")                 
                  }
            })
        }
    </script>
@endpush
 