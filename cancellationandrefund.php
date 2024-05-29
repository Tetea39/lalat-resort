<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<link rel="stylesheet" href="scss/normalize.css">
<link rel="stylesheet" href="scss/foundation.css">
<link rel="stylesheet" href="scss/style.css">
<link rel="stylesheet" href="scss/datepicker.css">
<link href="scss/datepicker.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
<!--link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        $("#checkout").datepicker();
        $("#checkin").datepicker({
            minDate: new Date(),
            onSelect: function(dateText, inst) {
                var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
                $("#checkout").datepicker("option", "minDate", date);
            }
        });
    });
</script>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta class="foundation-data-attribute-namespace">
<meta class="foundation-mq-xxlarge">
<meta class="foundation-mq-xlarge">
<meta class="foundation-mq-large">
<meta class="foundation-mq-medium">
<meta class="foundation-mq-small">
<style></style>
<meta class="foundation-mq-topbar">
</head>

<body class="fontbody" style="background-image : url(img/background.jpg); no-repeat center center fixed; background-size: cover;">



    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1C2331">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./img/lalat3.png" alt="" srcset=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container policy-bg" style="margin-top: 4rem;">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="text-center text-white"> Cancellation and Refund Policy </h1>
                <h3 class="text-white font-weight-bold"> Lalat Resort Cancellation and Refund Policy </h3>

                <h4> Effective Date: 28th June,2024 </h4>

                <h6 class="text-white">
                    <h5 class="text-white"> 1. Cancellation Policy</h5>
                    Cancellations made 3 days before the check-in date will receive a full refund. <br>
                    Cancellations made 24 hours prior to the check-in date will incur a 5% cancellation fee.<br>

                    <h5 class="text-white">2. No-Show Policy </h5>
                    Guests who do not show up on the check-in date without prior notice will be charged the full amount of the reservation. <br>

                    <h5 class="text-white">3. Early Departure </h5>
                    No refunds will be issued for early departures.<br>

                    <h5 class="text-white">4. Refund Process </h5>
                    Refunds will be processed within 3/4 business days after the cancellation is confirmed. The amount will be credited back to the original payment method. <br>

                    <h5 class="text-white">5. Contact Us </h5>
                    If you have any questions or concerns about this Cancellation and Refund Policy, please contact us at:
                    <span class="font-weight-bold"> 9362879889 </span>
                </h6>
            </div>
        </div>
    </div>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-57205452-1', 'auto');
        ga('send', 'pageview');
    </script>


    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div class="container my-5">
        <!-- Footer -->
        <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
                <!-- Left -->
                <div class="me-5">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <script src="https://kit.fontawesome.com/e74869c2fd.js" crossorigin="anonymous"></script>

                <!-- Right -->
                <div>
                    <a href="https://www.facebook.com/profile.php?id=100090963160287" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <!-- <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a> -->
                    <!-- <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a> -->
                    <a href="https://www.instagram.com/lalat_resort/" class="text-white me-4">
                        <i class="fab fa-instagram"></i>
                    </a>



                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold text-light">Lalat Resort</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                The Lalat Resort is a serene retreat where luxury meets comfort. - Discover a haven that enchants your senses from the moment you step in.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold text-light">Facilities</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="#!" class="text-white">Event Hall</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Resturant</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Trekking</a>
                            </p>

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold text-light">Useful links</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="./admin/index.htm" class="text-white">Admin</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Career</a>
                            </p>
                            <p>
                                <a href="./privacypolicy.php" class="text-white">Privacy Policy</a>
                            </p>
                            <p>
                                <a href="./termsandconditions.php" class="text-white">Terms and Conditions</a>
                            </p>
                            <p>
                                <a href="./cancellationandrefund.php" class="text-white">Cancellation and Refund</a>
                            </p>
                            <!-- <p>
              <a href="#!" class="text-white">Shipping Rates</a>
            </p> -->

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold text-light">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p><i class="fas fa-home mr-3"></i>Aizawl, Mizoram</p>
                            <p><i class="fas fa-envelope mr-3"></i>info@lalat.com</p>
                            <p><i class="fas fa-phone mr-3"></i> +91 9362879889</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Copyright:
                <a class="text-white" href="#">Lalat Resort</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

    </div>
    <!-- End of .container -->



</body>

</html>