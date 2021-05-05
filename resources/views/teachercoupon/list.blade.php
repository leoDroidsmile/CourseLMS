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
        <h3><span class="h1 card-title float-left">@translate(Teacher Coupon Manager)</span></h3>
        <a class="btn btn-primary ml-3" href="{{ route("teachercoupon.index") }}" title="@translate(Add New Teacher Coupon Code)">
            <i class="fa fa-plus-circle"></i> @translate(Add New Teacher Coupon Code)
        </a>

        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control col-12"
                                   placeholder="@translate(Search by ID or name)"
                                   value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">@translate(Search)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


        <div class="card-body p-2">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@translate(S/L)</th>
                    <th>@translate(Group Name)</th>
                    <th>@translate(Code)</th>
                    <th>@translate(Status)</th>
                    <th>@translate(Teacher)</th>
                    <th>@translate(Course)</th>
                    {{-- <th>@translate(Used)</th> --}}
                    {{-- <th>@translate(By Student)</th> --}}
                    <th>@translate(Action)</th>
                    <th>@translate(Download)</th>
                    <th>@translate(Delete)</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($coupons as $coupon)
                    <tr>
                        <td>{{ $loop->index++ + 1 }}</td>
                        <td>{{ $coupon->group }}</td>
                        <td>{{ $coupon->code }}</td>
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
                        <td>{{ $coupon->instructorName()->name }}</td>
                        <td>{{ $coupon->courseTitle()->title }}</td>
                        {{-- <td>
                            @if($coupon->is_used)
                            <span class="badge badge-success p-2">Used</span></td>
                        @else
                            <span class="badge badge-warning p-2">Not Used</span></td>
                        @endif
                        </td> --}}
                        {{-- <td>{{ $coupon->student_id }}</td> --}}
                        <td>
                            <a href="#!" class="btn btn-primary"
                               onclick="forModal('{{ route('teachercoupon.edit', $coupon->id) }}', '@translate(Edit)')">
                               <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary ml-3" id="btn_download" style="float:right; color:white;" title="@translate(Download)" href="{{ route("teachercoupon.download", $coupon->id) }}">
                                <i class="fa fa-download"></i> 
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary ml-3" id="btn_delete" style="float:right; color:white;" title="@translate(Download)" href="{{ route("teachercoupon.delete", $coupon->id) }}">
                                <i class="fa fa-remove"></i> 
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <h4>@translate(NO TEACHER COUPON FOUND)</h4>
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





