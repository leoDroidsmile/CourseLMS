<div class="card-body">
    <form action="{{route('pages.update')}}" method="post" enctype="multipart/form-data">
        @csrf
<input type="hidden" name="id" value="{{$page->id}}">
        <div class="form-group">
            <label>@translate(Page Title) <span class="text-danger">*</span></label>
            <input class="form-control" type="text"  name="title" value="{{$page->title}}" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>

