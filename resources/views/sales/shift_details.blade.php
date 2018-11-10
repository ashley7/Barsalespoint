@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="text-transform: uppercase;">{{$work_shifts->name}} {{$work_shifts->description}} {{$work_shifts->date}}</h3>
 
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#sales">Sales</a></li>
                      <li><a data-toggle="tab" href="#stock">Stock</a></li>
                      <li><a data-toggle="tab" href="#bottles">Spoilt bottles</a></li>
                    </ul>

                <div class="tab-content">
                    <div id="sales" class="tab-pane fade in active">
                        <table class="table table-hover table-striped" id="sales_table">
                            <thead>
                                <th>#</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Sold By</th>
                            </thead>

                            <tbody>
                                <?php $sum = 0; ?>
                                @foreach($sales as $sale)
                                  <tr>
                                      <td>{{$sale->id}}</td>
                                      <td>{{$sale->created_at}}</td>
                                      <td>{{$sale->name}}</td>
                                      <td>{{$sale->size}}</td>
                                      <td>{{number_format($sale->amount)}}</td>
                                      <td>{{$sale->user->name}}</td>
                                  </tr>

                                  <?php
                                     $sum = $sum + $sale->amount;
                                   ?>
                                @endforeach

                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{number_format($sum)}}</th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                             
                        </div>

                        <div id="stock" class="tab-pane fade in">
                             <table class="table table-hover table-striped" id="stock_table">
                                 <thead>
                                     <th>Name</th> <th>Old stock</th> <th>New stock</th> <th>Initial stock</th> <th>Total Sold</th> <th>Stock left</th>
                                 </thead>

                                 <tbody>
                                     @foreach($brands as $brand)
                                     <?php
                                        $record_check = App\ShiftStock::all()->where('number',$brand->barcode)->where('workshift_id',$work_shifts->id)->last(); 

                                        $sum_sold = App\Sale::all()->where('workshift_id',$work_shifts->id)->where('number',$brand->barcode)->sum('size');

                                        $initial_stock = $record_check->old_stock + $record_check->new_stock;
                                    ?>
                                    @if(!empty($record_check))
                                     <tr>
                                       <td>{{$brand->name}}</td>

                                       <td contenteditable="true" id="{{$brand->barcode}}*old_stock">{{$record_check->old_stock}}</td>

                                       <td contenteditable="true" id="{{$brand->barcode}}*new_stock">{{$record_check->new_stock}}</td>
                                       <td>{{$initial_stock}}</td>
                                       <td>{{$sum_sold}}</td>
                                       <td>{{$initial_stock - $sum_sold}}</td>
                                   </tr>

                                   @else

                                    <tr>
                                       <td>{{$brand->name}}</td>

                                       <td contenteditable="true" id="{{$brand->barcode}}*old_stock"></td>

                                       <td contenteditable="true" id="{{$brand->barcode}}*new_stock"></td>

                                       <td></td>
                                       <td></td>
                                       <td></td>
                                   </tr>


                                   @endif
                                     @endforeach
                                 </tbody>
                             </table>

                             <input type="hidden" id="shift" value="{{$work_shifts->id}}">
                        </div>

                        <div id="bottles" class="tab-pane fade in">
                            <table class="table table-hover table-striped" id="loss">
                              <thead>
                                <th>Date created</th>  <th>Name</th> <th>Size</th> <th>Details</th> <th>Recorded by</th>
                              </thead>

                              <tbody>
                                @foreach($stock_loss as $losses)
                                  <tr>
                                    <td>{{$losses->created_at}}</td>  <td>{{$losses->name}}</td> <td>{{$losses->size}}</td> <td>{{$losses->description}}</td> <td>{{$losses->user->name}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">      
      $("td[contenteditable=true]").blur(function() {
         $.ajax({
          
                type: "POST",
                url: "{{ route('shift_stock.store') }}",
            data: {
                information: $(this).attr("id"),
                stock_value: $(this).text(),
                shift: $("#shift").val(),
                _token: "{{Session::token()}}"
            },
          success: function(result){
            if (result) {
              console.log(result);
            }           
                
          },
          
        })
    });
  </script>


     <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
     <script>
       $(document).ready(function() {
              $('#sales_table,#stock_table,#loss').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                     },
                    {
                        extend: 'pdf',
                     },
                    {
                        extend: 'print',
                        messageTop: null
                    }
                ]
            } );
        } );
    </script>
@endpush