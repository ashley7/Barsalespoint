@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <h1>Add Expense</h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <form method="POST" action="{{route('expense.store')}}"> -->
                        @csrf
                        <label>Transaction date</label>
                        <input type="date" name="date" id="date" class="form-control">

                        <label>Account</label>
                        <select class="form-control" id="expense_account_id" name="expense_account_id">
                            @foreach($account as $accounts)
                             <option value="{{$accounts->id}}">{{$accounts->name}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label>Particular</label>
                        <textarea class="form-control" id="particular" name="particular"></textarea>

                        <label>Amount</label>
                        <input type="text"  id="number" name="amount" step="any" class="form-control number">

                        <label>Voucher number</label>
                        <input type="text" name="voucher_number" id="voucher_number" class="form-control">

                        <label>Person name</label>
                        <input type="text" name="person_name" id="person_name" class="form-control">

                        <label>Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" step="any" class="form-control">
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
                url: "{{ route('expense.store') }}",
            data: {
                date: $("#date").val(),
                expense_account_id: $("#expense_account_id").val(),
                particular: $('#particular').val(),
                amount: $('#number').val(),
                voucher_number: $('#voucher_number').val(),
                person_name: $('#person_name').val(),
                phone_number: $('#phone_number').val(),                
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result)
                    $('#number').val(" ")
                    $('#particular').val(" ")
                  }
        })
    });
</script>
@endpush
 