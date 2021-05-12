<div class="card-body">
    <form method="post" action="{{route('teachercoupon.update', $single_coupon->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(Coupon Code)</label>
            <input type="text" name="code" value="{{ $single_coupon->code }}" class="form-control"
                   placeholder="@translate(Coupon Code)" required>
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_published"
                   id="published" {{ $single_coupon->is_published == 1 ? 'checked' : '' }}>
            <label for="published">@translate(Is published?)</label>
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_used"
                   id="is_used" {{ $single_coupon->is_used == 1 ? 'checked' : '' }}>
            <label for="is_used">@translate(Is Used?)</label>
        </div>

        <div class="form-group">
            <label class="control-label">@translate(Select Instructor) <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control lang" name="user_id" id="select_instructor" required>
                    <option value=""></option>
                    @foreach($teachers as $item)
                        @if($single_coupon->user_id == $item->user_id)
                            <option value="{{$item->user_id}}" selected> {{$item->name}}</option>
                        @else
                            <option value="{{$item->user_id}}"> {{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">@translate(Select Course) <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control lang" name="course_id" id="select_course" required>
                    <option value=""></option>
                    @foreach($courses as $item)
                        @if($single_coupon->course_id == $item->id)
                            <option value="{{$item->id}}" selected> {{$item->title}}</option>
                        @else
                            <option value="{{$item->id}}"> {{$item->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">@translate(Submit)</button>

    </form>
</div>


<script type="text/javascript">
    $(function () {
        $("#select_instructor").change(function(){
            
            var url = "/api/v1/getCoursesWithInstructor";
            var user_id = $(this).val();
            
            $.ajax({
                url: url,
                method: 'GET',
                data: {user_id: user_id},
                success: function (result) {
                    console.log(result);
                    if(result.courses){
                        var html = '<option value=""></option>';
                        result.courses.forEach(element => {
                            html += '<option value="' + element.id + '">' + element.title + '</option>';
                        });
                        $("#select_course").html(html);
                    }
                }
            });
        });
    });

</script>

