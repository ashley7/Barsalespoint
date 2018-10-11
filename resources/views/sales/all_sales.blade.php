@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>All Sales</h1>

                    <a href="{{route('sales.create')}}" style="float: right;" class="btn btn-primary">Create Sales</a>
                    <br><br>

                    <table class="table table-hover table-striped" id="example">
                        <thead>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Sold By</th>
                        </thead>

                        <tbody>
                            <?php $sum = 0; ?>
                            @foreach($sales as $sale)
                              <tr>
                                  <td>{{$sale->id}}</td>
                                  <td>{{date("d-M-Y",$sale->date_sold)}}</td>
                                  <td>{{$sale->name}}</td>
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
                                <th>{{number_format($sum)}}</th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                                           
                        
 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
     <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
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
              $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        messageTop: '{{$title}}'
                    },
                    {
                        extend: 'pdf',
                        messageTop: '{{$title}}'
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