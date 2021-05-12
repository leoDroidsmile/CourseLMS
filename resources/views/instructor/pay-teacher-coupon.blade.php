<div class="card-body">
    <form action="{{route('instructors.payTeacherCoupons')}}" method="post">
        @csrf
        <div class="form-group">
            <label>@translate(Teacher Coupon Count) <span class="text-danger">*</span></label>
            <input class="form-control" name="count" type="number" placeholder="@translate(Teacher Coupon Count)" required>
        </div>
        <input class="form-control" name="instructor_id" type="hidden" value="{{$instructor_id}}">
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>
    </form>
</div>



