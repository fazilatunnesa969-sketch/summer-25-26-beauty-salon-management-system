<?php

$pageTitle = "My Profile | LA MIRROR";

require __DIR__ . '/../partials/header.php';

?>


<div class="dashboard-wrapper">


<!-- HEADER -->

<div class="dashboard-header">


<div>

<span class="dashboard-small">
MY PROFILE
</span>


<h1>
Customer Profile
</h1>


<p>
Manage your personal information and appointment history.
</p>

</div>



<a href="index.php?page=customer-dashboard"
class="dashboard-logout">

Back Dashboard

</a>


</div>





<!-- PROFILE BANNER -->


<div class="profile-banner">


<div class="profile-avatar">

<?= strtoupper(substr($profile['full_name'] ?? 'U',0,1)); ?>

</div>



<div class="profile-user">


<h2>

<?= htmlspecialchars($profile['full_name'] ?? 'Customer'); ?>

</h2>


<p>
Customer Account
</p>


<span class="customer-id">

ID #<?= htmlspecialchars($profile['customer_id'] ?? 'N/A'); ?>

</span>


</div>





<div class="profile-brand">


<h3>
LA MIRROR
</h3>

<p>
BEAUTY SALON
</p>


<a href="index.php?page=book-appointment"
class="feature-btn">

Book Appointment

</a>


</div>


</div>








<!-- PERSONAL INFORMATION -->


<div class="section-title">

<h2>
Personal Information
</h2>

</div>





<div class="profile-grid">



<div class="profile-info-card">


<h3>
📞 Contact Details
</h3>



<div class="info-row">

<span>
Customer ID
</span>

<b>
#<?= htmlspecialchars($profile['customer_id'] ?? 'N/A'); ?>
</b>


</div>



<div class="info-row">

<span>
Email
</span>

<b>
<?= htmlspecialchars($profile['email'] ?? ''); ?>
</b>


</div>



<div class="info-row">

<span>
Phone
</span>

<b>
<?= htmlspecialchars($profile['phone'] ?? ''); ?>
</b>


</div>



</div>







<div class="profile-info-card">


<h3>
🛡 Account Status
</h3>



<div class="info-row">

<span>
Status
</span>


<span class="active-badge">
Active
</span>


</div>




<div class="info-row">

<span>
Member Since
</span>

<b>
2026
</b>


</div>



<div class="quote-box">

"Beautiful Skin,
Happy You!"

</div>



</div>





</div>









<!-- APPOINTMENT HISTORY -->


<div class="section-title">

<h2>
Appointment History
</h2>

</div>






<?php if(!empty($appointmentHistory)): ?>



<?php foreach($appointmentHistory as $appointment): ?>



<div class="appointment-history-card">



<div class="date-box">


<span>

<?= date(
"M",
strtotime($appointment['appointment_date'])
); ?>

</span>



<strong>

<?= date(
"d",
strtotime($appointment['appointment_date'])
); ?>

</strong>



<small>

<?= date(
"D",
strtotime($appointment['appointment_date'])
); ?>

</small>


</div>







<div class="appointment-details">


<h3>

<?= htmlspecialchars($appointment['service_name']); ?>

</h3>



<p>

Appointment ID:
#<?= htmlspecialchars($appointment['appointment_id']); ?>

</p>




<div class="history-row">


<div>

Time

<br>

<b>
<?= htmlspecialchars($appointment['appointment_time']); ?>
</b>

</div>




<div>

Status

<br>


<span class="cancel-badge">

<?= htmlspecialchars($appointment['status']); ?>

</span>


</div>





<div>

Payment

<br>


<span class="paid-badge">

<?= htmlspecialchars($appointment['payment_status']); ?>

</span>


</div>



</div>


</div>




<span class="past-badge">

Past Appointment

</span>



</div>




<?php endforeach; ?>



<?php else: ?>


<div class="profile-info-card">

<h3>
No History Found
</h3>

</div>


<?php endif; ?>






</div>




<?php

require __DIR__ . '/../partials/footer.php';

?>