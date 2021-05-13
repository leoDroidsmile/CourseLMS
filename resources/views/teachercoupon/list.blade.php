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
        <h3>@translate(Teacher Coupon Manager)</h3>
        <a class="btn btn-primary ml-3" href="{{ route("teachercoupon.index") }}" title="@translate(Add New Teacher Coupon Code)">
            <i class="fa fa-plus-circle"></i> @translate(Add New Teacher Coupon Code)
        </a>
        <a class="btn btn-primary ml-3" href="{{ route("teachercoupon.delete.all") }}" title="@translate(Delete All Teacher Coupons)">
            <i class="fa fa-remove"></i> @translate(Delete All Teacher Coupons)
        </a>

        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control col-12"
                                   placeholder="@translate(Search by ID or Coupon)"
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
                    <th>@translate(Used)</th>
                    <th>@translate(Student)</th>
                    <th>@translate(Action)</th>
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
                        <td>
                            @if($coupon->is_used)
                            <span class="badge badge-warning p-2">Used</span></td>
                        @else
                            <span class="badge badge-success p-2">Not Used</span></td>
                        @endif
                        </td>
                        <td>
                            @if($coupon->is_used && $coupon->student())
                                {{ $coupon->student()->name }}
                            @endif
                        </td>
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button" id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn" aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" onclick="forModal('{{ route('teachercoupon.edit', $coupon->id) }}', '@translate(Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item" href="{{ route("teachercoupon.download", $coupon->id) }}">
                                            <i class="fa fa-download mr-2"></i>@translate(Download)</a>
                                        <a class="dropdown-item" onclick="confirm_modal('{{ route('teachercoupon.delete', $coupon->id) }}')">
                                            <i class="fa fa-remove mr-2"></i>@translate(Delete)</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
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





