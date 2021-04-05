<div class="card-body">
    <form action="{{route('categories.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="form-group">
            <label>@translate(Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Name)" required value="{{$category->name}}">
        </div>
        @if($category->icon != null)
            <img src="{{filePath($category->icon)}}" width="80" height="80" class="img-thumbnail">
        @endif
        <div class="form-group">
            <label>@translate(Icon/Image)</label>
            {{-- <input class="form-control-file" type="file" name="newIcon"> --}}

            <input value="{{ $category->icon }}" name="icon" class="icon" type="hidden">
            
                <br>
                <img class="category_preview rounded shadow-sm d-none" width="60" src="" alt="#Category icon">  

                <br>

                <input type="hidden" name="category_url" class="category_url" value="">
                @if (MediaActive())
                    {{-- media --}}
                    <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'category')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                @endif

        </div>
        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control kt-select2 width-full" id="kt_select2_3" name="parent_category_id">
                <option value="0">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    @if($item->id != $category->id)
                        <option
                            value="{{$item->id}}" {{$category->parent_category_id == $item->id ? 'selected': null}}>{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
