
    <!-- Start Footer Area -->
    <footer>
        
        <!-- Start Footer Bottom Area -->
        <div class="footer-bottom-area themeix-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="footer-bottom">
                            <div class="footer-logo">
                                <a href="{{ route('homepage') }}">
                                    <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}" width="250" alt=" {{getSystemSetting('type_name')->value}}">
                                </a>
                            </div>
                            
                            <div class="copyright-text">
                                <p> &#169; {{date('Y')}} {{getSystemSetting('type_footer')->value}} - All rights reserved.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom Area -->
        <!-- Start Scroll To Top -->
        <div class="scroll-top">
            <div class="scroll-icon">
                <i class="fa fa-angle-up"></i>
            </div>
        </div>
        <!-- End Scroll To Top -->
    </footer>
    <!-- End Footer Area -->