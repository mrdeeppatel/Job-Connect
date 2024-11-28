<!-- Rest of your HTML/PHP code -->


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job board HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php include 'headder.php'; ?>
    <main>


        <!-- slider Area End-->
        <!-- Our Services Start -->
        <div class="our-services " style="background-color: rgb(221, 239, 250)">
            <div class="">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title" style="text-align: center; margin: 20px 0;">
                            <h3 style="margin: 10px 0;"></h3>
                            <span style="display: block; font-size: 1em; color: #333; margin: 10px 0;">FEATURED JOBS
                            </span>
                            <h3 style="margin: 10px 0;">Browse Top Categories</h3>
                        </div>
                    </div>
                </div>

                <!-- <div class="row d-flex justify-contnet-center"> -->


                <?php
                // Include your database connection
// include 'header.php';
                
                echo '<div class="row d-flex justify-content-center">';

                // Query to fetch data from the database
                $sqlcat = "SELECT * FROM catagory";
                $resultCat = mysqli_query($con, $sqlcat);

                // Check if there are any records
                if (mysqli_num_rows($resultCat) > 0) {
                    while ($rowCat = mysqli_fetch_assoc($resultCat)) {
                        // Generate the HTML block for each record that meets the condition
                        echo '<a href="JobList.php?action=saveValue&value=' . $rowCat['catName'] . '">';
                        echo '    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                        echo '        <div class="single-services text-center mb-30">';
                        echo '            <div class="services-ion">';
                        echo '                <img src="' . $rowCat['catInameLink'] . '" alt="' . $rowCat['catName'] . ' Image" width="80" height="80">';
                        echo '            </div>';
                        echo '            <div class="services-cap">';
                        echo '                <h5><a href="job_listing.html">' . $rowCat['catName'] . '</a></h5>';
                        echo '                <span>(658)</span>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</a>';
                    }
                } else {
                    echo 'No records found.';
                }

                // Close the database connection
                // mysqli_close($con);
                
                echo '</div>';
                ?>

                <!-- </div> -->
                <!-- More Btn -->
                <!-- Section Button -->

            </div>
        </div>
        <!-- Our Services End -->
        <!-- Online CV Area Start 
         <div class="online-cv cv-bg section-overly pt-90 pb-120"  data-background="assets/img/gallery/cv_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="cv-caption text-center">
                            <p class="pera1">FEATURED TOURS Packages</p>
                            <p class="pera2"> Make a Difference with Your Online Resume!</p>
                            <a href="#" class="border-btn2 border-btn4">Upload your cv</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Online CV Area End-->
        <!-- Featured_job_start -->
        <section class="featured-job-area support-padding">
            <div class="container">
                <!-- Section Tittle -->
                <?php
                // Include your database connection
                require_once 'config.php';

                // SQL query to retrieve 3 random entries
                $sql = "SELECT id, name, surname, address, classification, photo ,email,phone_number FROM userdata ORDER BY RAND() LIMIT 3 ";
                $result = mysqli_query($con, $sql);

                // Check if there are any records
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Generate the HTML block for each record that meets the condition
                        echo '<div class="container">';
                        echo '<div class="single-job-items mb-30">';
                        echo '    <div class="job-items">';
                        echo '        <div class="company-img">';
                        echo '            <a href="#"><img src="uploads/' . $row['photo'] . '" alt="" style="width: 100px; height: 100px; object-fit: cover;"></a>';
                        echo '        </div>';
                        echo '        <div class="job-tittle job-tittle2">';
                        echo '            <a href="#">';
                        echo '                <h4>' . $row['name'] . ' ' . $row['surname'] . '</h4>';
                        echo '            </a>';
                        echo '            <ul>';
                        echo '                <li>' . $row['classification'] . '</li><br>';
                        echo '                <li><i class="fas fa-map-marker-alt"></i>' . $row['address'] . '</li> <br>';
                        echo '                <li><i class="fas fa-envelope"></i> ' . $row['email'] . '</li><br>';
                        echo '                <li><i class="fas fa-phone"></i> ' . $row['phone_number'] . '</li><br>';
                        echo '            </ul>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <div class="items-link items-link2 f-right">';
                        echo '        <a href="job_details.html">View Details</a>';
                        echo '        <span>' . date('F j, Y, g:i a') . '</span>'; // Adjust date/time as needed
                        echo '    </div>';
                        echo '</div>';
                        echo '</div>';

                    }
                } else {
                    echo 'No records found.';
                }


                // Close the database connection
                mysqli_close($con);
                ?>
            </div>
        </section>
        <!-- Featured_job_end -->
        <!-- How  Apply Process Start
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets/img/gallery/how-applybg.png">
            <div class="container">
                <!-- Section Tittle 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span>Apply process</span>
                            <h2> How it works</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption 
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                               <h5>1. Search a job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                               <h5>2. Apply for job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                               <h5>3. Get your job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <!-- How  Apply Process End-->

        <!-- Testimonial End -->
        <!-- Support Company Start
         <div class="support-company-area support-padding fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle 
                            <div class="section-tittle section-tittle2">
                                <span>What we are doing</span>
                                <h2>24k Talented people are getting Jobs</h2>
                            </div>
                            <div class="support-caption">
                                <p class="pera-top">Mollit anim laborum duis au dolor in voluptate velit ess cillum dolore eu lore dsu quality mollit anim laborumuis au dolor in voluptate velit cillum.</p>
                                <p>Mollit anim laborum.Duis aute irufg dhjkolohr in re voluptate velit esscillumlore eu quife nrulla parihatur. Excghcepteur signjnt occa cupidatat non inulpadeserunt mollit aboru. temnthp incididbnt ut labore mollit anim laborum suis aute.</p>
                                <a href="about.html" class="btn post-btn">Post a job</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img">
                            <img src="assets/img/service/support-img.jpg" alt="">
                            <div class="support-img-cap text-center">
                                <p>Since</p>
                                <span>1994</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- Blog Area Start -->
        <div class="home-blog-area ">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Our latest blog</span>
                            <h2>Our recent news</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="assets/img/blog/home-blog1.jpg" alt="">
                                    <!-- Blog date -->
                                    <div class="blog-date text-center">
                                        <span>24</span>
                                        <p>Now</p>
                                    </div>
                                </div>
                                <div class="blog-cap">
                                    <p>| Properties</p>
                                    <h3><a href="single-blog.html">Footprints in Time is perfect House in
                                            Kurashiki</a>
                                    </h3>
                                    <a href="#" class="more-btn">Read more »</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="assets/img/blog/home-blog2.jpg" alt="">
                                    <!-- Blog date -->
                                    <div class="blog-date text-center">
                                        <span>24</span>
                                        <p>Now</p>
                                    </div>
                                </div>
                                <div class="blog-cap">
                                    <p>| Properties</p>
                                    <h3><a href="single-blog.html">Footprints in Time is perfect House in
                                            Kurashiki</a>
                                    </h3>
                                    <a href="#" class="more-btn">Read more »</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Area End -->

    </main>
    <?php include 'footer.html'; ?>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>