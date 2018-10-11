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
                  <span class="right">
                    <a href="/bankreport" class="btn btn-primary">Generate Report</a>
                    <a class="btn btn-primary" href="{{route('bank_deposite.create')}}">Add bank Deposit</a>
                    
                  </span>
                  
                  <h1>{{$title}}</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php $total = 0; ?>
                 <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                          <th>#</th>  <th>Date</th>  <th>Deposited by</th> <th>Bank</th><th>Voucher / Reciept Number</th> <th>Amount</th> <th>Recorded by</th><th>Action</th>
                        </thead>

                        <tbody>
                          @foreach($deposits as $deposit)
                            <tr>
                              <td>{{$deposit->id}}</td>
                              <td>{{date('d-m-Y',$deposit->date)}}</td>
                              <td>{{App\User::find($deposit->deposited_by)->name}}</td>
                              <td>{{$deposit->bank->name}}</td>
                              <td>{{$deposit->voucher_number}}</td>
                              <td>{{number_format($deposit->amount)}}</td>
                               <td>{{$deposit->user->name}}</td>
                               <td>

                                 <form action="/bank_deposite/{{ $deposit->id }}" method="POST">
                                    {{method_field('DELETE')}}

                                    {{ csrf_field() }}
                                    <a href="{{route('bank_deposite.edit',$deposit->id)}}" class="btn btn-info">Edit</a>
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                </form>
                               </td>
                            </tr>
                            <?php $total = $total +  $deposit->amount;?>
                          @endforeach
                          <tr>
                             <th>Total</th> <th></th> <th></th> <th></th> <th></th> <th>{{number_format($total)}}</th> <th></th> <th></th>
                          </tr>                                                
                        </tbody>                      
                    </table>
                  </div>

                   <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="example">
                        <thead>
                          <th>#</th>  <th>Bank name</th>  <th>Total</th> 
                            @if(!empty($from))
                              <th></th>
                            @endif
                        </thead>               


                        <tbody>
                          @foreach($banks as $bank)
                            <tr>
                              <td>{{$bank->id}}</td>
                              <td>{{$bank->name}}</td>
                              @if(empty($from))
                                  <td>{{number_format(App\BankDeposit::all()->where('bank_id',$bank->id)->sum('amount'))}}</td>
                                @else
                                  <td>{{number_format(App\BankDeposit::where('bank_id',$bank->id)->whereBetween('date', [$from,$to])->sum('amount'))}}</td>

                                  <?php $id=$bank->id."_".$from."_".$to?>

                                  <td><a href="{{route('bank.edit',$id)}}">Show Details</a></td>
                                @endif

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
                        messageTop: ''
                    },
                    {
                        extend: 'pdf',
                        messageTop: ''
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