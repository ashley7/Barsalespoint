@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">               

                <div class="card-body">
                    <h1>Add Bank Deposit</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <form method="POST" action="{{route('bank_deposite.store')}}"> -->
                        @csrf           
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" step="any" class="form-control number">

                        <label>Voucher/Reciept Number</label>
                        <input type="text" id="voucher_number" class="form-control">

                        <label>Choose Bank</label>
                        <select class="form-control" id="bank_id" name="bank_id">
                            <option></option>
                            @foreach(App\Bank::all() as $banks)
                              <option value="{{$banks->id}}">{{$banks->name}}</option>
                            @endforeach
                        </select>

                        <label>Deposited by</label>
                        <select class="form-control" id="deposited_by" name="deposited_by">
                            @foreach(App\User::all() as $users)
                              <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach
                        </select>

                        <label>Date of Deposit</label>
                        <input type="date" name="date" id="date" class="form-control">
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
                url: "{{ route('bank_deposite.store') }}",
            data: {
                date: $("#date").val(),
                deposited_by: $("#deposited_by").val(),
                amount: $('#amount').val(),
                voucher_number: $('#voucher_number').val(),
                bank_id: $('#bank_id').val(),                        
                _token: "{{Session::token()}}"
            },
            success: function(result){
                alert(result)
                $('#amount').val(" ")
              }
        })
    });
</script>
@endpush