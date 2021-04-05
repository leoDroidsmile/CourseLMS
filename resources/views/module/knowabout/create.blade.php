<div class="card-body">
    <form action="{{route('know.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(content alignment)</label>
            <select class="form-control select2" name="align" id="align">
                <option value="left">left</option>
                <option value="center">center</option>
                <option value="right">right</option>
                <option value="top">top</option>
            </select>
        </div>

        <div class="" id="nocenter">
            <div class="form-group">
                <label>@translate(Icon class)</label>
                <input class="form-control" placeholder="icofont-document-folder" type="text" name="icon">
                <a class="nav-link" target="_blank" href="https://icofont.com"><small class="text-info">for icon visit this link</small></a>
            </div>
            <div class="form-group">
                <label>@translate(Title) </label>
                <input class="form-control" placeholder="@translate(Title)" type="text" name="title" >
            </div>
            <div class="form-group">
                <label>@translate(short description) </label>
                <input class="form-control" placeholder="@translate(Short description)" name="desc" type="text" >
            </div>
        </div>



        <div class="d-none" id="center">
            <div class="form-group">
                <label class="col-form-label text-md-right">@translate(Image)</label>
                <div class="custom-file">
                    <input class="form-control-file"  name="image" type="file">
                </div>
            </div>
            <div class="form-group">
                <label>@translate(video link) </label>
                <input class="form-control" placeholder="@translate(video link)" name="video" type="url" >
            </div>
        </div>

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



<script>
    $(document).ready(function (){
        $('#align').change(function (){
            var align = $(this).find(':selected').val();
            if (align == 'center'){
                $('#nocenter').addClass('d-none');
                $('#center').removeClass('d-none');
            }else{
                $('#center').addClass('d-none');
                $('#nocenter').removeClass('d-none');
            }

        })
    })

</script>
