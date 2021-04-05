
@if(!request()->is('student/*'))


    @guest()
        <!-- CTA Section Starts -->
        <section class="cta-section gradient-bg padding-top-60 padding-bottom-30">
            <div class="cta-shape">
                <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="image" class="plus-sign item-rotate">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title margin-bottom-40">
                            <h2>@translate(enhance your skills with) <span>@translate(best online course)</span></h2>
                        </div>
                        <div class="cta-button">
                            <a href="{{route('instructor.register')}}" class="template-button margin-right-20">start teaching</a>
                            <a href="{{route('student.register')}}" class="template-button-2">start learning</a>
                        </div>
                    </div>
                    <div class="col-xl-4 offset-xl-2 col-lg-6">
                        <div class="cta-image">
                            <img src="{{asset('asset_rumbok/images/cta-image.png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endguest

    <!-- ================================
           Start FOOTER AREA
  ================================= -->

    <!-- Footer Section Starts -->
    <footer class="footer-section padding-top-30 padding-bottom-60">
        <div class="footer-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-3.png')}}" alt="shape" class="round-shape-3">
        </div>
        <div class="container">
            <div class="footer-widget-section">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="{{route('homepage')}}">
                                    <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                         alt="{{getSystemSetting('type_name')->value}}" class="round-shape-3">
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(courses)</h4>
                            </div>
                            <ul>
                                @foreach(\App\Model\Category::Published()->where('top', 1)->get() as $item)
                                    <li><a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(useful links)</h4>
                            </div>
                            <ul>
                                @foreach(\App\Page::where('active',1)->get() as $item)
                                    <li><a href="{{route('pages',$item->slug)}}">{{$item->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(company)</h4>
                            </div>
                            <div class="company-address d-flex">
                                <div class="address-icon template-icon green-icon margin-right-10">
                                    <i class="icofont-address-book"></i>
                                </div>
                                <div class="address-info">
                                    {{getSystemSetting('type_mail')->value}}<br>
                                    <span>{{getSystemSetting('type_footer')->value}}.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright-section">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <div class="copyright-text">
                            <span>&copy; {{date('Y')}} {{getSystemSetting('type_name')->value}}</span>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="copyright-button">
                            <div class="dropup-item item-1">
                                <div class="toggle-box box-1">
                                    <form id="ru-currency" method="post" action="{{route('frontend.currencies.change')}}">
                                        @csrf
                                        <select class="theme-btn sort-ordering-select selectpicker" data-live-search="true" tabindex="-98" name="id" onchange="currencyChange()">
                                            @foreach(\App\Model\Currency::where('is_published',true)->get() as $item)
                                                <option  value="{{$item->id}}" {{defaultCurrency() == $item->code ? 'selected' : null}}> {{Str::ucfirst($item->symbol.' '.$item->code)}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="dropup-item item-2 margin-left-20">
                                <div class="toggle-box box-2">
                                    <form id="ru-lang" method="post" action="{{route('frontend.languages.change')}}">
                                        @csrf
                                        <select class="theme-btn sort-ordering-select  selectpicker" tabindex="-98" name="code" data-live-search="true" onchange="languageChange()">
                                            @foreach(\App\Model\Language::all() as $language)
                                                <option  value="{{$language->code}}"  {{(\Illuminate\Support\Facades\Session::get('locale') == $language->code ? 'selected' : env('DEFAULT_LANGUAGE') == $language->code ) ? 'selected' : null }}>{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- ================================
              END FOOTER AREA
    ================================= -->
@endif
