<form action="{{route('quiz.update')}}" method="post"  enctype="multipart/form-data">
    <input name="id" type="hidden" value="{{$quiz->id}}">
    <input name="status" type="hidden" value="{{$quiz->status}}">
    @csrf
    <div class="row">
        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Quiz Name) <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" required
                       value="{{ $quiz->name }}"
                       class="form-control"
                       name="name" placeholder="@translate(Enter Quiz Name)" aria-required="true" autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Quiz Time)(Minutes) Ex:10</label>
            <div class="">
                <input type="number"
                       value="{{$quiz->quiz_time}}"
                       class="form-control"
                       name="quiz_time" placeholder="@translate(Default infinity)" aria-required="true"
                       autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Pass Mark)</label>
            <div class="">
                <input type="number" step="0.01" required
                       value="{{$quiz->pass_mark}}"
                       class="form-control"
                       name="pass_mark" placeholder="@translate(Pass Mark)" aria-required="true" autofocus>
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-provider">@translate(Select Course) </label>
            <div class="col-lg-9">
                <select class="form-control" name="course_id" required>
                    <option value="">@translate(Select Course)</option>
                    @foreach($courses as $course)
                        <option value="{{$course->id}}" {{$quiz->course_id == $course->id ? 'selected' : null}}>{{$course->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>
    <button class="btn btn-outline-success" type="submit"> @translate(Update)</button>
</form>
