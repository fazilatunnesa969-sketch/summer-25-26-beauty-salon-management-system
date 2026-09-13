<?php

$pageTitle = "Schedule Notice | LA MIRROR";


require __DIR__ . '/../partials/header.php';

?>


<div class="dashboard-wrapper">



<div class="dashboard-header">


<div>


<span class="dashboard-small">

RECEPTIONIST PANEL

</span>



<h1>

Schedule Notice

</h1>



<p>

Manage salon updates and announcements.

</p>


</div>





<a href="index.php?page=dashboard"

class="dashboard-logout">

Back Dashboard

</a>



</div>









<a href="index.php?page=add-notice"

class="feature-btn">

+ Create Notice

</a>









<div class="feature-section">


<h2>

Notice List

</h2>





<div class="table-container">



<table class="employee-table">


<thead>


<tr>


<th>
ID
</th>



<th>
Title
</th>



<th>
Message
</th>



<th>
Send To
</th>



<th>
Created By
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



<?php if(!empty($notices)): ?>



<?php foreach($notices as $notice): ?>



<tr>



<td>

<?= htmlspecialchars($notice['id']); ?>

</td>





<td>

<?= htmlspecialchars(
$notice['title']
); ?>

</td>





<td>

<?= htmlspecialchars(
$notice['message']
); ?>

</td>





<td>

<?= htmlspecialchars(
$notice['receiver_role'] ?? 'All'
); ?>

</td>





<td>

<?= htmlspecialchars(
$notice['creator_name'] ?? 'Admin'
); ?>

</td>





<td>

<?= htmlspecialchars(
$notice['created_at']
); ?>

</td>





<td>



<a href="index.php?page=delete-notice&id=<?= $notice['id']; ?>"

class="delete-btn"

onclick="return confirm('Delete notice?')">

Delete

</a>



</td>



</tr>



<?php endforeach; ?>



<?php else: ?>


<tr>

<td colspan="7">

No notice found.

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