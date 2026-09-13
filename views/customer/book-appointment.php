<?php

$pageTitle = "Book Appointment | LA MIRROR";

require __DIR__ . '/../partials/header.php';


?>


<div class="booking-wrapper">


<!-- LEFT FORM -->

<div class="booking-card">


<div class="booking-header">

<span class="dashboard-small">
BOOK APPOINTMENT
</span>


<h1>
Reserve Your Beauty Session
</h1>


<p>
Choose your service and preferred time.
</p>


</div>





<form method="POST"
action="index.php?page=save-appointment"
class="register-form">





<!-- FULL NAME -->

<div class="register-field">

<label>
Full Name
</label>


<input 
type="text"
name="full_name"

value="<?= htmlspecialchars($customer['full_name'] ?? ''); ?>"

<?= isset($customer['full_name']) ? 'readonly' : ''; ?>

placeholder="Enter your full name"

required>

</div>







<!-- EMAIL -->

<div class="register-field">

<label>
Email
</label>


<input 
type="email"
name="email"

value="<?= htmlspecialchars($customer['email'] ?? ''); ?>"

<?= isset($customer['email']) ? 'readonly' : ''; ?>

placeholder="Enter your email"

required>

</div>







<!-- PASSWORD + PHONE ROW -->


<div class="booking-row">



<?php if(!isset($customer['id'])): ?>


<div class="register-field">

<label>
Password
</label>


<div class="register-password">


<input 

type="password"

id="booking_password"

name="password"

placeholder="Create password"

minlength="6"

required>


<button

type="button"

class="show-password"

data-target="booking_password">

Show

</button>


</div>


</div>


<?php endif; ?>







<!-- PHONE -->


<div class="register-field">


<label>
Phone
</label>



<input 

type="tel"

name="phone"

value="<?= htmlspecialchars($customer['phone'] ?? ''); ?>"

<?= isset($customer['phone']) ? 'readonly' : ''; ?>


placeholder="Enter phone number"

required>


</div>


</div>









<!-- SERVICE -->

<div class="register-field">

<label>
Select Service
</label>



<select name="service_id" required>


<option value="">
Choose Service
</option>



<?php foreach($services as $service): ?>


<option value="<?= $service['id']; ?>">


<?= htmlspecialchars($service['service_name']); ?>

-

৳<?= htmlspecialchars($service['price']); ?>


(
<?= htmlspecialchars($service['duration']); ?>

)


</option>



<?php endforeach; ?>


</select>


</div>









<!-- DATE + TIME ROW -->


<div class="booking-row">



<!-- DATE -->


<div class="register-field">


<label>
Appointment Date
</label>


<input 

type="date"

name="appointment_date"

required>


</div>







<!-- TIME -->


<div class="register-field">


<label>
Appointment Time
</label>


<input 

type="time"

name="appointment_time"

required>


</div>


</div>









<!-- SAFETY NOTE -->


<div class="register-field">


<label>
Safety Information (Optional)
</label>



<textarea 

name="safety_note"

placeholder="Any allergy or skin sensitivity information"

rows="4"></textarea>


</div>









<button 

type="submit"

class="primary-btn">


Continue Payment


</button>





</form>


</div>









<!-- RIGHT IMAGE -->


<div class="booking-image-panel">


<div class="image-overlay">


<h2>
LA MIRROR
</h2>


<p>
Beauty • Care • Elegance
</p>


<span>
Experience premium beauty service
with professional care.
</span>


</div>





<img 

src="assets/images/salon-booking.jpg"

alt="LA MIRROR Beauty Salon">


</div>






</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>