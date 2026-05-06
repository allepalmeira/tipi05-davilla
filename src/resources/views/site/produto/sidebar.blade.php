    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div class="shop-single">
                        <!-- Product Detail -->
                        <div class="product-details">

                            <!--Basic Details-->
                            <div class="basic-details">
                                <div class="row clearfix">
                                    <div class="image-column col-md-6 col-sm-12">
                                        <figure class="image">
                                            <a href="{{ asset('davilla/images/'. $produto->foto_produto) }}" class="lightbox-image" title="{{ $produto->nome_produto }}">
                                                <img src="{{ asset('davilla/images/'. $produto->foto_produto) }}" alt="{{ $produto->nome_produto }}">
                                                <span class="icon fa fa-search"></span>
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="info-column col-md-6 col-sm-12">
                                        <div class="details-header">
                                            <h4>{{ $produto->nome_produto }}</h4>
                                            <div class="rating">
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                            <a class="reviews" href="#">(2 Customer Reviews)</a>
                                            <div class="item-price">{{ number_format($produto->valor_produto, 2,',','.') }}</div>
                                            <div class="text">{{ $produto->descricao_produto }}</div>
                                        </div>

                                        <div class="other-options clearfix">
                                            <div class="item-quantity">Quantidade <input class="qty" type="number" value="1" name="quantity"></div>
                                            <button type="button" class="theme-btn add-to-cart"><span class="btn-title">Add ao reserva</span></button>
                                            <ul class="product-meta">
                                                <li class="posted_in">Categoria: <a href="#">{{ $produto->CategoriaProduto->nome_categoria }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Basic Details-->

                            <!--Product Info Tabs-->
                            <div class="product-info-tabs">
                                <!--Product Tabs-->
                                <div class="prod-tabs tabs-box">

                                    <!--Tab Btns-->
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li data-tab="#prod-details" class="tab-btn">Descrição</li>
                                        <li data-tab="#prod-reviews" class="tab-btn active-btn">Avaliações</li>
                                    </ul>

                                    <!--Tabs Container-->
                                    <div class="tabs-content">

                                        <!--Tab-->
                                        <div class="tab" id="prod-details">
                                            <h2 class="title">Descripton</h2>
                                            <div class="content">
                                                <p>{{ $produto->descricao_produto }}</p>
                                            </div>
                                        </div>

                                        <!--Tab-->
                                        <div class="tab active-tab" id="prod-reviews">
                                            <h2 class="title">Avaliações para {{ $produto->nome_produto }}</h2>

                                            <!--Reviews Container-->
                                            <div class="comments-area">
                                                <!--Comment Box-->
                                                <div class="comment-box">
                                                    <div class="comment">
                                                        <div class="author-thumb"><img src="https://via.placeholder.com/60x60" alt=""></div>
                                                        <div class="comment-inner">
                                                            <div class="comment-info clearfix">
                                                                <strong class="name">Stuart</strong>
                                                                <span class="date">– 07 Jun</span>
                                                            </div>
                                                            <div class="rating">
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star light"></span>
                                                            </div>
                                                            <div class="text">This will go great with my Hoodie that I ordered a few weeks ago.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--Comment Box-->
                                                <div class="comment-box">
                                                    <div class="comment">
                                                        <div class="author-thumb"><img src="https://via.placeholder.com/60x60" alt=""></div>
                                                        <div class="comment-inner">
                                                            <div class="comment-info clearfix">
                                                                <strong class="name">Maria</strong>
                                                                <span class="date">– 07 Jun</span>
                                                            </div>
                                                            <div class="rating">
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star light"></span>
                                                            </div>
                                                            <div class="text">Love this shirt! The ninja near and dear to my heart.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Comment Form-->
                                            <div class="comment-form">
                                                <div class="sub-title">Adicionar um comentário</div>
                                                <div class="form-outer">
                                                    <p>Seu endereço de e-mail não será publicado. Os campos obrigatórios estão marcados com um *</p>
                                                    <div class="rating-box">
                                                        <div class="field-label">Sua avaliação</div>
                                                        <div class="rating">
                                                            <a href="#"><span class="fa fa-star"></span></a>
                                                            <a href="#"><span class="fa fa-star"></span></a>
                                                            <a href="#"><span class="fa fa-star"></span></a>
                                                            <a href="#"><span class="fa fa-star"></span></a>
                                                            <a href="#"><span class="fa fa-star"></span></a>
                                                        </div>
                                                    </div>

                                                    <form method="post" action="#">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                                <div class="field-label">Sua avaliação *</div>
                                                                <textarea name="message" placeholder=""></textarea>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                                <div class="field-label">Nome *</div>
                                                                <input type="text" name="username" placeholder="" required="">
                                                            </div>

                                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                                <div class="field-label">E-mail *</div>
                                                                <input type="email" name="email" placeholder="" required="">
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                                                <input type="submit" name="submit" value="Submit">
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Product Info Tabs-->


                            <!-- Related Products -->
                            <div class="related-products">
                                <div class="sec-title">
                                    <h2>Produtos relacionados</h2>
                                </div>

                                <div class="row clearfix">
                                    <!-- Shop Item -->
                                    @foreach($produtosRelacionados as $produtoRelacionado)
                                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <div class="sale-tag">sale!</div>
                                                <figure class="image"><a href="{{ asset('davilla/images/'. $produtoRelacionado->foto_produto) }}"><img src="{{ asset('davilla/images/'. $produtoRelacionado->foto_produto) }}" alt=""></a></figure>
                                                <div class="btn-box"><a href="#">Add a reserva</a></div>
                                            </div>
                                            <div class="lower-content">
                                                <h4 class="name"><a href="{{ $produtoRelacionado->slug_produto }}">{{ $produtoRelacionado->nome_produto }}</a></h4>
                                                <div class="rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star light"></span></div>
                                                <div class="price">R$ {{ number_format($produtoRelacionado->valor_produto, 2, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div><!-- End Related Products -->
                        </div><!-- Product Detail -->
                    </div><!-- End Shop Single -->
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                    <aside class="sidebar theiaStickySidebar">
                        <div class="sticky-sidebar">
                            <!-- Search Widget -->
                            <div class="sidebar-widget search-widget">
                                <form method="post" action="contact.html">
                                    <div class="form-group">
                                        <input type="search" name="search-field" value="" placeholder="pesquisar produto" required>
                                        <button type="submit"><span class="icon fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!-- Cart Widget -->
                            <div class="sidebar-widget cart-widget">
                                <div class="widget-content">
                                    <h3 class="widget-title">Reserva</h3>

                                    <div class="shopping-cart">
                                        <ul class="shopping-cart-items">
                                            <li class="cart-item">
                                                <img src="{{ asset('davilla/images/pricing.png') }}" alt="#" class="thumb" />
                                                <span class="item-name">Birthday Cake</span>
                                                <span class="item-quantity">1 x <span class="item-amount">$84.00</span></span>
                                                <a href="#" class="product-detail"></a>
                                                <button class="remove-item"><span class="fa fa-times"></span></button>
                                            </li>

                                        </ul>

                                        <div class="cart-footer">
                                            <div class="shopping-cart-total"><strong>Subtotal:</strong> $97.00</div>
                                            <a href="#" class="theme-btn">Resevar</a>
                                        </div>
                                    </div> <!--end shopping-cart -->
                                </div>
                            </div>

                            <!-- Tags Widget -->
                            <div class="sidebar-widget tags-widget">
                                <h3 class="widget-title">Categorias</h3>
                                <ul class="tag-list clearfix">
                                    @foreach($listaCategoria as $linha)
                                    <li><a href="#">{{ $linha->nome_categoria }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!--End Sidebar Page Container-->