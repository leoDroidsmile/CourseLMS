<form action="{{route('questions.update')}}" method="post"  enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{$question->id}}" >
    <input type="hidden" name="status" value="{{$question->status}}" >
    @csrf
    <div class="row">

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Questions Title) <span class="text-danger">*</span></label>
            <div class="">
                <input type="text" required
                       value="{{ $question->question }}"
                       class="form-control @error('title') is-invalid @enderror"
                       name="title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                       autofocus>
                @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
        </div>

        <div class="form-group col-md-6 p-3">
            <label class="" for="val-title">
                @translate(Correct Answer Mark)</label>
            <div class="">
                <input type="number" required
                       value="{{ $question->grade }}"
                       class="form-control"
                       name="grade" placeholder="@translate(Correct Answer Mark)" aria-required="true"
                       autofocus>
            </div>
        </div>
    </div>

    {{--here the question answer field--}}
    <hr>

    <div class="row">
        <table class="table table-bordered answer-form-table">
            <tbody class="input-append">
            @foreach(json_decode($question->options,true) as $ns)
            <tr class="border border-primary">
                <input type="hidden" required value="{{$ns['index']}}" name="index[]">

                <td>
                    <div class="form-group">
                        <label>@translate(Question Answer)</label>
                        <input type="text" required
                               class="form-control" value="{{$ns['answer']}}" name="answer[]" placeholder="@translate(Write Answer)">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label>@translate(Image)</label>
                        <input type="file" class="form-control-file" placeholder="Select Image"
                               name="image[]">
                        @if($ns['image'] != null)
                            <a target="_blank" href="{{filePath($ns['image'])}}">@translate(click to see image)</a>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label>@translate(Correct)</label>
                        <select class="form-control" name="correct[]" required>
                            <option value="false" {{$ns['correct'] == "false" ? 'selected' : null}}>@translate(False)</option>
                            <option value="true" {{$ns['correct'] == "true" ? 'selected' : null}}>@translate(True)</option>
                        </select>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <button class="btn btn-outline-success" type="submit"> @translate(Submit)</button>
</form>
