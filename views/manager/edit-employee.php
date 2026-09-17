<?php

$pageTitle = "Edit Employee | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>


<span class="dashboard-small">

EMPLOYEE MANAGEMENT

</span>



<h1>

Edit Employee

</h1>



<p>

Update staff information.

</p>


</div>




<a href="index.php?page=manager-employees"
class="dashboard-logout">

Back

</a>



</div>








<div class="form-card">





<form method="POST"
action="index.php?page=update-employee">





<input

type="hidden"

name="id"

value="<?= $employee['id']; ?>"

>







<div class="form-group">


<label>

Full Name

</label>



<input

type="text"

name="full_name"

value="<?= htmlspecialchars(
$employee['full_name']
); ?>"

required

>


</div>









<div class="form-group">


<label>

Email

</label>



<input

type="email"

name="email"

value="<?= htmlspecialchars(
$employee['email']
); ?>"

required

>


</div>









<div class="form-group">


<label>

Username

</label>



<input

type="text"

name="username"

value="<?= htmlspecialchars(
$employee['username']
); ?>"

required

>


</div>









<div class="form-group">


<label>

Role

</label>



<select name="role">



<option value="receptionist"

<?= ($employee['role']=="receptionist")
?'selected':'';
?>

>

Receptionist

</option>





<option value="beautician"

<?= ($employee['role']=="beautician")
?'selected':'';
?>

>

Beautician

</option>



</select>


</div>









<div class="form-group">


<label>

Status

</label>



<select name="status">


<option value="active"

<?= ($employee['status']=="active")
?'selected':'';
?>

>

Active

</option>




<option value="inactive"

<?= ($employee['status']=="inactive")
?'selected':'';
?>

>

Inactive

</option>



</select>


</div>







<button class="submit-btn">

Update Employee

</button>





</form>





</div>




</div>






<?php

require __DIR__ . '/../partials/footer.php';

?>