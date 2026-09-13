


<?php


$pageTitle = "Dashboard | LA MIRROR";

require __DIR__ . '/../partials/header.php';


$role = $_SESSION['role'] ?? '';

$name = $_SESSION['full_name'] ?? 'User';

?>


<div class="dashboard-wrapper">


    <div class="dashboard-header">


        <div>

            <span class="dashboard-small">

                WELCOME BACK

            </span>


            <h1>

                Hello,
                <?= htmlspecialchars($name); ?>

            </h1>


            <p>

                Manage your salon operations easily.

            </p>


        </div>



        <a href="index.php?page=logout"
           class="dashboard-logout">

            Logout

        </a>


    </div>





    <div class="dashboard-cards">


        <div class="dash-card">

            <span>
                Role
            </span>

            <h2>
                <?= ucfirst($role); ?>
            </h2>

        </div>




        <div class="dash-card">

            <span>
                Status
            </span>

            <h2>
                Active
            </h2>

        </div>




        <div class="dash-card">

            <span>
                Salon
            </span>

            <h2>
                LA MIRROR
            </h2>

        </div>


    </div>









<!-- =========================
     MANAGER DASHBOARD
========================= -->


<?php if($role == 'manager'): ?>


<div class="feature-section">


<h2>

Manager Features

</h2>






<div class="feature-grid">


<div class="feature-card">


<h3>

Revenue Analytics

</h3>


<p>

Analyze salon income and future prediction.

</p>



<a href="index.php?page=revenue-report"
class="feature-btn">

View Report

</a>


</div>







<div class="feature-card">


<h3>

Employee Ranking

</h3>


<p>

Find best performing employees.

</p>



<a href="index.php?page=employee-ranking"
class="feature-btn">

View Ranking

</a>


</div>
<!-- EMPLOYEE MANAGEMENT -->


<div class="feature-card">


<h3>

Employee Management

</h3>


<p>

Add, edit and manage salon employees.

</p>



<a href="index.php?page=manager-employees"
class="feature-btn">

Manage Employees

</a>


</div>







<div class="feature-card">


<h3>

Peak Hour Analysis

</h3>


<p>

Analyze busy booking time.

</p>



<a href="index.php?page=peak-hour-analysis"
class="feature-btn">

Analyze

</a>


</div>





</div>


</div>

</div>


<?php endif; ?>









<!-- =========================
     BEAUTICIAN DASHBOARD
========================= -->


<?php if($role == 'beautician'): ?>

    


<div class="feature-section">


<h2>
Beautician Features
</h2>
<?php if(!empty($beauticianNotices)): ?>


<!-- NOTICE POPUP -->

<div id="noticePopup" class="notice-overlay">


<div class="notice-modal">


<button 
class="notice-close"
onclick="closeNoticePopup()">

×

</button>



<div class="notice-header">

<h2>
🔔 New Notice
</h2>


<p>
You have received new notice(s)
</p>


</div>




<?php foreach($beauticianNotices as $notice): ?>


<div class="notice-card">


<h3>

<?= htmlspecialchars($notice['title']); ?>

</h3>



<p>

<?= htmlspecialchars($notice['message']); ?>

</p>



<span>

From: Receptionist

</span>


</div>



<?php endforeach; ?>





<button

class="notice-btn"

onclick="closeNoticePopup()">

Got it ✓

</button>



</div>


</div>


<?php endif; ?>
<div class="feature-grid">



<div class="feature-card">


<h3>
Service Timer
</h3>


<p>
Track service duration and improve work efficiency.
</p>


<a href="index.php?page=service-timer"
class="feature-btn">

Open Timer

</a>


</div>





<div class="feature-card">


<h3>
Safety Alert
</h3>


<p>
Check customer allergy and safety information.
</p>


<a href="index.php?page=safety-alert"

class="feature-btn">

Open Alert

</a>


</div>





<div class="feature-card">


<h3>
Follow Up
</h3>


<p>
Manage future customer service reminders.
</p>


<a href="index.php?page=follow-up"

class="feature-btn">

Open Follow Up

</a>


</div>



</div>


</div>



<?php endif; ?>



<!-- =========================
     CUSTOMER DASHBOARD
========================= -->


<?php if($role == 'customer'): ?>


<div class="feature-section">


<h2>

Customer Features

</h2>



<div class="feature-grid">



<div class="feature-card">


<h3>

My Appointment

</h3>


<p>

View your upcoming appointments and service status.

</p>



<a href="index.php?page=my-appointments"

class="feature-btn">

View Appointment

</a>


</div>

<div class="feature-card">


<h3>
Next Recommended Visit
</h3>


<?php if(!empty($nextVisit)): ?>


<p>

<strong>
Service:
</strong>

<?= htmlspecialchars($nextVisit['service_name']); ?>

</p>



<p>

<strong>
Next Visit:
</strong>

<?= htmlspecialchars($nextVisit['follow_up_date']); ?>

</p>



<p>

<?= htmlspecialchars($nextVisit['note']); ?>

</p>


<?php else: ?>


<p>
Your beautician will recommend your next treatment date here.
</p>


<p>

<strong>
Next Visit:
</strong>

Coming Soon

</p>


<?php endif; ?>


</div>















<div class="feature-card">


<h3>

My Profile

</h3>


<p>

Manage your personal information.

</p>



<a href="index.php?page=profile"

class="feature-btn">

Profile

</a>


</div>




</div>


</div>


<?php endif; ?>




<!-- =========================
     RECEPTIONIST DASHBOARD
========================= -->


<?php if($role == 'receptionist'): ?>


<div class="feature-section">


<h2>

Receptionist Features

</h2>



<div class="feature-grid">




<div class="feature-card">

<h3>
Appointment Queue
</h3>


<p>
Create, update and manage customer appointments.
</p>



<a href="index.php?page=appointment-queue"
class="feature-btn">

Open Queue

</a>


</div>




<div class="feature-card">

<h3>
Invoice Management
</h3>


<p>
Create invoice and manage customer payments.
</p>


<a href="index.php?page=invoices"

class="feature-btn">

Open Invoice

</a>


</div>







<div class="feature-card">


<h3>

Schedule Notice

</h3>


<p>

Create and manage salon notices.

</p>



<a href="index.php?page=notices"

class="feature-btn">

Open Notice

</a>


</div>
</div>



</div>


</div>


<?php endif; ?>







</div>





<?php

require __DIR__ . '/../partials/footer.php';

?>