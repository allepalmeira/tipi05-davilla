    <!-- Recipes Section  -->
    @php
    $recipes = asset('davilla/images/recipes.png');
    @endphp

    <section class="recipes-section" style="background-image: url('{{ $recipes }}');">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="divider"><img src="{{ asset('davilla/images/icons/divider_1.png') }}" alt=""></div>
                <h2>Recipes For You</h2>
            </div>

            <!-- Recipes Carousel -->
            <div class="recipes-carousel owl-carousel owl-theme">
                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/icons/divider_1.png') }}" alt=""></figure>
                </div>

                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/icons/divider_2.png') }}" alt=""></figure>
                </div>

                <!-- Recipe Block -->
                <div class="recipe-block">
                    <figure class="recipe-image"><img src="{{ asset('davilla/images/icons/divider_3.png') }}" alt=""></figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End Recipes Section  -->