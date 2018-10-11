@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">    
            <style type="text/css">
              .right{
                float: right;
              }
            </style>     

                <div class="card-body">
                  <a class="btn btn-primary right" href="{{route('expense.create')}}">Add Expense</a>
                  <h1>{{$title}}</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php $total=0; ?>
                    <table class="table table-hover table-striped" id="example">
                      <thead>
                        <th>Transaction date</th> <th>Voucher number</th> <th>Particular</th> <th>Expense account</th> <th>Name</th> <th>Phone</th> <th>Amount</th>
                      </thead>

                      <tbody>
                        @foreach($expense as $account)
                          <tr>
                              <td>{{date('d M Y',$account->date)}}</td>
                              <td>{{$account->voucher_number}}</td>
                              <td>{{$account->particular}}</td>
                              <td>{{$account->expenseaccount->name}}</td>
                              <td>{{$account->person_name}}</td>
                              <td>{{$account->phone_number}}</td>
                              <td>{{number_format($account->amount)}}</td>

                              <?php $total=$total+$account->amount; ?>
                          </tr>
                        @endforeach
                        <tr>
                            <th>Total</th> <th></th> <th></th> <th></th> <th></th> <th></th> <th><?php echo number_format($total) ?></th>
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
            var printCounter = 0;
         
            // Append a caption to the table before the DataTables initialisation
            $('#example').append('<caption style="caption-side: bottom">Powered by Appcellon ltd.</caption>');
         
            $('#example,#expenses_table').DataTable( {
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