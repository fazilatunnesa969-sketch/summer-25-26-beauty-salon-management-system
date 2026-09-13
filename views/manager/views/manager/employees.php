<?php

$pageTitle = "Employees | LA MIRROR";


require __DIR__ . '/../partials/header.php';


?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>

<span class="dashboard-small">

EMPLOYEE MANAGEMENT

</span>


<h1>

Manage Employees

</h1>


<p>

Create, update and manage salon staff.

</p>



</div>




<div>





<a href="index.php?page=add-employee"

class="dashboard-logout">

+ Add Employee

</a>
<a href="index.php?page=manager-dashboard"

class="dashboard-logout">

Back Dashboard

</a>



</div>

</div>






<!-- SEARCH -->


<div class="employee-search">


<input

type="text"

id="employeeSearch"

placeholder="Search employee..."


autocomplete="off"


>


<div id="searchResult"></div>


</div>





<div id="employeeTable">

<div class="manager-table-box">



<table>



<thead>


<tr>


<th>ID</th>


<th>Name</th>


<th>Email</th>


<th>Username</th>


<th>Role</th>


<th>Status</th>


<th>Action</th>



</tr>


</thead>





<tbody>


<?php if(!empty($employees)): ?>



<?php foreach($employees as $employee): ?>



<tr>


<td>

<?= $employee['id']; ?>

</td>



<td>

<?= htmlspecialchars(
$employee['full_name']
); ?>

</td>




<td>

<?= htmlspecialchars(
$employee['email']
); ?>

</td>




<td>

<?= htmlspecialchars(
$employee['username']
); ?>

</td>




<td>

<?= ucfirst(
$employee['role']
); ?>

</td>




<td>

<?= ucfirst(
$employee['status']
); ?>

</td>




<td>


<a href="index.php?page=edit-employee&id=<?= $employee['id']; ?>">

Edit

</a>



<a href="index.php?page=delete-employee&id=<?= $employee['id']; ?>"
onclick="return confirm('Delete this employee?');">

Delete

</a>


</td>



</tr>




<?php endforeach; ?>



<?php else: ?>


<tr>


<td colspan="7">

No employee found.

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