<div class="card-body">
    <form action="{{route('pages.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(Page Title) <span class="text-danger">*</span></label>
            <input class="form-control" placeholder="@translate(Page Title)" type="text"  name="title" required>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>





