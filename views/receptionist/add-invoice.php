<?php

$pageTitle = "Create Invoice | LA MIRROR";

require __DIR__ . '/../partials/header.php';

?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>

<span class="dashboard-small">

RECEPTIONIST PANEL

</span>


<h1>

Create Invoice

</h1>


<p>

Generate customer payment invoice.

</p>


</div>



<a href="index.php?page=invoices"

class="dashboard-logout">

Back Invoice

</a>



</div>









<div class="feature-section">



<div class="feature-card">





<form method="POST"

action="index.php?page=add-invoice">







<div class="register-field">


<label>

Appointment ID

</label>


<input

type="number"

name="appointment_id"

placeholder="Enter appointment ID"

required

>


</div>








<div class="register-field">


<label>

Customer ID

</label>


<input

type="number"

name="customer_id"

placeholder="Enter customer ID"

required

>


</div>








<div class="register-field">


<label>

Amount

</label>


<input

type="number"

step="0.01"

name="amount"

placeholder="Enter invoice amount"

required

>


</div>








<div class="register-field">


<label>

Payment Method

</label>


<select

name="payment_method"

class="invoice-select"

required

>


<option value="">

Select Payment Method

</option>


<option value="Cash">

Cash

</option>


<option value="Card">

Card

</option>


<option value="Online">

Online

</option>


</select>


</div>








<button

type="submit"

class="feature-btn">

Save Invoice

</button>







</form>




</div>



</div>






</div>







<?php

require __DIR__ . '/../partials/footer.php';

?>