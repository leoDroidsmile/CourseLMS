<div class="card-body">
    <form action="{{route('instructors.pay')}}" method="post">
        @csrf
        <div class="form-group">
            <label>@translate(Amount) <span class="text-danger">*</span></label>
            <input class="form-control" name="amount" type="number" placeholder="@translate(Pay Amount)" required>
        </div>
        <input class="form-control" name="instructor_id" type="hidden" value="{{$instructor_id}}">
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Pay)</button>
        </div>
    </form>
</div>



