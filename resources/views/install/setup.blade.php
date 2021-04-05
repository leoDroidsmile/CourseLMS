@extends('install.app')
@section('content')

    <div class="card-body">
        <h3 class="text-lg-center p-3">@translate(Setup Database)</h3>
        <form action="{{route('db.setup')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="types[]" value="DB_HOST">
                <label>@translate(Database Host)</label>
                <input class="form-control" placeholder="Database Host" name="DB_HOST" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="types[]" value="DB_DATABASE">
                <label>@translate(Database Name)</label>
                <input class="form-control" placeholder="Database Name" name="DB_DATABASE" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="types[]" value="DB_USERNAME">
                <label>@translate(Database Username)</label>
                <input class="form-control" placeholder="Database Username" name="DB_USERNAME" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="types[]" value="DB_PASSWORD">
                <label>@translate(Database Password)</label>
                <input class="form-control" placeholder="Database Password" type="password" name="DB_PASSWORD">
            </div>

            <div class="">
                <button class="btn btn-primary btn-block" type="submit">@translate(Save The Configuration)</button>
            </div>
        </form>

    </div>


@endsection
