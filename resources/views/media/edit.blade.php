
<link rel="stylesheet" href="{{ asset('css/dropify.css') }}">


<div class="container-fluid">
    <form action="{{ route('media.update', $single_media->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
        <div class="row">
            <div class="col-8">
                <div class="card">


                                        @if ($single_media->alt == 'image')
                                        <img class="card-img mb-2" src="{{ filePath($single_media->image) }}" alt="{{ $single_media->alt }}">
                                        @endif
                                        @if ($single_media->alt == 'pdf')
                                        <img class="card-img w-50 m-auto pb-2" src="{{ filePath('pdf.png') }}" alt="{{ $single_media->alt }}">
                                        @endif
                                        @if ($single_media->alt == 'zip')
                                        <img class="card-img w-50 m-auto pb-2" src="{{ filePath('zip.png') }}" alt="{{ $single_media->alt }}">
                                        @endif
                                        @if($single_media->alt == 'video')
                                            <video controls crossorigin playsinline id="player" class="w-100 mb-2" src="{{ filePath($single_media->image)  }}"></video>
                                        @endif


                <input type="file"name="image" class="dropify media-img">
                <p class="Error text-danger"></p>
                <small>Maximum upload size 2GB</small>
            <br>
            <small>Supported file type: jpeg, jpg, png, pdf, mp4, zip</small>
                <input type="hidden" placeholder="old value" name="oldImage" value="{{ $single_media->image }}">




                </div>
            </div>
          <div class="col-4">

                <div class="form-group">
                    <label for="title">Title (optional)</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $single_media->title }}" aria-describedby="emailHelp" placeholder="Enter title">
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
                            <option value="category" {{ $single_media->type === 'category' ? 'selected' : '' }}>
                                @translate(Category)
                            </option>

                        <option value="slider" {{ $single_media->type === 'slider' ? 'selected' : '' }}>
                            @translate(Slider)
                        </option>

                        <option value="organization" {{ $single_media->type === 'organization' ? 'selected' : '' }}>
                            @translate(Organization)
                        </option>
                        <option value="package" {{ $single_media->type === 'package' ? 'selected' : '' }}>
                            @translate(Package)
                        </option>

                        @endif

                        <option value="source_code" {{ $single_media->type === 'source_code' ? 'selected' : '' }}>
                            @translate(Source Code)
                        </option>
                        <option value="thumbnail" {{ $single_media->type === 'thumbnail' ? 'selected' : '' }}>
                            @translate(Thumbnail)
                        </option>
                        <option value="file" id="file" {{ $single_media->type === 'file' ? 'selected' : '' }}>
                            @translate(File)
                        </option>


                    </select>
                     <p class="Error text-danger"></p>

            </div>

                @if ($single_media->alt != 'video' && $single_media->alt != 'pdf')

                <div class="card mb-2">
                    <ul class="list-group list-group-flush">
                        <li class="">Size - {{ $single_media->size }}KB</li>
                        <li class="">resolution - {{ $single_media->resolution }}</li>
                    </ul>
                </div>

                @endif


                <button type="submit" class="btn btn-primary media-btn-submit" onclick="btnLoader()">
                    Update changes
                    <div class="spinner-border align-baseline spinner-border-sm d-none submit-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
                <br>

                <a href="{{ route('media.delete', $single_media->id) }}" class="btn btn-danger mt-2">Permanent Delete</a>

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
