<div class="card-body">
    <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Title) <span class="text-danger">*</span></label>
            <input class="form-control" placeholder="@translate(Enter Title)" type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>@translate(Sub Title) </label>
            <input class="form-control" placeholder="@translate(Enter Sub Title)" type="text" name="sub_title" >
        </div>
        <div class="form-group">
            <label>@translate(Link) </label>
            <input class="form-control" placeholder="@translate(Enter URL)" name="link" type="url" >
        </div>
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image) <span class="text-danger">*</span></label>
            <div class="custom-file">
                <input class="custom-file-input slider" id="customFile" name="image" type="hidden">

                 <img class="w-50 slider_preview rounded shadow-sm d-none" src="" alt="#Slider">  
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



