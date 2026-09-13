/*
==================================
SIGNUP FORM VALIDATION
==================================
*/




document.addEventListener(
    "DOMContentLoaded",
    function(){
    
    
    const signupForm =
    document.querySelector(".register-form");
    
    
    
    if(signupForm)
    {
    
    
    signupForm.addEventListener(
    "submit",
    function(e){
    
    
    
    const password =
    document.querySelector(
    'input[name="password"]'
    );
    
    
    
    if(password && password.value.length < 8)
    {
    
    
    alert(
    "Password must be minimum 8 characters."
    );
    
    
    e.preventDefault();
    
    
    return;
    
    
    }
    
    
    
    }
    
    );
    
    
    }
    
    
    });

  /*
==================================
SHOW / HIDE PASSWORD
==================================
*/

document.addEventListener("DOMContentLoaded", function(){

    const buttons = document.querySelectorAll(".show-password");


    buttons.forEach(function(button){


        button.addEventListener("click", function(){


            const target = this.getAttribute("data-target");

            const input = document.getElementById(target);


            if(input)
            {

                if(input.type === "password")
                {
                    input.type = "text";
                    this.innerText = "Hide";
                }
                else
                {
                    input.type = "password";
                    this.innerText = "Show";
                }

            }


        });


    });


});
    /*
==================================
EMPLOYEE LIVE TABLE SEARCH AJAX
==================================
*/


document.addEventListener(
    "DOMContentLoaded",
    function(){
    
    
    
    const searchInput =
    
    document.getElementById(
    "employeeSearch"
    );
    
    
    
    
    const tableBox =
    
    document.getElementById(
    "employeeTable"
    );
    
    
    
    
    
    if(
    searchInput &&
    tableBox
    )
    {
    
    
    
    searchInput.addEventListener(
    "keyup",
    function(){
    
    
    
    let keyword =
    this.value.trim();
    
    
    
    
    
    fetch(
    
    "index.php?page=search-employee&keyword="
    +
    keyword
    
    )
    
    
    
    
    
    .then(
    response =>
    response.text()
    )
    
    
    
    
    
    .then(
    data =>
    {
    
    
    tableBox.innerHTML = data;
    
    
    }
    
    );
    
    
    
    }
    
    );
    
    
    
    }
    
    
    
    });
    
/*
==================================
APPOINTMENT AJAX SEARCH
==================================
*/


document.addEventListener(
    "DOMContentLoaded",
    function(){
    
    
    const searchBox =
    document.getElementById(
    "appointmentSearch"
    );
    
    
    
    if(searchBox)
    {
    
    
    searchBox.addEventListener(
    "keyup",
    function(){
    
    
    let keyword =
    this.value.trim();
    
    
    
    fetch(
    "index.php?page=search-appointments&keyword="
    +
    keyword
    )
    
    
    
    .then(
    response =>
    response.json()
    )
    
    
    
    .then(
    data =>
    {
    
    
    const container =
    document.getElementById(
    "appointmentResults"
    );
    
    
    
    if(!container)
    {
    return;
    }
    
    
    
    
    container.innerHTML = "";
    
    
    
    
    
    if(data.length === 0)
    {
    
    
    container.innerHTML = `
    
    <div class="feature-card">
    
    <h3>
    No Appointment Found
    </h3>
    
    <p>
    No matching appointment available.
    </p>
    
    </div>
    
    `;
    
    
    return;
    
    }
    
    
    
    
    
    data.forEach(
    function(appointment)
    {
    
    
    container.innerHTML += `
    
    
    <div class="feature-card">
    
    
    <h3>
    ${appointment.service_name}
    </h3>
    
    
    
    <p>
    <strong>
    Appointment ID:
    </strong>
    
    #${appointment.id}
    
    </p>
    
    
    
    <p>
    <strong>
    Date:
    </strong>
    
    ${appointment.appointment_date}
    
    </p>
    
    
    
    <p>
    <strong>
    Time:
    </strong>
    
    ${appointment.appointment_time}
    
    </p>
    
    
    
    <p>
    <strong>
    Status:
    </strong>
    
    ${appointment.status}
    
    </p>
    
    
    
    <p>
    <strong>
    Payment:
    </strong>
    
    ${appointment.payment_status}
    
    </p>
    
    
    
    <button
    
    class="feature-btn cancel-appointment"
    
    data-id="${appointment.id}"
    
    >
    
    Cancel
    
    </button>
    
    
    
    <button
    
    class="feature-btn reschedule-appointment"
    
    data-id="${appointment.id}"
    
    >
    
    Reschedule
    
    </button>
    
    
    
    </div>
    
    
    `;
    
    
    });
    
    
    });
    
    
    });
    
    
    }
    
    
    });
    /*
==================================
CANCEL APPOINTMENT AJAX
==================================
*/


