<?php


$pageTitle = "Safety Alert | LA MIRROR";


require __DIR__ . '/../partials/header.php';


?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>


<span class="dashboard-small">

BEAUTICIAN PANEL

</span>



<h1>

Customer Safety Alerts

</h1>



<p>

Review customer allergy and safety information before starting service.

</p>


</div>



<a href="index.php?page=beautician-dashboard"
class="dashboard-logout">

Back Dashboard

</a>



</div>





<div class="feature-grid">

<?php foreach($alerts as $alert): ?>



<div class="feature-card">



<h3>

<?= htmlspecialchars(
    $alert['customer_name'] ?? ''
); ?>

</h3>





<p>

<b>Service:</b>

<?= htmlspecialchars(
    $alert['service_name'] ?? 'N/A'
); ?>


</p>






<p>

<b>Appointment Date:</b>

<?= htmlspecialchars(
    $alert['appointment_date'] ?? 'N/A'
); ?>


</p>





<p>

<b>Time:</b>

<?= htmlspecialchars(
    $alert['appointment_time'] ?? 'N/A'
); ?>


</p>







<p>

<b>Allergy / Safety Issue:</b>


<br>


<?= htmlspecialchars(
    $alert['allergy_name'] ?? ''
); ?>


</p>







<p>

<b>Note:</b>


<br>


<?= htmlspecialchars(
    $alert['note'] ?? ''
); ?>


</p>








<span class="dashboard-small">

Status:

<?= ucfirst(
    $alert['status'] ?? 'pending'
); ?>


</span>






<br><br>



<a 

href="index.php?page=delete-alert&id=<?= $alert['id']; ?>"

class="danger-btn"

onclick="return confirm('Delete this alert?');"

>

Delete

</a>





</div>




<?php endforeach; ?>



</div>



</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>
