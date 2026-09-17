<?php

$pageTitle = "Revenue Analytics | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



    <div class="dashboard-header">


        <div>


            <span class="dashboard-small">

                MANAGER ANALYTICS

            </span>



            <h1>

                Revenue Analytics

            </h1>



            <p>

                Track salon income and business performance.

            </p>


        </div>



        <a href="index.php?page=dashboard"
           class="dashboard-logout">

            Back Dashboard

        </a>


    </div>







    <div class="dashboard-cards">





        <div class="dash-card">


            <span>

                Total Revenue

            </span>



            <h2>

                ৳ <?= number_format($totalRevenue); ?>

            </h2>


        </div>







        <div class="dash-card">


            <span>

                This Month Revenue

            </span>



            <h2>

                ৳ <?= number_format($monthlyRevenue); ?>

            </h2>


        </div>







        <div class="dash-card">


            <span>

                Total Bookings

            </span>



            <h2>

                <?= $totalBookings; ?>

            </h2>


        </div>





    </div>







    <div class="feature-section">



        <h2>

            Revenue Summary

        </h2>




        <div class="feature-card">


            <h3>

                Business Overview

            </h3>


            <p>

                LA MIRROR revenue analytics helps the manager
                understand total income, monthly growth
                and booking performance.

            </p>


        </div>



    </div>






</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>