document.addEventListener(
    "click",
    function(e){
    
    
    
    if(
    e.target.classList.contains(
    "cancel-appointment"
    )
    
    )
    
    {
    
    
    
    let appointmentId =
    
    e.target.getAttribute(
    "data-id"
    );
    
    
    
    
    
    if(!appointmentId)
    {
    
    alert(
    "Appointment ID missing"
    );
    
    return;
    
    }
    
    
    
    
    
    let confirmCancel =
    
    confirm(
    "Are you sure you want to cancel this appointment?"
    );
    
    
    
    
    
    if(!confirmCancel)
    {
    
    return;
    
    }
    
    
    
    
    
    let formData =
    
    new FormData();
    
    
    
    
    
    formData.append(
    "appointment_id",
    appointmentId
    );
    
    
    
    
    
    
    fetch(
    
    "index.php?page=cancel-appointment",
    
    {
    
    method:"POST",
    
    body:formData
    
    }
    
    )
    
    
    
    
    
    .then(
    response =>
    response.json()
    )
    
    
    
    
    
    .then(
    data =>
    {
    
    
    
    console.log(data);
    
    
    
    
    
    if(
    data.status === "success"
    )
    
    {
    
    
    alert(
    "Appointment cancelled successfully"
    );
    
    
    
    
    
    location.reload();
    
    
    
    }
    
    else
    
    {
    
    
    alert(
    "Unable to cancel appointment"
    );
    
    
    
    }
    
    
    
    }
    
    )
    
    
    
    
    
    .catch(
    error =>
    {
    
    
    console.log(
    error
    );
    
    
    alert(
    "Something went wrong"
    );
    
    
    }
    
    );
    
    
    
    }
    
    
    
    });


    /*
==================================
RESCHEDULE APPOINTMENT
==================================
*/


document.addEventListener(
    "click",
    function(e){
    
    
    if(
    e.target.classList.contains(
    "reschedule-appointment"
    )
    
    )
    
    {
    
    
    let id =
    
    e.target.getAttribute(
    "data-id"
    );
    
    
    
    document.getElementById(
    "rescheduleAppointmentId"
    ).value = id;
    
    
    
    document.getElementById(
    "rescheduleModal"
    ).style.display = "flex";
    
    
    }
    
    
    
    });
    
    
    
    
    
    /*
    SAVE RESCHEDULE
    */
    
    
    document.addEventListener(
    "click",
    function(e){
    
    
    if(
    e.target.id === "saveReschedule"
    )
    
    {
    
    
    let appointmentId =
    
    document.getElementById(
    "rescheduleAppointmentId"
    ).value;
    
    
    
    let date =
    
    document.getElementById(
    "newAppointmentDate"
    ).value;
    
    
    
    let time =
    
    document.getElementById(
    "newAppointmentTime"
    ).value;
    
    
    
    
    if(!date || !time)
    {
    
    alert(
    "Please select date and time"
    );
    
    return;
    
    }
    
    
    
    
    let formData = new FormData();
    
    
    formData.append(
    "appointment_id",
    appointmentId
    );
    
    
    formData.append(
    "appointment_date",
    date
    );
    
    
    formData.append(
    "appointment_time",
    time
    );
    
    
    
    
    
    fetch(
    "index.php?page=reschedule-appointment",
    {
    
    method:"POST",
    
    body:formData
    
    }
    
    )
    
    
    
    .then(
    response=>response.json()
    )
    
    
    .then(
    data=>{
    
    
    console.log(data);
    
    
    if(data.status==="success")
    {
    
    
    alert(
    "Appointment rescheduled successfully"
    );
    
    
    location.reload();
    
    
    }
    
    else
    {
    
    alert(
    "Unable to reschedule"
    );
    
    
    }
    
    
    }
    
    );
    
    
    
    }
    
    
    });
    
    
    
    
    
    
    /*
    CLOSE MODAL
    */
    
    
    document.addEventListener(
    "click",
    function(e){
    
    
    if(
    e.target.id==="closeReschedule"
    )
    
    {
    
    document.getElementById(
    "rescheduleModal"
    ).style.display="none";
    
    
    }
    
    
    });

   
    /*
==================================
RESCHEDULE MODAL OPEN
==================================
*/


