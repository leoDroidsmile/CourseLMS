@extends('layouts.master')
@section('title','Instructor Account Setup')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')



<div class="card">

    <div class="card-header">
        <span class="h1 card-title">@translate(Coupon Manager)</span>

        <a class="btn btn-primary ml-3" href="{{ route("coupon.index") }}" title="@translate(Add New Coupon Code)">
            <i class="fa fa-plus-circle"></i> @translate(Add New Coupon Code)
        </a>

    </div>

        <!-- /.card-header -->
        <div class="card-body p-2 mt-2">
            <!-- Content starts here -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">

                        <div class="card">
        <div class="card-header">
            <h3 class="card-title">@translate(Coupon Informations)</h3>
        </div>
        <div class="card-body p-2">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@translate(S/L)</th>
                    <th>@translate(Code)</th>
                    <th>@translate(Discount)</th>
                    <th>@translate(Minimum Shopping)</th>
                    <th>@translate(Start Date)</th>
                    <th>@translate(End Date)</th>
                    <th>@translate(Status)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($coupons as $coupon)
                    <tr>
                        <td>{{ $loop->index++ + 1 }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ formatPrice($coupon->rate) }}</td>
                        <td>{{ formatPrice($coupon->min_value) }}</td>
                        <td>{{ $coupon->start_day }}</td>
                        <td>{{ $coupon->end_day }}</td>
                        <td>
                            <div class="form-group">
                                <div
                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input data-id="{{$coupon->id}}"
                                           {{$coupon->is_published == true ? 'checked' : null}}  data-url="{{route('coupon.activation')}}"
                                           type="checkbox" class="custom-control-input coupon_activation"
                                           id="is_published_{{$coupon->id}}">
                                    <label class="custom-control-label" for="is_published_{{$coupon->id}}"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#!" class="btn btn-primary"
                               onclick="forModal('{{ route('coupon.edit', $coupon->id) }}', '@translate(Edit)')">@translate(Edit)
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <h4>@translate(NO COUPON FOUND)</h4>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

                    </div>
                </div>
            </div>
            <!-- Content starts here:END -->
        </div>

    </div>

@endsection



@section('js-link')

@stop

@section('page-script')

<script>
    // Coupon activation
$(".coupon_activation").on("change", function () {
    var url = this.dataset.url;
    var id = this.dataset.id;

    if (url != null && id != null) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            data: { id: id },
            method: "POST",
            success: function (result) {
                //notification
                notification(result);
            },
        });
    }
});
</script>

@stop





