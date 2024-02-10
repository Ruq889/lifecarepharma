<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="footer-content text">
                    <h3>About</h3>
                    <p>Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor incididunt ut labore dolore
                        magna aliqua enim ad minim veniam quis nostrud exercita.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-content">
                    <h3>Quick Links</h3>
                    <div class="footer-links">
                        <ul>
                            <li><a href="#">Donate</a></li>
                            <li><a href="#">Sponsor</a></li>
                            <li><a href="#">Fundraise</a></li>
                            <li><a href="#">Volunteer</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-content">
                    <h3>Contacts</h3>
                    <div class="footer-links">
                        <ul>
                            <li><a href="#"> Bath Ave, Wolverhampton, West Midlands, United Kingdom</a></li>
                            <li><a href="#"> + 01902 552150</a></li>
                            <li><a href="#">ambubook@gmail.com.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.js"></script>

    <script>
        $('.banner-section .owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        $('.mynav-next').click(function() {
                $(".owl-carousel").trigger('next.owl.carousel');
            })
            // Go to the previous item
        $('.mynav-prev').click(function() {
            $(".owl-carousel").trigger('prev.owl.carousel');
        })
    </script>