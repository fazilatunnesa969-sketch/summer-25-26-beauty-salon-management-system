<?php

$pageTitle = "My Appointments | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">





<!-- HEADER -->

<div class="dashboard-header">


<div>


<span class="dashboard-small">

MY APPOINTMENTS

</span>



<h1>

Upcoming Appointments

</h1>



<p>

Manage your upcoming salon appointments.

</p>



</div>






<a href="index.php?page=customer-dashboard"

class="dashboard-logout">

 Back Dashboard

</a>




</div>









<!-- SEARCH AREA -->


<div class="feature-section">


<div class="feature-card">


<h3>

Search Appointment

</h3>



<div class="search-wrapper">

<span class="search-icon">
🔍
</span>


<input 

type="text"

id="appointmentSearch"

data-search="appointments"

placeholder="Search appointments..."

class="search-input">


</div>

</div>


</div>









<!-- APPOINTMENT LIST -->


<div class="feature-section">


<div class="feature-grid"

id="appointmentResults">





<?php if(!empty($appointments)): ?>



<?php foreach($appointments as $appointment): ?>





<div class="feature-card">





<h3>

<?= htmlspecialchars($appointment['service_name']); ?>

</h3>






<p>

<strong>
Appointment ID:
</strong>

#<?= htmlspecialchars($appointment['id']); ?>

</p>






<p>

<strong>
Date:
</strong>

<?= htmlspecialchars($appointment['appointment_date']); ?>

</p>






<p>

<strong>
Time:
</strong>

<?= htmlspecialchars($appointment['appointment_time']); ?>

</p>






<p>

<strong>
Status:
</strong>

<?= htmlspecialchars($appointment['status']); ?>

</p>






<p>

<strong>
Payment:
</strong>

<?= htmlspecialchars($appointment['payment_status']); ?>

</p>





<!-- Future buttons -->



<button

class="feature-btn cancel-appointment"

data-id="<?= htmlspecialchars($appointment['id']); ?>"

>

Cancel

</button>


<button

class="feature-btn reschedule-appointment"

data-id="<?= htmlspecialchars($appointment['id']); ?>"

>

Reschedule

</button>





</div>





<?php endforeach; ?>



<?php else: ?>





<div class="feature-card">


<h3>

No Upcoming Appointment

</h3>


<p>

You don't have any upcoming appointments.

</p>



</div>





<?php endif; ?>





</div>


</div>








</div>

<!-- RESCHEDULE MODAL -->

<div id="rescheduleModal" class="reschedule-modal">


<div class="reschedule-box">


<h2>
Reschedule Appointment
</h2>


<input 
type="hidden"
id="rescheduleAppointmentId"
>


<label>
New Appointment Date
</label>


<input 
type="date"
id="newAppointmentDate"
>


<label>
New Appointment Time
</label>


<input 
type="time"
id="newAppointmentTime"
>



<div class="modal-buttons">


<button 
id="saveReschedule"
class="feature-btn">

Save Changes

</button>



<button 
id="closeReschedule"
class="feature-btn">

Cancel

</button>


</div>


</div>


</div>











<?php

require __DIR__ . '/../partials/footer.php';

?>