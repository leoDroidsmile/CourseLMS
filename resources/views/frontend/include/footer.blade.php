@if(!request()->is('student/*'))

    <!-- ================================
           Start FOOTER AREA
  ================================= -->
    <section class="footer-area section-bg-2 padding-top-100px padding-bottom-40px {{ request()->is('student/*') ? 'student-dashboard' : '' }}">
        <div class="container">
            <div class="row">
                <div class="{{ request()->is('student/*') ? 'col-lg-3 offset-md-2' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <a href="{{route('homepage')}}">
                            <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}" class="footer__logo img-fluid w-50">
                        </a>
                        <ul class="list-items footer-address">
                            <li>
                                <a href="tel:{{getSystemSetting('type_number')->value}}">{{getSystemSetting('type_number')->value}}</a>
                            </li>
                            <li><a href="mailto:{{getSystemSetting('type_mail')->value}}"
                                   class="mail">{{getSystemSetting('type_mail')->value}}</a></li>
                            <li>{{getSystemSetting('type_address')->value}}</li>
                        </ul>
                        <h3 class="widget-title font-size-17 mt-4">@translate(We are on)</h3>
                        <ul class="social-profile">
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
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->
                <div class="{{ request()->is('student/*') ? 'col-lg-3' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <h3 class="widget-title">@translate(Company)</h3>
                        <span class="section-divider"></span>
                        <ul class="list-items">
                            @foreach(\App\Page::where('active',1)->get() as $item)
                                <li><a href="{{route('pages',$item->slug)}}">{{$item->title}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->
                <div class="{{ request()->is('student/*') ? 'col-lg-3' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <h3 class="widget-title">@translate(Courses)</h3>
                        <span class="section-divider"></span>
                        <ul class="list-items">
                            @foreach(\App\Model\Category::Published()->where('top', 1)->get() as $item)
                                <li><a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->

            </div><!-- end row -->
            <div class="copyright-content">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <p class="copy__desc">&copy; {{date('Y')}} {{getSystemSetting('type_footer')->value}}</p>
                    </div><!-- end col-lg-9 -->
                    <div class="col-lg-2">
                        <div class="sort-ordering">
                            <form id="ru-currency" method="post" action="{{route('frontend.currencies.change')}}">
                                @csrf
                                <select class="sort-ordering-select selectpicker" data-live-search="true" tabindex="-98" name="id" onchange="currencyChange()">
                                    @foreach(\App\Model\Currency::where('is_published',true)->get() as $item)
                                        <option  value="{{$item->id}}" {{defaultCurrency() == $item->code ? 'selected' : null}}> {{Str::ucfirst($item->symbol.' '.$item->code)}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="sort-ordering my-2">
                            <form id="ru-lang" method="post" action="{{route('frontend.languages.change')}}">
                                @csrf
                                <select class="sort-ordering-select  selectpicker" tabindex="-98" name="code" data-live-search="true" onchange="languageChange()">
                                    @foreach(\App\Model\Language::all() as $language)
                                        <option  value="{{$language->code}}"  {{(\Illuminate\Support\Facades\Session::get('locale') == $language->code ? 'selected' : env('DEFAULT_LANGUAGE') == $language->code ) ? 'selected' : null }}>{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div><!-- end row -->
            </div><!-- end copyright-content -->
        </div><!-- end container -->
    </section><!-- end footer-area -->
    <!-- ================================
              END FOOTER AREA
    ================================= -->
@endif
