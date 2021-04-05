<div class="card-body">
    <form method="post" action="{{route('coupon.update', $single_coupon->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(Coupon Code)</label>
            <input type="text" name="code" value="{{ $single_coupon->code }}" class="form-control"
                   placeholder="@translate(Coupon Code)" required>
        </div>

        <div class="form-group">
            <label>@translate(Discount Amount)</label>
            <input type="number" name="rate" value="{{ $single_coupon->rate }}" min="0" step="0.01" class="form-control"
                   placeholder="@translate(Discount Amount)" required>
        </div>

        <div class="form-group">
            <label>@translate(Starting Date)</label>
            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                <input type="text" name="start_day" value="{{ $single_coupon->start_day }}"
                       class="form-control datetimepicker-input" data-target="#datetimepicker3"
                       placeholder="@translate(Starting Date)" required/>
                <div class="input-group-append form-group" data-target="#datetimepicker3" data-toggle="datetimepicker">
                    <div class="input-group-text form-group p-10"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>@translate(Ending Date)</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input type="text" name="end_day" value="{{ $single_coupon->end_day }}"
                       class="form-control datetimepicker-input" data-target="#datetimepicker4"
                       placeholder="@translate(Ending Date)" required/>
                <div class="input-group-append form-group" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text form-group p-10"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>@translate(Minimum Shopping Amount)</label>
            <input type="number" name="min_value" value="{{ $single_coupon->min_value }}" class="form-control" min="0"
                   placeholder="@translate(Minimum Shopping Amount)" required>
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_published"
                   id="published" {{ $single_coupon->is_published == 1 ? 'checked' : '' }}>
            <label for="published">@translate(Is published?)</label>
        </div>

        <button type="submit" class="btn btn-primary">@translate(Submit)</button>

    </form>
</div>

@section('script')
    <script type="text/javascript" src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <link type="text/javascript" src="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}"/>
    <script type="text/javascript">
        "use strict"
        $(function () {
            $('#datetimepicker3, #datetimepicker4').datetimepicker();
        });
    </script>
@endsection
