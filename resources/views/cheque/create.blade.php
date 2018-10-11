@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Add Cheque dispatch</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <form method="POST" action="{{route('cheque.store')}}"> -->
                        @csrf           
                        <label>Cheque number</label>
                        <input type="text" id="cheque_number" name="cheque_number" class="form-control">
                        <br>
                        <label>Amount</label>
                        <input type="text" step="any" name="amount" id="amount" class="form-control number">
                        <br>
                        <label>Particular</label>
                        <input type="text" name="particular" id="particular" class="form-control">
                        <br>
                        <label>Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                        <br>
                        <label>Choose Bank</label>
                        <select class="form-control" id="bank_id" name="bank_id">
                            <option></option>
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button class="btn btn-primary" id="saveBtn" type="submit">Save</button>
                    <!-- </form>                   -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $("#saveBtn").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('cheque.store') }}",
            data: {
                date: $("#date").val(),
                cheque_number: $("#cheque_number").val(),
                particular: $('#particular').val(),
                amount: $('#amount').val(),
                bank_id: $('#bank_id').val(),                        
                _token: "{{Session::token()}}"
            },
            success: function(result){
                alert(result)
                $('#amount').val(" ")
                $('#particular').val(" ")
              }
        })
    });
</script>
@endpush