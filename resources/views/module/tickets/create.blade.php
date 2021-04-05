<div class="card-body">
    <form action="{{route('tickets.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Subject) <span class="text-danger">*</span></label>
            <input class="form-control" name="subject" placeholder="@translate(Ex : How To Do It)" required>
        </div>
        <div class="form-group">
            <label>@translate(Content) <span class="text-danger">*</span></label>
            <textarea name="contents" class="form-control" required
                      placeholder="@translate(Write Your Query)"></textarea>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Send)</button>
        </div>
    </form>
</div>
