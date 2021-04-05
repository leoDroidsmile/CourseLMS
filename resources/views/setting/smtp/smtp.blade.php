@extends('layouts.master')
@section('title','SMTP')
@section('parentPageTitle', 'Setting')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">@translate(SMTP Settings)</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('smtp.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_DRIVER">
                            <div class="">
                                <label class="control-label">@translate(MAIL DRIVER) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <select class="form-control" name="MAIL_DRIVER">
                                    <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>
                                        Sendmail
                                    </option>
                                    <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_HOST">
                            <div class="">
                                <label class="control-label">@translate(MAIL HOST) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_HOST"
                                       value="{{  env('MAIL_HOST') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_PORT">
                            <div class="">
                                <label class="control-label">@translate(MAIL PORT) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_PORT"
                                       value="{{  env('MAIL_PORT') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                            <div class="">
                                <label class="control-label">@translate(MAIL USERNAME) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_USERNAME"
                                       value="{{  env('MAIL_USERNAME') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                            <div class="">
                                <label class="control-label">@translate(MAIL PASSWORD) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="password" class="form-control" name="MAIL_PASSWORD"
                                       value="{{  env('MAIL_PASSWORD') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                            <div class="">
                                <label class="control-label">@translate(MAIL ENCRYPTION) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_ENCRYPTION"
                                       value="{{  env('MAIL_ENCRYPTION') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                            <div class="">
                                <label class="control-label">@translate(MAIL FROM ADDRESS) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_FROM_ADDRESS"
                                       value="{{  env('MAIL_FROM_ADDRESS') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                            <div class="">
                                <label class="control-label">@translate(MAIL FROM NAME) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="MAIL_FROM_NAME"
                                       value="{{  env('MAIL_FROM_NAME') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary btn-block" type="submit">@translate(Save)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel bg-gray-light">
                <div class="panel-body">
                    <h4>@translate(Instruction)</h4>
                    <p class="text-danger">@translate(Please be careful when you are configuring SMTP).
                        @translate(For incorrect configuration you will get error)
                        @translate(in few features).</p>
                    <hr>
                    <p>@translate(For Non-SSL)</p>
                    <ul class="list-group">
                        <li class="list-group-item text-dark">@translate(Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver )
                        </li>
                        <li class="list-group-item text-dark">@translate(Set Mail Host according to your server Mail Client Manual Settings)
                        </li>
                        <li class="list-group-item text-dark">@translate(Set Mail port as '587')</li>
                        <li class="list-group-item text-dark">@translate(Set Mail Encryption as 'ssl' if you face issue with 'tls')
                        </li>
                    </ul>
                    <hr>
                    <p>@translate(For SSL)</p>
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">@translate(Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver)
                        </li>
                        <li class="list-group-item text-dark">@translate(Set Mail Host according to your server Mail Client Manual Settings)
                        </li>
                        <li class="list-group-item text-dark">@translate(Set Mail port as '465')</li>
                        <li class="list-group-item text-dark">@translate(Set Mail Encryption as 'ssl')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js-link')

@stop

@section('page-script')

@stop
