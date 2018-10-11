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
                    <a class="btn btn-primary" href="{{URL('/cheque_report')}}">Report</a>
                    <a class="btn btn-primary" href="{{route('cheque.create')}}">Add Cheque</a>
                  </span>
                 

                  <h1>{{$title}}</h1>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

              

                <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-striped" id="expenses_table">
                        <thead>
                            <th>#</th> <th>Date</th> <th>Cheque Number</th> <th>Particular</th> <th>Amount</th> <th>Bank</th> <th>Recorded by</th> <th>Actions</th>
                        </thead>

                        <tbody>

                          @foreach($cheques as $cheque)
                            <tr>
                              <td>{{$cheque->id}}</td>
                              <td>{{date("d-M-Y",$cheque->date)}}</td>
                              <td>{{$cheque->cheque_number}}</td>
                              <td>{{$cheque->particular}}</td>
                              <td>{{number_format($cheque->amount)}}</td>
                              <td>{{$cheque->bank->name}}</td>
                              <td>{{$cheque->user->name}}</td>
                              <td>
                                  <form action="/cheque/{{ $cheque->id }}" method="POST">
                                    {{method_field('DELETE')}}

                                    {{ csrf_field() }}
                                    <a href="{{route('cheque.edit',$cheque->id)}}" class="btn btn-info">Edit</a>
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                </form>
                              </td>

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