<?php

$pageTitle = "Add Employee | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>

<span class="dashboard-small">

EMPLOYEE MANAGEMENT

</span>


<h1>

Add New Employee

</h1>


<p>

Create a new salon staff account.

</p>


</div>



<a href="index.php?page=manager-employees"
class="dashboard-logout">

Back

</a>


</div>






<div class="form-card">



<form method="POST"
action="index.php?page=add-employee">





<div class="form-group">


<label>

Full Name

</label>


<input

type="text"

name="full_name"

placeholder="Enter full name"

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

placeholder="Enter email"

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

placeholder="Create username"

required

>


</div>







<div class="form-group">


<label>

Password

</label>


<input

type="password"

name="password"

placeholder="Create password"

required

>


</div>







<div class="form-group">


<label>

Select Role

</label>



<select name="role" required>


<option value="">

Select Role

</option>


<option value="receptionist">

Receptionist

</option>



<option value="beautician">

Beautician

</option>



</select>


</div>








<button class="submit-btn">

Create Employee

</button>





</form>



</div>





</div>






<?php

require __DIR__ . '/../partials/footer.php';

?>