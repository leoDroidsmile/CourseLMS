<div class="card-body">
    <form action="{{route('know.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$know->id}}">


        @if($know->align == 'center')
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="custom-file">
                   <input class="form-control-file"  name="image" type="file">
            </div>
        </div>

        <div class="form-group">
            <label>@translate(video link) </label>
            <input class="form-control" value="{{$know->video}}"  name="video" type="url" >
        </div>

        @if($know->image)
            <div class="card">
                <img src="{{filePath($know->image)}}" class="img-fluid w-25">
            </div>
        @endif

        @else
            <div class="form-group">
                <label>@translate(Icon class)</label>
                <input class="form-control" value="{{$know->icon}}" type="text" name="icon">
                <a class="nav-link" target="_blank" href="https://icofont.com"><small class="text-info">for icon visit this link</small></a>
            </div>
            <div class="form-group">
                <label>@translate(Title) </label>
                <input class="form-control" value="{{$know->title}}" type="text" name="title" >
            </div>
            <div class="form-group">
                <label>@translate(short description) </label>
                <input class="form-control" value="{{$know->desc}}" name="desc" type="text" >
            </div>
        @endif

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



