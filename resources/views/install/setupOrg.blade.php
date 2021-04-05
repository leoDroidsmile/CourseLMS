@extends('install.app')
@section('content')

        <div class="card-body">
            <h2 class="text-lg-center p-3">@translate(Setup Organization Setting)</h2>
            <form method="post" action="{{route('org.setup')}}" enctype="multipart/form-data">
            @csrf

            <!--logo-->
                <label class="label">@translate(Organization logo)</label>
                <input type="hidden" value="type_logo" name="type_logo">

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' value="" name="logo" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview"
                             style="background-image: url({{filePath('uploads/site/header.png')}});">
                        </div>
                    </div>
                </div>
                <!--logo end-->

                <!--footer logo-->
                <label class="label">@translate(Footer Logo)</label>
                <input type="hidden" required value="footer_logo" name="footer_logo">

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' value="" name="f_logo" id="imageUpload_f_logo" accept=".png, .jpg, .jpeg"/>
                        <label for="imageUpload_f_logo"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview_f_logo"
                             style="background-image: url({{filePath('uploads/site/footer.png')}});">
                        </div>
                    </div>
                </div>
                <!--footer logo end-->

                <!--favicon icon-->
                <label class="label">@translate(Favicon Icon)</label>
                <input type="hidden" required value="favicon_icon" name="favicon_icon">


                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' value="" name="f_icon" id="imageUpload_f_icon" accept=".png, .jpg, .jpeg"/>
                        <label for="imageUpload_f_icon"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview_f_icon"
                             style="background-image: url({{filePath('uploads/site/icon.png')}});">
                        </div>
                    </div>
                </div>
                <!--favicon end-->

                <!--name-->
                <label class="label">@translate(Organization Name)</label>
                <input type="hidden" value="type_name" name="type_name">
                <input type="text" required value="{{getSystemSetting('type_name')->value}}" name="name"
                       class="form-control">

                <!--footer-->
                <label class="label">@translate(Organization Footer)</label>
                <input type="hidden" value="type_footer" name="type_footer">
                <input type="text" value="{{getSystemSetting('type_footer')->value}}" name="footer"
                       class="form-control">

                <!--address-->
                <label class="label">@translate(Organization Address)</label>
                <input type="hidden" value="type_address" name="type_address">
                <input type="text"  value="{{getSystemSetting('type_address')->value}}" name="address"
                       class="form-control">

                <!--mail-->
                <label class="label">@translate(Organization Mail)</label>
                <input type="hidden" value="type_mail" name="type_mail">
                <input type="text" required value="{{getSystemSetting('type_mail')->value}}" name="mail"
                       class="form-control">

                <!--fb-->
                <label class="label">@translate(Organization Facebook Link)</label>
                <input type="hidden" value="type_fb" name="type_fb">
                <input type="text"  value="{{getSystemSetting('type_fb')->value}}" name="fb"
                       class="form-control">

                <!--tw-->
                <label class="label">@translate(Organization Twitter Link)</label>
                <input type="hidden" value="type_tw" name="type_tw">
                <input type="text"  value="{{getSystemSetting('type_tw')->value}}" name="tw"
                       class="form-control">

                <!--google-->
                <label class="label">@translate(Organization Google Link)</label>
                <input type="hidden" value="type_google" name="type_google">
                <input type="text"  value="{{getSystemSetting('type_google')->value}}" name="google"
                       class="form-control">

                <!--Number-->
                <label class="label">@translate(Organization Number )</label>
                <input type="hidden" value="type_number" name="type_number">
                <input type="text" required value="{{getSystemSetting('type_number')->value}}" name="number"
                       class="form-control">


                <div class="m-2">
                    <button class="btn btn-block btn-primary" type="submit">@translate(Save)</button>
                </div>
            </form>

        </div>



@endsection
