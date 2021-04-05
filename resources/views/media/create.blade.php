
<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">


<div class="container-fluid shadow">
    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" id="media-form">
                @csrf
        <div class="row">
            <div class="col-8">
                <label for="">Upload File</label>
                <div class="card shadow-sm bg-dark text-white">
                    <input type="file" value="{{ old('image') }}" name="image" class="dropify media-img">
                </div>
                <p class="Error text-danger"></p>
            <small>Maximum upload size 2GB</small>
            <br>
            <small>Supported file type: jpeg, jpg, png, pdf, mp4, zip</small>
            </div>
          <div class="col-4">

                <div class="form-group">
                    <label for="title">Title (optional)</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" aria-describedby="emailHelp" placeholder="Enter title">
                </div>


                {{-- Type --}}
                <div class="form-group">
                        <label for="type">
                            @translate(Type)</label>
                    <select class="form-control lang type @error('provider') is-invalid @enderror"
                            name="type" required>
                        <option value="">
                            @translate(Select Type)
                        </option>

                        @if (Auth::user()->user_type == 'Admin')
                            <option value="category">
                                @translate(Category)
                            </option>

                        <option value="slider">
                            @translate(Slider)
                        </option>

                        <option value="organization">
                            @translate(Organization)
                        </option>
                        <option value="package">
                            @translate(Package)
                        </option>

                        @endif

                        <option value="source_code">
                            @translate(Source Code)
                        </option>
                        <option value="thumbnail">
                            @translate(Thumbnail)
                        </option>
                        <option value="file" id="file">
                            @translate(File)
                        </option>


                    </select>

                    <p class="Error text-danger"></p>

            </div>


                <button type="button" class="btn btn-primary media-btn-submit" onclick="btnLoader()">
                    Submit
                    <div class="spinner-border align-baseline spinner-border-sm d-none submit-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>





            </div>
        </div>
    </form>
  </div>

<div class="progress progress-height">
  <div class="progress-bar progress-bar-striped progress-bar-animated progBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>


<script src="{{ asset('js/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();
</script>
