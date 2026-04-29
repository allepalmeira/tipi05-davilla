    <!-- Recipes Section  -->
    @php
    $recipes = asset('davilla/images/4.jpg');
    @endphp

    <section class="recipes-section" style="background-image: url('{{ $recipes }}');">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="divider"><img src="{{ asset('davilla/images/icons/divider_1.png') }}" alt=""></div>
                <h2>Delícias Para Você</h2>
            </div>

            <!-- Recipes Carousel -->
            <div class="recipes-carousel owl-carousel owl-theme">
                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/desk_01.png') }}" alt=""></figure>
                </div>

                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/desk_02.png') }}" alt=""></figure>
                </div>

                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/desk_03.png') }}" alt=""></figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End Recipes Section  -->