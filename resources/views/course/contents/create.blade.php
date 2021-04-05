<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">

<form id="content_form" action="{{ route('classes.contents.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Title --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Content Title) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="val-title" name="title"
                   placeholder="@translate(Enter Content Title)" required>
            @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>
    {{-- Class --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-Class">
            @translate(Class) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <select class="form-control @error('class_id') is-invalid @enderror" id="val-Class"
                    required name="class_id" aria-required="true">
                <option value="" name="class_id">
                    @translate(Select Class)
                </option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->title }}</option>
                @endforeach
            </select>
            @error('class_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>
    {{-- Content Type --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-Content">
            @translate(Content Type) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <select class="form-control @error('content_type') is-invalid @enderror" required id="val-Content"
                    name="content_type">
                <option value="">
                    @translate(Select Provider)
                </option>
                <option value="Video" id="youtube">
                    @translate(Video)
                </option>
                <option value="Document" id="vimeo">
                    @translate(Document)
                </option>
                @if(quizActive())
                    <option value="Quiz">
                        @translate(Quiz)
                    </option>
                @endif
            </select>
            @error('content_type') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    @if(quizActive())
        {{--quiz--}}
        <div id="Quiz" class="docs">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-Content">
                    @translate(Select Quiz) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select class="form-control" id="quiz-content" name="quiz_id">
                        @foreach($quizes as $quiz)
                            <option value="{{$quiz->id}}">
                                {{$quiz->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif
    {{-- This Div will appear, if Content type is Selected --}}
    <div class="output">
        {{-- Video Url --}}
        <div id="Video" class="docs">
            {{-- provider --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-provider">
                    @translate(Provider)</label>
                <div class="col-lg-9">
                    <select class="form-control lang @error('provider') is-invalid @enderror" id="val-provider"
                            name="provider">
                        <option value="">
                            @translate(Select Provider)
                        </option>
                        <option value="Youtube">
                            @translate(Youtube)
                        </option>
                        <option value="HTML5">
                            @translate(HTML5)
                        </option>
                        <option value="Vimeo">
                            @translate(Vimeo)
                        </option>
                        <option value="File" id="file">
                            @translate(File)
                        </option>
                        <option value="Live">
                            @translate(Live)
                        </option>
                    </select>
                    @error('provider') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-video_url">
                    @translate(Video File/Link)</label>
                <div class="col-lg-9">
                    <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="val-video_url"
                           name="video_url" placeholder="@translate(Enter Video Url Link)">

                    @if (zoomActive())
                        <br>
                        - OR -
                        <br>
                        <br>

                        <select class="form-control lang @error('meeting_id') is-invalid @enderror" id="val-meeting"
                                name="meeting_id">
                            <option value="">
                                @translate(Select Meeting)
                            </option>
                            @foreach (App\Meeting::where('user_id', Auth::user()->id)->latest()->get() as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->meeting_title }}
                                </option>
                            @endforeach
                            {{-- @foreach (App\Model\Course::Published()->where('user_id', Auth::user()->id)->with('meeting')->get() as $course)
                                @if ($course->meeting != null)
                                    <option value="{{ $course->meeting->id }}">
                                        {{ $course->meeting->meeting_title }}
                                    </option>
                                @endif
                            @endforeach --}} 
                        </select>

                    @endif


                    <video controls crossorigin playsinline id="player" class="w-100 video_file_preview rounded shadow-sm d-none" src=""></video>

                    <input type="hidden" name="video_raw_url" class="video_raw_url" value="">

                    @if (MediaActive())
                        {{-- media --}}
                        <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'file')"
                           class="btn btn-primary media-btn d-none mt-2 p-2">Upload From Media <i
                                class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                    @endif

                    @error('video_url') <span class="invalid-feedback"
                                              role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

        </div>
        {{-- file --}}
        <div id="Document" class="docs">
            <div class="form-group row is-invalid">
                <label class="col-lg-3 col-form-label" for="val-file">File</label>
                <div class="col-lg-9">
                    <input type="file" class="form-control dropify @error('file') is-invalid @enderror" id="val-file"
                           name="file">
                    @error('file') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Description --}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-suggestions">
            @translate(Description)</label>
        <div class="col-lg-9">
            <textarea class="form-control summernote @error('description') is-invalid @enderror"
                      name="description"></textarea>
            @error('description') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    {{--duriation--}}
    <div class="form-group row">
        <label class="col-lg-3 col-form-label" for="val-title">
            @translate(Content duration) <span class="text-danger">*</span></label>
        <div class="col-lg-9">
            <input type="number" min="0" class="form-control @error('duration') is-invalid @enderror" name="duration"
                   placeholder="@translate(Enter content duration in minutes)" required>
            @error('duration') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>


    {{-- source_code --}}
    <div class="">
        <div class="form-group row is-invalid">
            <label class="col-lg-3 col-form-label" for="source_code">@translate(Source Code)</label>
            <div class="col-lg-9">

                <img class="w-100 source_code_preview rounded shadow-sm d-none" src="" alt="#Source code">

                <input type="hidden" name="source_code_url" class="source_code_url" value="">

                @error('source_code') <span class="invalid-feedback"
                                            role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror

                @if (MediaActive())
                    {{-- media --}}
                    <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'source_code')"
                       class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2"
                                                                                       aria-hidden="true"></i> </a>
                @endif

            </div>
        </div>
    </div>


    {{-- Submit button --}}
    <button type="submit" class="btn btn-primary float-left">
        @translate(Submit)
    </button>
</form>
{{-- Script --}}

<script src="{{ asset('js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();
</script>

<script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>



