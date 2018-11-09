@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
       
            <div class="card">
                <div class="card-body">                   
                        <a  href="{{route('sales.index')}}"  class="btn btn-primary">View Sales</a> 
                        <a  href="{{route('sales_report.create')}}" class="btn btn-info">Generate report</a> 
                        <a  href="{{route('price_tag.create')}}" class="btn btn-danger">Record price tags</a> 
                        <a  href="{{route('sales_barcodes.create')}}" class="btn btn-success">Generate barcodes</a> 
                        <br><br>
                         <h1>Record sales</h1>

                  
                    <div class="row">     
                        <div class="col-md-6">
                            <label>Place the Computer Cursor here</label>
                            <input type="text" id="data" required="required" autofocus="true" class="form-control">

                            <label>Quantity</label>
                            <input type="number" id="size" required="required" value="1" step="any" class="form-control">

                            <label>Choose class</label>
                            <select id="class_price" required="required" class="form-control">
                                                              
                                <option value="Normal">Normal</option>
                                <option value="VIP">VIP</option>
                            </select>

                            <input type="hidden" class="number">
                            <br><br>
                            <button class="btn btn-primary" id="btnsave">Save</button>
                        </div>

                        <div class="col-md-6">

                            <h1 id="prices" style="color: green;"></h1>
                           
                        </div>
                    </div>
                  
                        <h3 id="display" style="color: green;"></h3>
                        <input type="hidden" class="number">
                 </div>
            </div>
       
    </div>
</div>
@endsection

@push('scripts')

    <script type="text/javascript">  
        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 100;
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
                    url: "{{url('/price_tags')}}",
                data: {
                     data: $("#data").val(),                           
                    _token: "{{Session::token()}}"
                },
                success: function(result){
                    $('#prices').html(result);
                     // typingTimer = setTimeout(save_beer,3000);                              
                  }
            })
        }
    </script>

    <script type="text/javascript">  
         $('#display').text(" ");
         $('#prices').text(" ");
         $("#btnsave").click(function() {
            $.ajax({
                    type: "POST",
                    url: "{{ route('sales.store') }}",
                data: {
                     data: $("#data").val(),
                     size: $("#size").val(),                        
                     class_price: $("#class_price").val(),                         
                    _token: "{{Session::token()}}"
                },
                success: function(result){
                    $('#display').text(result);
                    $('#data').val(" ")
                    size: $("#size").val(1)
                    $("#data").show().focus();
                    typingTimer = setTimeout(donedisplaying,10000);           
                  }
              })  
            });

         function donedisplaying(){
            $('#display').text(" ");
            $('#prices').text(" ");
         }

         // function save_beer(){
         //       $.ajax({
         //            type: "POST",
         //            url: "{{ route('sales.store') }}",
         //        data: {
         //             data: $("#data").val(),
         //             size: $("#size").val(),                         
         //             class_price: $("#class_price").val(),                         
         //            _token: "{{Session::token()}}"
         //        },
         //        success: function(result){
         //            $('#display').text(result);
         //            $('#data').val(" ")
         //            typingTimer = setTimeout(donedisplaying,3000);                 
         //          }
         //      })
         // }
    </script>
@endpush
 