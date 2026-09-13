<?php

$pageTitle = "Employee Ranking | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



    <div class="dashboard-header">


        <div>


            <span class="dashboard-small">

                MANAGER ANALYTICS

            </span>



            <h1>

                Employee Performance Ranking

            </h1>



            <p>

                Find your best performing beauticians.

            </p>


        </div>




        <a href="index.php?page=dashboard"
           class="dashboard-logout">

            Back Dashboard

        </a>



    </div>







    <div class="feature-section">


        <h2>

            Top Beauticians

        </h2>





        <div class="table-container">


            <table class="employee-table">


                <thead>


                    <tr>


                        <th>
                            Rank
                        </th>


                        <th>
                            Employee Name
                        </th>


                        <th>
                            Total Services
                        </th>


                        <th>
                            Revenue Generated
                        </th>


                    </tr>


                </thead>





                <tbody>



                <?php if(!empty($ranking)): ?>


                    <?php $rank = 1; ?>


                    <?php foreach($ranking as $employee): ?>



                    <tr>


                        <td>

                            <?= $rank++; ?>

                        </td>



                        <td>

                            <?= htmlspecialchars(
                                $employee['full_name']
                            ); ?>

                        </td>




                        <td>

                            <?= $employee['total_services']; ?>

                        </td>




                        <td>

                            ৳ <?= number_format(
                                $employee['total_revenue']
                            ); ?>

                        </td>



                    </tr>



                    <?php endforeach; ?>



                <?php else: ?>



                    <tr>


                        <td colspan="4">

                            No employee data available.

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