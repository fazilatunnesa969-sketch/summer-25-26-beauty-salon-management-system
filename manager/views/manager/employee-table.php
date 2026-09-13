<div class="manager-table-box">


<table>


<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

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
<?= htmlspecialchars($employee['full_name']); ?>
</td>


<td>
<?= htmlspecialchars($employee['email']); ?>
</td>


<td>


<a href="index.php?page=edit-employee&id=<?= $employee['id']; ?>">

Edit

</a>


</td>


</tr>


<?php endforeach; ?>


<?php else: ?>


<tr>

<td colspan="4">

No employee found.

</td>

</tr>


<?php endif; ?>


</tbody>


</table>


</div>