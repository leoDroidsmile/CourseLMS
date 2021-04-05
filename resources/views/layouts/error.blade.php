<div class="container-fluid">
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show  m-3" role="alert"
             id="">
            <ul class="nav">
                @foreach ($errors->all() as $error)
                    <li class="mx-2">{{$error}}</li>
                @endforeach
            </ul>


            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show  m-3" role="alert"
             id="gone">
            <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($message =Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show  m-3" role="alert"
             id="gone">
            <strong>{{$message}}.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($message =Session::get('error'))
        <div class="alert alert-warning alert-dismissible fade show  m-3" role="alert"
             id="gone">
            <strong>{{$message}}.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
