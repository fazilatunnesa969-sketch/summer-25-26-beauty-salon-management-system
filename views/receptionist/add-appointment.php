<?php

$pageTitle = "Add Appointment | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



    <div class="dashboard-header">


        <div>


            <span class="dashboard-small">

                RECEPTIONIST PANEL

            </span>



            <h1>

                Create Appointment

            </h1>



            <p>

                Add a new customer appointment.

            </p>


        </div>




        <a href="index.php?page=appointment-queue"
           class="dashboard-logout">

            Back Queue

        </a>



    </div>







<div class="feature-section">



<div class="feature-card">



<form method="POST"
action="index.php?page=add-appointment">





<!-- CUSTOMER -->

<div class="register-field">


<label>

Customer

</label>



<select

name="customer_id"

required

>


<option value="">

Select Customer

</option>



<?php foreach($customers as $customer): ?>


<option

value="<?= $customer['id']; ?>"

>


<?= htmlspecialchars(
    $customer['full_name']
); ?>


</option>



<?php endforeach; ?>


</select>



</div>









<!-- BEAUTICIAN -->


<div class="register-field">


<label>

Beautician

</label>



<select

name="beautician_id"

required

>


<option value="">

Select Beautician

</option>



<?php foreach($beauticians as $beautician): ?>


<option

value="<?= $beautician['id']; ?>"

>


<?= htmlspecialchars(
    $beautician['full_name']
); ?>


</option>



<?php endforeach; ?>


</select>



</div>









<!-- SERVICE -->


<div class="register-field">


<label>

Service

</label>



<select

name="service_id"

required

>


<option value="">

Select Service

</option>



<?php foreach($services as $service): ?>


<option

value="<?= $service['id']; ?>"

>


<?= htmlspecialchars(
    $service['service_name']
); ?>


</option>



<?php endforeach; ?>


</select>



</div>









<!-- DATE -->


<div class="register-field">


<label>

Appointment Date

</label>



<input

type="date"

name="appointment_date"

required

>



</div>









<!-- TIME -->


<div class="register-field">


<label>

Appointment Time

</label>



<input

type="time"

name="appointment_time"

required

>



</div>









<button

type="submit"

class="feature-btn"

>

Save Appointment

</button>





</form>



</div>



</div>






</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>