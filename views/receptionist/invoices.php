<?php

$pageTitle = "Invoices | LA MIRROR";

require __DIR__ . '/../partials/header.php';

?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>

<span class="dashboard-small">

RECEPTIONIST PANEL

</span>


<h1>

Invoice Management

</h1>


<p>

Create and manage customer payments.

</p>


</div>



<a href="index.php?page=dashboard"

class="dashboard-logout">

Back Dashboard

</a>


</div>








<!-- ADD INVOICE BUTTON -->


<a href="index.php?page=add-invoice"

class="feature-btn">

+ Create Invoice

</a>









<!-- SEARCH -->


<div class="appointment-search">


<form method="GET"

action="index.php">


<input type="hidden"

name="page"

value="invoices">





<input

type="text"

name="search"

placeholder="Search customer invoice..."

>



<button

type="submit"

class="search-btn">

Search

</button>



</form>


</div>









<div class="feature-section">


<h2>

Invoice List

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

Amount

</th>


<th>

Payment Method

</th>


<th>

Status

</th>


<th>

Date

</th>


<th>

Action

</th>


</tr>


</thead>





<tbody>



<?php if(!empty($invoices)): ?>



<?php foreach($invoices as $invoice): ?>



<tr>



<td>

<?= $invoice['id']; ?>

</td>





<td>

<?= htmlspecialchars(

$invoice['customer_name'] ?? 'N/A'

); ?>

</td>





<td>

৳ <?= $invoice['amount']; ?>

</td>





<td>

<?= htmlspecialchars(

$invoice['payment_method'] ?? 'N/A'

); ?>

</td>





<td>

<?= ucfirst(

$invoice['payment_status']

); ?>

</td>





<td>

<?= $invoice['created_at']; ?>

</td>





<td>



<a href="index.php?page=update-payment&id=<?= $invoice['id']; ?>&status=paid"

class="feature-btn">

Paid

</a>





<a href="index.php?page=delete-invoice&id=<?= $invoice['id']; ?>"

class="delete-btn"

onclick="return confirm('Delete invoice?')">

Delete

</a>



</td>


</tr>



<?php endforeach; ?>



<?php else: ?>


<tr>

<td colspan="7">

No invoice found.

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