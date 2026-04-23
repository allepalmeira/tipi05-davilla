    <!-- Testimonial Section -->
    @php
    $testimonial = asset('davilla/images/3.jpg');
    @endphp
    <section class="testimonial-section style-two">
        <div class="shape_wrapper shape_one">
            <div class="shape_inner shape_two" style="background-image: url('{{ $testimonial }}');">
                <div class="overlay"></div>
            </div>
        </div>

        <div class="auto-container">
            <div class="sec-title light text-center">
                <h2>Our Bakery</h2>
            </div>

            <!-- Testimonial Carousel -->
            <div class="testimonial-carousel owl-carousel owl-theme">
                <!-- Testimonial Block -->
                <div class="testimonial-block">
                    <div class="inner-box">
                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel sem imperdiet, venenatis eros ac,mattis mauris. Nam ac purus justo. Vivamus non hendrerit velit.</div>
                    </div>
                </div>

                <!-- Testimonial Block -->
                <div class="testimonial-block">
                    <div class="inner-box">
                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel sem imperdiet, venenatis eros ac,mattis mauris. Nam ac purus justo. Vivamus non hendrerit velit.</div>
                    </div>
                </div>

                <!-- Testimonial Block -->
                <div class="testimonial-block">
                    <div class="inner-box">
                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel sem imperdiet, venenatis eros ac,mattis mauris. Nam ac purus justo. Vivamus non hendrerit velit.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Testimonial Section -->