<form action="{{ route('classes.update') }}" method="post">
    @csrf
    {{-- Class Title --}}
    <input type="hidden" name="course_id" value="{{$id}}">
    <div class="form-group row is-invalid">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Class Title) <span class="text-danger">*</span></label>
        <div class="col-lg-6">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="val-title"
                   value="{{ $each_class->title }}" name="title" placeholder="@translate(Enter Class Title)"
                   required>
                   @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary float-left">
        @translate(Submit)</button>
</form>
