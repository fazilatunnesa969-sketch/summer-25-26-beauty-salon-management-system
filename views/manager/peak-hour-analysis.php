<?php

$pageTitle = "Peak Hour Analysis | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



    <div class="dashboard-header">


        <div>


            <span class="dashboard-small">

                MANAGER ANALYTICS

            </span>



            <h1>

                Peak Hour Analysis

            </h1>



            <p>

                Analyze the busiest booking hours of your salon.

            </p>


        </div>




        <a href="index.php?page=dashboard"
           class="dashboard-logout">

            Back Dashboard

        </a>



    </div>







    <div class="feature-section">


        <h2>

            Booking Activity

        </h2>





        <div class="table-container">


            <table class="employee-table">


                <thead>


                    <tr>


                        <th>
                            Rank
                        </th>


                        <th>
                            Booking Time
                        </th>


                        <th>
                            Total Bookings
                        </th>


                    </tr>


                </thead>





                <tbody>



                <?php if(!empty($peakHours)): ?>


                    <?php $rank = 1; ?>


                    <?php foreach($peakHours as $hour): ?>



                    <tr>


                        <td>

                            <?= $rank++; ?>

                        </td>




                        <td>

                            <?= date(
                                "h:i A",
                                strtotime(
                                    $hour['appointment_time']
                                )
                            ); ?>

                        </td>





                        <td>

                            <?= $hour['total_bookings']; ?>

                        </td>



                    </tr>



                    <?php endforeach; ?>



                <?php else: ?>



                    <tr>

                        <td colspan="3">

                            No booking data available.

                        </td>


                    </tr>



                <?php endif; ?>




                </tbody>



            </table>


        </div>



    </div>






</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>