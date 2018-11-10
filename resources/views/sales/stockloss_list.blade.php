@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              
                <div class="card-body">
                    <h1>All Stock losses</h1>

                    <a href="{{route('stock_loss.create')}}" style="float: right;" class="btn btn-primary">Add Stock loss</a>
                    <br><br>

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
              $('#loss').DataTable( {
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