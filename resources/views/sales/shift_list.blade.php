@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>All shifts</h1>

                    <a class="btn btn-primary" style="float: right;" href="{{route('work_shifts.create')}}">Add new shift</a>
                    <br><br>
                    
                    <table class="table table-hover table-striped" id="example">
                        <thead>
                            <th>Date created</th>
                            <th>Name</th>
                            <th>Workers</th>
                            <th>Created by</th>
                            <th>Action</th>                            
                        </thead>

                        <tbody>                         
                            @foreach($work_shift as $shifts)
                              <tr>
                                  <td>{{$shifts->created_at}}</td>
                                  <td>{{$shifts->name}}</td>
                                  <td>{{$shifts->description}}</td>                                  
                                  <td>{{$shifts->user->name}}</td> 
                                  <td>
                                    <a class="btn btn-success" href="{{route('work_shifts.show',$shifts->id)}}">Details</a>
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