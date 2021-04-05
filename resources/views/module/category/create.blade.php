<div class="card-body">
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Name)" required>
        </div>
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon/Image)</label>
            <div class="custom-file">

                <input value="" name="icon" class="icon" type="hidden">
                @error('icon') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                <img class="category_preview rounded shadow-sm d-none" width="55" src="" alt="#Category icon">

                <br>

                <input type="hidden" name="category_url" class="category_url" value="">
                @if (MediaActive())
                    {{-- media --}}
                    <a href="javascript:void(0)" onclick="openNav('{{ route('media.slide') }}', 'category')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                @endif

            </div>
        </div>
        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control select2 w-100" name="parent_category_id">
                <option value="">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



