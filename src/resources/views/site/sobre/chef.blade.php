    <!-- Chef Section -->
    @php
    $chef = asset('davilla/images/38.jpg');
    @endphp
    <section class="chef-section" style="background-image: url('{{ $chef }}');">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <div class="content">
                            <div class="sec-title text-center">
                                <div class="divider"><img src="{{ asset('davilla/images/icons/divider_1.png') }}" alt=""></div>
                                <h2>Alex Doe</h2>
                            </div>
                            <h4>Masterchef</h4>
                            <div class="divider"><img src="{{ asset('davilla/images/icons/icon-devider.png') }}" alt=""></div>
                            <p>Maria is a Roman-born pastry chef who spent 15 years in his city Rome perfecting his craft and exceptional creations. Vestibulum rhoncus ornare tincidunt. Etiam pretium metus sit amet est aliquet vulputate. Fusce et cursus ligula. Sed accumsan dictum porta. Aliquam rutrum ullamcorper velit hendrerit convallis.</p>
                            <div class="btn-box">
                                <a href="#" class="theme-btn btn-style-two regular alt"><span></span>Our Services<span></span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <figure class="image"><img src="{{ asset('davilla/images/old_man.png') }}" alt=""></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Chef Section -->