@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">        
        @foreach($barcodes as $codes)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <center>

                        <?php echo $codes ?>

                        </center>
                         
                     </div>
                       
                </div>
            </div>
        @endforeach

        </div>
    </div>
@endsection