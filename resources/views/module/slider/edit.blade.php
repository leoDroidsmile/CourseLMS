<div class="card-body">
    <form action="{{route('sliders.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$slider->id}}">
        <div class="form-group">
            <label>@translate(Title) <span class="text-danger">*</span></label>
            <input class="form-control" value="{{$slider->title}}" name="title" required>
        </div>
        <div class="form-group">
            <label>@translate(Sub Title) </label>
            <input class="form-control" name="sub_title" value="{{$slider->sub_title}}" >
        </div>
        <div class="form-group">
            <label>@translate(Link) </label>
            <input class="form-control" name="link" type="url" value="{{$slider->url}}" >
        </div>
        <div class="form-group">
            <img src="{{filePath($slider->image)}}" width="200" class="img-fluid">
            <input type="hidden" name="image" value="{{$slider->image}}">
        </div>
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image) <span class="text-danger">*</span></label>
            <div class="custom-file">
                <input class="custom-file-input slider" id="customFile" value="{{ $slider->image }}" name="image" type="hidden">

                 <img class=" slider_preview rounded shadow-sm d-none" src="" alt="#Slider" width="200">  
                    @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror

                <input type="hidden" name="slider_url" class="slider_url" value="">
                <br>
                    
                @if (MediaActive())
                {{-- media --}}
                <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'slider')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                @endif

            </div>
        </div>

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



