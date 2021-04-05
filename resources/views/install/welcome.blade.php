@extends('install.app')
@section('content')
<div class="text-center">
    <h1 class="font-weight-bold">Learning Management System Installation</h1>
    <h5>You will need to know the following items before proceeding</h5>

</div>
<div class="m-5">
    <ul class="list-group">
        <li class="list-group-item">
            <h6 class="font-weight-normal">
                <i class="fa  fa-check"></i> Database Host Name</h6>
        </li>
        <li class="list-group-item">
            <h6 class="font-weight-normal">
                <i class="fa fa-check"></i> Database Name</h6>
        </li>
        <li class="list-group-item">
            <h6 class="font-weight-normal">
                <i class="fa fa-check"></i> Database User Name</h6>
        </li>
        <li class="list-group-item">
            <h6 class="font-weight-normal">
                <i class="fa fa-check"></i> Database Password</h6>
        </li>
    </ul>
</div>

<div class="m-2">
    <p>During the installation process. we will check if the files there needed to be written (<strong>.env file</strong>)
        have <strong>write permission</strong>. We Will also check if
        <strong>curl</strong> are enabled on your server or not.</p>
    <br>
    <p>Gather the information mentioned above before hitting the start installation button. if you are ready...</p>

    <div class="center">
        <a href="{{route('permission')}}" class="btn btn-block btn-primary"> Start Installation Process</a>
    </div>
</div>



@endsection
