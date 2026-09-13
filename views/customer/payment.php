<?php

$pageTitle = "Payment | LA MIRROR";


require __DIR__ . '/../partials/header.php';


?>


<div class="booking-wrapper">



<!-- PAYMENT FORM -->

<div class="booking-card">


<div class="booking-header">


<span class="dashboard-small">

PAYMENT

</span>


<h1>

Complete Your Payment

</h1>


<p>

Confirm your appointment by completing prepaid payment.

</p>


</div>






<div class="payment-summary">


<h3>
Appointment Summary
</h3>



<p>

<strong>
Service:
</strong>

<?= htmlspecialchars(
$_SESSION['service_name'] ?? 'Service'
); ?>


</p>





<p>

<strong>
Duration:
</strong>

<?= htmlspecialchars(
$_SESSION['service_duration'] ?? ''
); ?>


</p>






<p>

<strong>
Amount:
</strong>


৳<?= htmlspecialchars(
$_SESSION['service_price'] ?? 0
); ?>


</p>



</div>







<form method="POST"
action="index.php?page=save-payment"
class="register-form">





<label>

Payment Amount

</label>


<input

type="number"

name="amount"

value="<?= $_SESSION['service_price'] ?? 0; ?>"

readonly

required

>







<label>

Payment Method

</label>


<select name="payment_method"
required>


<option value="">

Select Method

</option>


<option value="bkash">

bKash

</option>


<option value="nagad">

Nagad

</option>


<option value="card">

Card

</option>


<option value="cash">

Cash

</option>


</select>







<label>

Transaction ID

</label>


<input

type="text"

name="transaction_id"

placeholder="Enter transaction ID"

required

>







<button type="submit"

class="primary-btn">


Confirm Payment


</button>





</form>



</div>









<!-- RIGHT SIDE -->

<div class="booking-image-panel">


<div class="image-overlay">


<h2>

LA MIRROR

</h2>


<p>

Beauty • Care • Elegance

</p>



<span>

Your beauty journey starts here.

</span>



</div>



<img

src="assets/images/salon-booking.jpg"

alt="LA MIRROR"


>


</div>






</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>