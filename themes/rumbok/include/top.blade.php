


@if (!request()->is('student/*'))
    <div class="header-info">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="info-left">
                        <div class="phone-part">
                            <i class="fa fa-phone-square"></i>
                            <span><a href="tel:{{getSystemSetting('type_number')->value}}">{{getSystemSetting('type_number')->value}}</a></span>
                        </div>
                        <div class="email-part">
                            <i class="fa fa-envelope-open"></i>
                            <span><a href="mailto:{{getSystemSetting('type_mail')->value}}">
                                    {{getSystemSetting('type_mail')->value}}</a></span>
                        </div>
                        @if (env('FORUM_PANEL') === 'YES')
                            <li><a href="{{ route('forum.index') }}" target="_blank"> <i class="fa fa-comments-o" aria-hidden="true"></i> Forum</a></li>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-right">
                        <ul>
                            @guest()
                                    <li class="login-button"><a href="{{ route('login') }}">@translate(Login)</a></li>
                            @endguest
                            @if(getSystemSetting('type_fb')->value != null)
                                <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                            @endif

                            @if(getSystemSetting('type_tw')->value != null)
                                <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                                @endif

                            @if(getSystemSetting('type_google')->value != null)
                                <li><a href="{{getSystemSetting('type_google')->value}}" target="_blank"><i
                                            class="fa fa-google-plus"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
