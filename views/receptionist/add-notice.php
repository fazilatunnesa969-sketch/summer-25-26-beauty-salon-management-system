<?php

$pageTitle = "Create Notice | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>



<div class="dashboard-wrapper">



<div class="dashboard-header">



<div>


<span class="dashboard-small">

RECEPTIONIST PANEL

</span>



<h1>

Create Schedule Notice

</h1>



<p>

Add important salon announcements.

</p>



</div>





<a href="index.php?page=notices"

class="dashboard-logout">

Back Notice

</a>



</div>









<div class="feature-section">



<div class="feature-card">





<form method="POST"

action="index.php?page=add-notice">







<div class="register-field">


<label>

Notice Title

</label>



<input

type="text"

name="title"

placeholder="Enter notice title"

required

>


</div>








<div class="register-field">


<label>

Notice Message

</label>



<textarea

name="message"

placeholder="Write notice details"

rows="5"

required

></textarea>


</div>







<!-- SEND TO -->

<div class="register-field">


<label>

Send To

</label>



<select name="receiver_role" required>


<option value="beautician">

Beautician

</option>



<option value="manager">

Manager

</option>



<option value="receptionist">

Receptionist

</option>



</select>


</div>








<button

type="submit"

class="feature-btn">

Save Notice

</button>







</form>





</div>



</div>






</div>






<?php

require __DIR__ . '/../partials/footer.php';

?>