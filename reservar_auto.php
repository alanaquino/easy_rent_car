<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php
$title = "Cars - Easy Rent Car Latinoamérica";
include('./head.php');
?>


<body>


<!-- backtotop - start -->
<div id="thetop"></div>
<div class="backtotop">
    <a href="#" class="scroll">
        <i class="far fa-arrow-up"></i>
    </a>
</div>
<!-- backtotop - end -->

<!-- preloader - start -->
<div class="preloader">
    <div class="animation_preloader">
        <div class="spinner"></div>
        <p class="text-center">Loading</p>
    </div>
    <div class="loader">
        <div class="row vh-100">
            <div class="col-3 loader_section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader_section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader_section section-right">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader_section section-right">
                <div class="bg"></div>
            </div>
        </div>
    </div>
</div>
<!-- preloader - end -->

<!-- header_section -->
<?php include('./header.php'); ?>


<!-- main body - start
================================================== -->
<main>

    <!-- mobile menu -->
    <?php include('./mobile_menu.php'); ?>

    <!-- breadcrumb_section - start
			================================================== -->
    <section class="breadcrumb_section text-center clearfix">
        <div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_03.jpg">
            <div class="overlay"></div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <h1 class="page_title text-white mb-0">Reservation</h1>
            </div>
        </div>
        <div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
            <div class="container">
                <ul class="ul_li clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="car.html">Our Cars</a></li>
                    <li>Reservation</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- reservation_section - start
	================================================== -->
    <section class="reservation_section sec_ptb_100 clearfix">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

                <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
                    <div class="feature_vehicle_item mt-0 ml-0" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="item_title mb-0">
                            <a href="#!">
                                2020 Audi New Generation P00234
                            </a>
                        </h3>
                        <div class="item_image position-relative">
                            <a class="image_wrap" href="#!">
                                <img src="assets/images/feature/img_03.jpg" alt="image_not_found">
                            </a>
                            <span class="item_price bg_default_blue">$230/Day</span>
                        </div>
                        <ul class="info_list ul_li_center clearfix">
                            <li>Sports</li>
                            <li>Auto</li>
                            <li>2 Passengers</li>
                            <li>Electro</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="reservation_form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Pick Up Location</h4>
                                        <div class="position-relative">
                                            <input id="location_two" type="text" name="location" placeholder="86 Albert Road, London, N51 4VK">
                                            <label for="location_two" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="200">
                                        <h4 class="input_title">Pick A Date</h4>
                                        <input type="date" name="date">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="300">
                                        <h4 class="input_title">Time</h4>
                                        <input type="time" name="time">
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="400">
                                        <h4 class="input_title">Pick Up Location</h4>
                                        <div class="position-relative">
                                            <input id="location_three" type="text" name="location" placeholder="86 Albert Road, London, N51 4VK">
                                            <label for="location_three" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="500">
                                        <h4 class="input_title">Pick A Date</h4>
                                        <input type="date" name="date">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="600">
                                        <h4 class="input_title">Time</h4>
                                        <input type="time" name="time">
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0" data-aos="fade-up" data-aos-delay="700">

                            <div class="reservation_offer_checkbox">
                                <h4 class="input_title" data-aos="fade-up" data-aos-delay="800">Your Offer Includes:</h4>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="900">
                                        <div class="checkbox_input">
                                            <label for="offer1"><input type="checkbox" id="offer1" checked> Registration Free/ Road Tax</label>
                                        </div>
                                        <div class="checkbox_input">
                                            <label for="offer2"><input type="checkbox" id="offer2" checked> Fully Comprehensive Insurance</label>
                                        </div>
                                        <div class="checkbox_input">
                                            <label for="offer3"><input type="checkbox" id="offer3" checked> Unlimited Mileage</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="900">
                                        <div class="checkbox_input">
                                            <label for="offer4"><input type="checkbox" id="offer4" checked> Excess/Security Deposit</label>
                                        </div>
                                        <div class="checkbox_input">
                                            <label for="offer5"><input type="checkbox" id="offer5"> Baby Seat: $23/Day</label>
                                        </div>
                                        <div class="checkbox_input">
                                            <label for="offer6"><input type="checkbox" id="offer6"> Breakdown Assistance</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0" data-aos="fade-up" data-aos-delay="100">

                            <div class="reservation_customer_details">
                                <h4 class="input_title" data-aos="fade-up" data-aos-delay="100">Customer Details:</h4>
                                <ul class="customer_gender ul_li clearfix" data-aos="fade-up" data-aos-delay="300">
                                    <li>
                                        <div class="checkbox_input">
                                            <label for="mr"><input type="radio" id="mr" name="gender"> Mr.</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox_input">
                                            <label for="ms"><input type="radio" id="ms" name="gender"> Ms.</label>
                                        </div>
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-xs-12 col-xs-12">
                                        <div class="form_item" data-aos="fade-up" data-aos-delay="400">
                                            <input type="text" name="firstname" placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-xs-12 col-xs-12">
                                        <div class="form_item" data-aos="fade-up" data-aos-delay="500">
                                            <input type="text" name="lastname" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-xs-12 col-xs-12">
                                        <div class="form_item" data-aos="fade-up" data-aos-delay="600">
                                            <input type="text" name="email" placeholder="E-mail adress">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-xs-12 col-xs-12">
                                        <div class="form_item" data-aos="fade-up" data-aos-delay="700">
                                            <input type="text" name="tel" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="form_item" data-aos="fade-up" data-aos-delay="800">
                                    <textarea name="information" placeholder="Additional information (Optional)"></textarea>
                                </div>

                                <div data-aos="fade-up" data-aos-delay="100">
                                    <a class="terms_condition" href="#!"><i class="fas fa-info-circle mr-1"></i> You must be at least 21 years old to rent this car. Collision Damage Waiver (CDW)</a>
                                </div>

                                <hr data-aos="fade-up" data-aos-delay="200">

                                <div class="row align-items-center justify-content-lg-between">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                                        <a class="bonus_program" href="#!"><i class="far fa-angle-left mr-1"></i> Bonus Program</a>
                                        <div class="checkbox_input mb-0">
                                            <label for="accept"><input type="checkbox" id="accept"> I accept all information and Payments etc</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="300">
                                        <button type="submit" class="custom_btn bg_default_red text-uppercase">Reservation Now <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- reservation_section - end
    ================================================== -->





</main>
<!-- main body - end
================================================== -->


<!-- footer_section -->
<?php include('./footer.php'); ?>

<!-- include_section -->
<?php include('./include.php'); ?>

</body>
</html>