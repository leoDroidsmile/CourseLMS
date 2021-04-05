<div class="card-body">
    <h3><b>@translate(Your Current Balance is) : {{formatPrice($affiliate->balance)}}</b></h3>
    <form action="{{route('student.payments.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="status" value="Request">
        <div class="form-group">
            <label>@translate(Withdrawal Amount) <span class="text-danger">*</span></label>
            <input class="form-control" type="number" min="0" max="{{$affiliate->balance}}" name="amount" required>
        </div>
        <div class="form-group">
            <label>@translate(Payment Process) <span class="text-danger">*</span></label>
            <select class="form-control lang select2" name="process" required>
                <option value="">@translate(Select The Payment Method)</option>
                <option value="Bank">@translate(Bank)</option>
                <option value="Paypal">@translate(Pay Pal)</option>
                <option value="Stripe">@translate(Stripe)</option>

            </select>
        </div>
        <div class="form-group">
            <label>@translate(Description)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>




