@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Confirm account</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     <form method="POST" action="{{URL('account_confirmation')}}">
                        @csrf
                         <label>ENter the 6 digit figure sent to your phone or Email</label>
                         <input type="number" name="code" class="form-control">
                         <br><br>
                         <button type="submit">Okay</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
