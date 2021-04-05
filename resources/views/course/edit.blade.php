@extends('layouts.master')
@section('title','Course Edit')
@section('parentPageTitle', 'Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop

@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <div class="card-body">
            <h4>@translate(Course Information)</h4>
            <form class="form-validate" action="{{ route('course.update')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$each_course->id}}">
                {{-- Course Title --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-title">
                        @translate(Course Title) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" required value="{{ $each_course->title}}"
                               class="form-control @error('title') is-invalid @enderror" id="val-title" name="title"
                               placeholder="Enter Course Title" aria-required="true"
                               autofocus {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                        @error('title') <span class="invalid-feedback"
                                              role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
                {{-- Slug --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-slug">
                        @translate(Slug) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text"
                               required value="{{ $each_course->slug}}"
                               class="form-control @error('slug') is-invalid @enderror" id="val-slug" name="slug"
                               placeholder="Enter Slug"
                               aria-required="true" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                        <span id="error_email"></span>
                        @error('slug') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>

                {{-- Level --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-provider">
                        @translate(Course Level) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control lang @error('level') is-invalid @enderror" id="val-provider"
                                name="level" required {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            <option value="Beginner" {{ $each_course->level === "Beginner" ? "selected" : "" }}>
                                @translate(Beginner)
                            </option>
                            <option value="Advanced" {{ $each_course->level === "Advanced" ? "selected" : "" }}>
                                @translate(Advanced)
                            </option>
                            <option value="All Levels" {{ $each_course->level === "All Levels" ? "selected" : "" }}>
                                @translate(All Levels)
                            </option>
                        </select>
                    </div>
                    @error('level') <span class="invalid-feedback"
                                          role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>

                {{-- Description --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-suggestions">
                        @translate(Description)</label>
                    <div class="col-lg-9">
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                            <textarea required
                                      class="form-control summernote @error('short_description') is-invalid @enderror"
                                      name="short_description"
                                      rows="5">{!!  $each_course->short_description !!}</textarea>
                            @error('short_description') <span class="invalid-feedback"
                                                              role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        @else
                        {!! $each_course->short_description !!}
                        @endif

                    </div>
                </div>
                {{-- Big description --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-suggestions">
                        @translate(Big Description)</label>
                    <div class="col-lg-9">
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                            <textarea required
                                      class="form-control summernote @error('big_description') is-invalid @enderror"
                                      name="big_description"
                                      rows="5">{!! $each_course->big_description !!}</textarea>
                            @error('big_description') <span class="invalid-feedback"
                                                            role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        @else
                        {!! $each_course->big_description($each_course->big_description) !!}

                        @endif

                    </div>
                </div>
                {{-- Course Thumbnail --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="img">
                        @translate(Course Thumbnail) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                    <img src="{{ filePath($each_course->image) }}" width="200" height="auto" alt="photo">
                    <br>

                    <input type="hidden" required value="{{$each_course->image}}" class="form-control course_image @error('image') is-invalid @enderror" id="val-img" name="image">
                    <img class="course_thumb_preview rounded shadow-sm d-none" src="" alt="#Course thumbnail" width="200" height="auto">
                    @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror

                      <input type="hidden" name="course_thumb_url" class="course_thumb_url" value="">
                    <br>

                      @if (MediaActive())
                       {{-- media --}}
                      <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'thumbnail')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                      @endif

                    </div>
                </div>
                {{-- Overview URL --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-website">
                        @translate(Overview URL) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="url" required value="{{ $each_course->overview_url}}"
                               class="form-control @error('overview_url') is-invalid @enderror" id="val-website"
                               name="overview_url" placeholder="url"
                               aria-required="true" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                        @error('overview_url') <span class="invalid-feedback"
                                                     role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
                {{-- Provider --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-provider">
                        @translate(Provider) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control lang @error('provider') is-invalid @enderror" id="val-provider"
                                name="provider" required {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            <option value="Youtube" {{ $each_course->provider === "Youtube" ? "selected" : "" }}>
                                @translate(Youtube)
                            </option>
                            <option value="Vimeo" {{ $each_course->provider === "Vimeo" ? "selected" : "" }}>
                                @translate(Vimeo)
                            </option>
                            <option value="HTML5" {{ $each_course->provider === "HTML5" ? "selected" : "" }}>
                                @translate(HTML5)
                            </option>
                        </select>
                    </div>
                    @error('provider') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>

                {{-- Requirements --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-requirement">
                        @translate(Requirements) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="bootstrap-tagsinput">
                            <input type="text" class="@error('requirement') is-invalid @enderror" value="
                        @foreach(json_decode($each_course->requirement) as $item)
                            {{$item}},
                            @endforeach
                                " placeholder="" id="val-requirement" name="requirement"
                                   data-role="tagsinput" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @error('requirement') <span class="invalid-feedback"
                                                        role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>
                {{-- Outcome --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-outcome">
                        @translate(Outcome) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="bootstrap-tagsinput">
                            <input type="text" class="@error('outcome') is-invalid @enderror" placeholder=""
                                   value="  @foreach(json_decode($each_course->outcome) as $item)
                                   {{$item}},
                                   @endforeach" id="val-outcome" name="outcome"
                                   data-role="tagsinput" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @error('outcome') <span class="invalid-feedback"
                                                    role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>
                {{-- Tags --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-tag">
                        @translate(Tags) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="bootstrap-tagsinput">
                            <input type="text" class="@error('tag') is-invalid @enderror" placeholder="" value="
                            @foreach(json_decode($each_course->tag) as $item)
                            {{$item}},
                            @endforeach" id="val-tag" name="tag"
                                   data-role="tagsinput" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @error('tag') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>


                {{-- Free --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-is_free">
                        @translate(Free Course)</label>
                    <div class="col-lg-9">
                        <div class="switchery-list">
                            <input type="checkbox" name="is_free" class="js-switch-success"
                                   id="val-is_free" {{ $each_course->is_free === 0 ? ' ' : 'checked' }} {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}/>
                            @error('is_free') <span class="invalid-feedback"
                                                    role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>


                <div id="auto_hide">
                    {{-- Price --}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">
                            @translate(Price?)</label>
                        <div class="col-lg-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" min="0" value="{{ $each_course->price}}" name="price"
                                       class="form-control @error('price') is-invalid @enderror" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                                @error('price') <span class="invalid-feedback"
                                                      role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Discount --}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label" for="val-is_discount">
                            @translate(Discount?)</label>
                        <div class="col-lg-9">
                            <div class="switchery-list">

                                <input type="checkbox" name="is_discount" class="js-switch-success"
                                       id="val-is_discount" {{ $each_course->is_discount === 0 ? " " : 'checked' }} {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}/>
                                @error('is_discount') <span class="invalid-feedback"
                                                            role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                            </div>
                            @error('is_discount') <span class="invalid-feedback"
                                                        role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>

                    {{-- Discount Price --}}
                    <div class="form-group" id="discount_price">
                        <div class="row">
                            <label class="col-lg-3 col-form-label">
                                @translate(Price With Discount?)</label>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="0" value="{{ $each_course->discount_price}}"
                                           name="discount_price"
                                           class="form-control @error('discount_price') is-invalid @enderror" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                                    @error('discount_price') <span class="invalid-feedback"
                                                                   role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- language --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-language">
                        @translate(Language) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control lang @error('language') is-invalid @enderror" id="val-language"
                                name="language" required {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @foreach ($languages as $language)
                                <option
                                    value="{{ $language->name }}" {{$each_course->language == $language->name ?'selected':null}}>{{ $language->name }}</option>
                            @endforeach
                        </select>
                        @error('language') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
                {{-- Meta Title --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-meta_title">
                        @translate(Meta Title)</label>
                    <div class="col-lg-9">
                        <div class="bootstrap-tagsinput">
                            <input type="text" placeholder="" class=" @error('meta_title') is-invalid @enderror" value="
@foreach(json_decode($each_course->meta_title) as $item)
                            {{$item}},
                            @endforeach
                                " id="val-meta_title" name="meta_title"
                                   data-role="tagsinput" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @error('meta_title') <span class="invalid-feedback"
                                                       role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>
                {{-- Meta Description --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-meta_description">
                        @translate(Meta Description)</label>
                    <div class="col-lg-9">
                        <textarea id="val-meta_description" name="meta_description"
                                  class="form-control @error('meta_description') is-invalid @enderror"
                                  data-role="tagsinput" {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}> {!! $each_course->meta_description !!}</textarea>
                        @error('meta_description') <span class="invalid-feedback"
                                                         role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
                {{-- Category --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-category_id">
                        @translate(Category) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control lang @error('category_id') is-invalid @enderror"
                                id="val-category_id" name="category_id"
                                required {{ Auth::user()->user_type != 'Admin' ? '' : 'readonly' }}>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{$each_course->category_id == $category->id ? 'selected':null}}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>


                @if (Auth::user()->user_type === 'Instructor')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary">
                                @translate(Submit)
                            </button>
                        </div>
                    </div>
                @endif


            </form>
        </div>
    </div>
    <!-- END:content -->
@endsection

@section('js-link')
    @include('layouts.include.form.form_js')
@stop

@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>

@stop
