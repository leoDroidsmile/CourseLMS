@extends('layouts.master')
@section('title','Setup Organization Setting')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-5">
            <div class="card m-2">
                <div class="card-header">
                    <h3>@translate(Organization Setting)</h3>
                </div>
                <div class="card-body mx-5">
                    <form method="post" action="{{route('site.update')}}" enctype="multipart/form-data">
                    @csrf

                    <!--logo-->
                        <label class="label">@translate(Logo)</label>
                        <input type="hidden" value="type_logo" name="type_logo">

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="logo" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                     style="background-image: url({{filePath(getSystemSetting('type_logo')->value)}});">
                                </div>
                            </div>
                        </div>
                        <!--logo end-->

                        <!--footer logo-->
                        <label class="label">@translate(Footer Logo)</label>
                        <input type="hidden" value="footer_logo" name="footer_logo">

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="f_logo" id="imageUpload_f_logo" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload_f_logo"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_f_logo"
                                     style="background-image: url({{filePath(getSystemSetting('footer_logo')->value)}});">
                                </div>
                            </div>
                        </div>
                        <!--footer logo end-->

                        <!--favicon icon-->
                        <label class="label">@translate(Favicon Icon)</label>
                        <input type="hidden" value="favicon_icon" name="favicon_icon">


                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="f_icon" id="imageUpload_f_icon" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload_f_icon"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_f_icon"
                                     style="background-image: url({{filePath(getSystemSetting('favicon_icon')->value)}});">
                                </div>
                            </div>
                        </div>
                        <!--favicon end-->

                        <!--name-->
                        <label class="label">@translate(Name)</label>
                        <input type="hidden" value="type_name" name="type_name">
                        <input type="text" value="{{getSystemSetting('type_name')->value}}" name="name"
                               class="form-control mb-2">

                        <!--footer-->
                        <label class="label">@translate(Footer)</label>
                        <input type="hidden" value="type_footer" name="type_footer">
                        <input type="text" value="{{getSystemSetting('type_footer')->value}}" name="footer"
                               class="form-control mb-2">

                        <!--address-->
                        <label class="label">@translate(Address)</label>
                        <input type="hidden" value="type_address" name="type_address">
                        <input type="text" value="{{getSystemSetting('type_address')->value}}" name="address"
                               class="form-control mb-2">

                        <!--mail-->
                        <label class="label">@translate(Mail)</label>
                        <input type="hidden" value="type_mail" name="type_mail">
                        <input type="text" value="{{getSystemSetting('type_mail')->value}}" name="mail"
                               class="form-control mb-2">

                        <!--fb-->
                        <label class="label">@translate(Facebook Link)</label>
                        <input type="hidden" value="type_fb" name="type_fb">
                        <input type="text" value="{{getSystemSetting('type_fb')->value}}" name="fb"
                               class="form-control mb-2">

                        <!--tw-->
                        <label class="label">@translate(Twitter Link)</label>
                        <input type="hidden" value="type_tw" name="type_tw">
                        <input type="text" value="{{getSystemSetting('type_tw')->value}}" name="tw"
                               class="form-control mb-2">

                        <!--google-->
                        <label class="label">@translate(Google Link)</label>
                        <input type="hidden" value="type_google" name="type_google">
                        <input type="text" value="{{getSystemSetting('type_google')->value}}" name="google"
                               class="form-control mb-2">

                        <!--Number-->
                        <label class="label">@translate(Number )</label>
                        <input type="hidden" value="type_number" name="type_number">
                        <input type="text" value="{{getSystemSetting('type_number')->value}}" name="number"
                               class="form-control mb-2">

                        <!--affiliate-->
                        <label class="label">@translate(Affiliate feature)</label>
                        <input type="hidden" value="affiliate" name="type_affiliate">
                        <select class="form-control select2" name="affiliate">
                            <option value="Inactive" {{getSystemSetting('affiliate')->value == 'Inactive' ? 'selected':null}}>@translate(off)</option>
                            <option value="Active" {{getSystemSetting('affiliate')->value == 'Active' ? 'selected':null}}>@translate(on)</option>
                        </select>
                        <strong class="text-info">@translate(If you active the Affiliate,you will get affiliate functionality in your application)</strong>



                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection



@section('js-link')

@stop

@section('page-script')
@stop