document.addEventListener(
    "click",
    function(e){
    
    
    if(
    e.target.classList.contains(
    "reschedule-appointment"
    )
    
    )
    
    {
    
    
    let appointmentId =
    e.target.getAttribute(
    "data-id"
    );
    
    
    
    let modal =
    document.getElementById(
    "rescheduleModal"
    );
    
    
    
    let idInput =
    document.getElementById(
    "rescheduleAppointmentId"
    );
    
    
    
    if(modal && idInput)
    {
    
    
    idInput.value =
    appointmentId;
    
    
    
    modal.style.display =
    "flex";
    
    
    
    }
    
    
    
    }
    
    
    });
    
    
    
    
    
    
    
    /*
    ==================================
    CLOSE RESCHEDULE MODAL
    ==================================
    */
    
    
    document.addEventListener(
    "click",
    function(e){
    
    
    
    if(
    e.target.id === "closeReschedule"
    )
    
    {
    
    
    let modal =
    document.getElementById(
    "rescheduleModal"
    );
    
    
    
    if(modal)
    {
    
    
    modal.style.display =
    "none";
    
    
    }
    
    
    }
    
    
    });
    function closeNoticePopup()
    {
        const popup = document.getElementById("noticePopup");
    
        if(popup)
        {
            popup.style.display = "none";
        }
    }

    /*
==================================
RECEPTIONIST APPOINTMENT SEARCH AJAX
==================================
*/

document.addEventListener(
    "DOMContentLoaded",
    function(){
    
    
    const searchInput =
    document.getElementById(
    "appointmentQueueSearch"
    );
    
    
    
    const tableBody =
    document.getElementById(
    "appointmentTableBody"
    );
    
    
    
    if(searchInput && tableBody)
    {
    
    
    searchInput.addEventListener(
    "keyup",
    function(){
    
    
    let keyword =
    this.value.trim();
    
    
    
    fetch(
    "index.php?page=search-appointments-ajax&search="
    +
    keyword
    )
    
    
    
    .then(
    response =>
    response.json()
    )
    
    
    
    .then(
    data =>
    {
    
    
    tableBody.innerHTML = "";
    
    
    
    data.forEach(
    appointment =>
    {
    
    
    tableBody.innerHTML += `
    
    <tr>
    
    <td>${appointment.id}</td>
    
    <td>${appointment.customer_name ?? 'N/A'}</td>
    
    <td>${appointment.service_name ?? 'N/A'}</td>
    
    <td>${appointment.beautician_name ?? 'Not Assigned'}</td>
    
    <td>${appointment.appointment_date}</td>
    
    <td>${appointment.appointment_time}</td>
    
    <td>${appointment.status}</td>
    
    
    <td>
    
    <a class="feature-btn"
    href="index.php?page=update-appointment-status&id=${appointment.id}&status=confirmed">
    Confirm
    </a>
    
    
    <a class="feature-btn"
    href="index.php?page=update-appointment-status&id=${appointment.id}&status=completed">
    Complete
    </a>
    
    
    <a class="delete-btn"
    href="index.php?page=delete-appointment&id=${appointment.id}">
    Delete
    </a>
    
    </td>
    
    
    </tr>
    
    
    `;
    
    
    });
    
    
    }
    
    
    );
    
    
    
    });
    
    
    }
    
    
    });
   
function setBeautician(id, value)
{

    let input = document.querySelector(
        '.beautician-hidden-' + id
    );


    if(input)
    {
        input.value = value;
    }

}

