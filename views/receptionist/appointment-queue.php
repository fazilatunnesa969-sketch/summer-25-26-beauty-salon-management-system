<?php

$pageTitle = "Appointment Queue | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



    <div class="dashboard-header">


        <div>

            <span class="dashboard-small">

                RECEPTIONIST PANEL

            </span>



            <h1>

                Appointment Queue

            </h1>



            <p>

                Manage customer appointments easily.

            </p>


        </div>





        <a href="index.php?page=dashboard"

           class="dashboard-logout">

            Back Dashboard

        </a>



    </div>









    <!-- ADD APPOINTMENT BUTTON -->


    <a href="index.php?page=add-appointment"

       class="feature-btn">

        + New Appointment

    </a>









    <!-- SEARCH -->


    <div class="appointment-search">



        <form method="GET"

              action="index.php">



            <input

                type="hidden"

                name="page"

                value="appointment-queue"

            >




            <input
type="text"
id="appointmentQueueSearch"
placeholder="Search customer, service..."
>




            <button

                type="submit"

                class="search-btn">

                Search

            </button>



        </form>



    </div>









    <!-- APPOINTMENT TABLE -->


    <div class="feature-section">


        <h2>

            Appointment List

        </h2>






        <div class="table-container">



            <table class="employee-table">


                <thead>


                    <tr>


                        <th>
                            ID
                        </th>


                        <th>
                            Customer
                        </th>


                        <th>
                            Service
                        </th>


                        <th>
                            Beautician
                        </th>


                        <th>
                            Date
                        </th>


                        <th>
                            Time
                        </th>


                        <th>
                            Status
                        </th>


                        <th>
                            Action
                        </th>


                    </tr>


                </thead>







                <tbody id="appointmentTableBody">



                <?php if(!empty($appointments)): ?>



                    <?php foreach($appointments as $appointment): ?>



                    <tr>



                        <td>

                            <?= $appointment['id']; ?>

                        </td>






                        <td>

                            <?= htmlspecialchars(
                                $appointment['customer_name'] ?? 'N/A'
                            ); ?>

                        </td>







                        <td>

                            <?= htmlspecialchars(
                                $appointment['service_name'] ?? 'N/A'
                            ); ?>

                        </td>







                        <td>


<?php if(
empty($appointment['beautician_id'])
): ?>


<form method="POST"

action="index.php?page=assign-beautician">


<input

type="hidden"

name="appointment_id"

value="<?= $appointment['id']; ?>">



<select

name="beautician_select"

class="beautician-select"

onchange="setBeautician(<?= $appointment['id']; ?>, this.value)"

required>


<option value="">

Select Beautician

</option>



<?php foreach($beauticians as $beautician): ?>


<option

value="<?= $beautician['id']; ?>">

<?= htmlspecialchars(
$beautician['full_name']
); ?>


</option>


<?php endforeach; ?>


</select>


</form>



<?php else: ?>


<?= htmlspecialchars(
$appointment['beautician_name']
); ?>


<br>


<span>

Confirmed

</span>


<?php endif; ?>


</td>





                        <td>

                            <?= $appointment['appointment_date']; ?>

                        </td>







                        <td>

                            <?= $appointment['appointment_time']; ?>

                        </td>







                        <td>

                            <?= ucfirst(
                                $appointment['status']
                            ); ?>


                        </td>

                        <td class="action-cell">


<?php if(empty($appointment['beautician_id'])): ?>


<form method="POST"

action="index.php?page=assign-beautician"

style="display:inline;">


<input

type="hidden"

name="appointment_id"

value="<?= $appointment['id']; ?>">



<input

type="hidden"

name="beautician_id"

class="beautician-hidden-<?= $appointment['id']; ?>">



<button

type="submit"

class="feature-btn">

Confirm

</button>


</form>


<?php endif; ?>





<a href="index.php?page=delete-appointment&id=<?= $appointment['id']; ?>"

class="delete-btn"

onclick="return confirm('Delete appointment?')">

Delete

</a>


</td>





                        </tr>



                    <?php endforeach; ?>





                <?php else: ?>



                    <tr>


                        <td colspan="8">

                            No appointment found.

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