    <!-- Main Header-->
    <header class="main-header">
        <!-- Menu Wave -->
        <div class="menu_wave"></div>

        <!-- Main box -->
        <div class="main-box">
            <div class="menu-box">
                <div class="logo"><a href="index.html"><img src="{{ asset('davilla/images/logo-davilla.svg') }}" alt="" title=""></a></div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation menu-left clearfix">
                                <li class="current dropdown"><a href="index.html">Home</a>
                                    <ul>
                                        <li class="current"><a href="index.html">Cakes</a></li>
                                        <li><a href="index-2.html">Lollipop</a></li>
                                        <li><a href="index-3.html">Wedding</a></li>
                                        <li><a href="index-4.html">Coffee</a></li>
                                        <li><a href="index-5.html">Ice-Cream</a></li>
                                        <li><a href="index-6.html">Macaron</a></li>
                                        <li><a href="index-7.html">Shop</a></li>
                                        <li><a href="index-8.html">Landing</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="about-us.html">Pages</a>
                                    <ul>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="our-staff.html">Our Staff</a></li>
                                        <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                        <li><a href="content-elements.html">Content Elements</a></li>
                                        <li><a href="recipes-list.html">Recipes Grid</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="portfolio-masonry.html">Portfolio</a>
                                    <ul>
                                        <li><a href="portfolio-masonry.html">Masonry</a></li>
                                        <li><a href="portfolio-masonry-wide.html">Masonry Wide</a></li>
                                        <li><a href="portfolio-wide.html">Wide</a></li>
                                        <li><a href="portfolio-with-filter.html">With Filter</a></li>
                                        <li><a href="portfolio-two-column.html">Two Columns</a></li>
                                        <li><a href="portfolio-with-sidebar.html">With Sidebar</a></li>
                                        <li><a href="portfolio-square.html">Square</a></li>
                                        <li><a href="portfolio-single.html">single Post</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="navigation menu-right clearfix">
                                <li class="dropdown"><a href="blog-showcase.html">Blog</a>
                                    <ul>
                                        <li><a href="blog-showcase.html">Checkerboard</a></li>
                                        <li><a href="blog-standard.html">Standard</a></li>
                                        <li><a href="blog-masonry.html">Masonry</a></li>
                                        <li><a href="blog-masonry-full-width.html">Masonry Full Width</a></li>
                                        <li><a href="blog-two-column.html">Two Columns Grid</a></li>
                                        <li><a href="blog-three-column-wide.html">Three Columns Wide</a></li>
                                        <li class="dropdown"><a href="#">Post Types</a>
                                            <ul>
                                                <li><a href="blog-single.html">Standard Post</a></li>
                                                <li><a href="blog-single-2.html">Gallery Post</a></li>
                                                <li><a href="blog-single-3.html">Video Post</a></li>
                                                <li><a href="blog-single-4.html">Audio Post</a></li>
                                                <li><a href="blog-single-5.html">Quote Post</a></li>
                                                <li><a href="blog-single-6.html">Link Post</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="shop.html">Shop</a>
                                    <ul>
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="shopping-cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="login.html">My account</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contacts</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <div class="outer-box clearfix">
                        <!-- Shoppping Car -->
                        <div class="cart-btn">
                            <a href="shopping-cart.html"><i class="icon flaticon-commerce"></i> <span class="count">2</span></a>

                            <div class="shopping-cart">
                                <ul class="shopping-cart-items">
                                    <li class="cart-item">
                                        <img src="{{ asset('davilla/images/shopping-cart/shopping-cart-1.png')}}" alt="#" class="thumb" />
                                        <span class="item-name">Birthday Cake</span>
                                        <span class="item-quantity">1 x <span class="item-amount">$84.00</span></span>
                                        <a href="shop-single.html" class="product-detail"></a>
                                        <button class="remove-item"><span class="fa fa-times"></span></button>
                                    </li>

                                    <li class="cart-item">
                                        <img src="{{ asset('davilla/images/shopping-cart/shopping-cart-2.png')}}" alt="#" class="thumb" />
                                        <span class="item-name">French Macaroon</span>
                                        <span class="item-quantity">1 x <span class="item-amount">$13.00</span></span>
                                        <a href="shop-single.html" class="product-detail"></a>
                                        <button class="remove-item"><span class="fa fa-times"></span></button>
                                    </li>
                                </ul>

                                <div class="cart-footer">
                                    <div class="shopping-cart-total"><strong>Subtotal:</strong> $97.00</div>
                                    <a href="cart.html" class="theme-btn">View Cart</a>
                                    <a href="checkout.html" class="theme-btn">Checkout</a>
                                </div>
                            </div> <!--end shopping-cart -->
                        </div>

                        <!-- Search Btn -->
                        <div class="search-box">
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo">
                    <a href="#" title="Sticky Logo"><img src="{{ asset('davilla/images/logo-small.png') }}" alt="Sticky Logo"></a>
                </div>

                <!--Nav Outer-->
                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Header -->
        <div class="mobile-header">
            <div class="logo"><a href="index.html"><img src="{{ asset('davilla/images/logo-small.png') }}" alt="" title=""></a></div>

            <!--Nav Box-->
            <div class="nav-outer clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div>

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="{{ asset('davilla/images/logo-small.png') }}" alt="" title=""></a></div>
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </nav>
        </div><!-- End Mobile Menu -->

        <!-- Header Search -->
        <div class="search-popup">
            <span class="search-back-drop"></span>

            <div class="search-inner">
                <button class="close-search"><span class="fa fa-times"></span></button>
                <form method="post" action="blog-showcase.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search..." required="">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Header Search -->

    </header>
    <!--End Main Header -->