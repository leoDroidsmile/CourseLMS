<div class="card-body">
    <form action="{{route('packages.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$package->id}}">
        <div class="form-group">
            <label>@translate(Price)  <span class="text-danger">*</span></label>
            <input class="form-control" value="{{$package->price}}" type="number" min="0" name="price" required>
            <small class="font-weight-bold">In USD</small>
        </div>
        <div class="form-group">
            <label>@translate(Commission) %<span class="text-danger">*</span></label>
            <input placeholder="@translate(Commission) 2%" value="{{$package->commission}}" step="0.01" class="form-control" min="0"
                   type="number" name="commission" required>
        </div>

        <div class="form-group">
            <input type="hidden" class="package" name="image" value="{{$package->image}}">
            <img src="{{filePath($package->image)}}" class="img-fluid" width="100">

            <br>

            <img class="package_preview rounded shadow-sm d-none" src="" alt="#Course thumbnail" width="100" height="auto">  
                @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror

            <input type="hidden" name="package_url" class="course_thumb_url" value="">
            <br>
                    
            @if (MediaActive())
            {{-- media --}}
            <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'package')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
            @endif


        </div>

    
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>
