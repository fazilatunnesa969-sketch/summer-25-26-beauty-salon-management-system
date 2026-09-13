<?php

$pageTitle = "Sign Up | LA MIRROR";


require __DIR__ . '/partials/header.php';

?>



<section class="employee-register">



    <!-- LEFT IMAGE -->

    <div class="register-photo">


        <div class="register-photo-content">


            <span>
                JOIN OUR TEAM
            </span>


            <h1>
                Grow with
                LA MIRROR.
            </h1>


            <p>
                Build your career with our
                professional beauty team.
            </p>


        </div>


    </div>





    <!-- RIGHT FORM -->


    <div class="register-form-panel">



        <div class="register-heading">


            <span>
                EMPLOYEE REGISTRATION
            </span>


            <h2>
                Create Account
            </h2>


            <p>
                Enter your information below.
            </p>


        </div>





        <?php if (!empty($errors)): ?>


            <div class="register-error">


                <?php foreach ($errors as $error): ?>


                    <p>
                        <?= htmlspecialchars($error) ?>
                    </p>


                <?php endforeach; ?>


            </div>


        <?php endif; ?>






        <?php if (!empty($success)): ?>


            <div class="register-success">


                Account created successfully.


                <a href="index.php?page=login">

                    Login now

                </a>


            </div>


        <?php endif; ?>







        <form

            method="POST"

            action="index.php?page=signup"

            class="register-form"

        >





            <!-- FULL NAME -->


            <div class="register-field">


                <label>

                    Full Name

                </label>


                <input

                    type="text"

                    name="full_name"

                    placeholder="Enter your full name"

                    value="<?= htmlspecialchars($fullName ?? '') ?>"

                    required

                >


            </div>






            <!-- EMAIL -->


            <div class="register-field">


                <label>

                    Email

                </label>


                <input

                    type="email"

                    name="email"

                    placeholder="Enter your email"

                    value="<?= htmlspecialchars($email ?? '') ?>"

                    required

                >


            </div>







            <!-- USERNAME -->


            <div class="register-field">


                <label>

                    Username

                </label>


                <input

                    type="text"

                    name="username"

                    placeholder="Create username"

                    value="<?= htmlspecialchars($username ?? '') ?>"

                    minlength="4"

                    required

                >


            </div>







            <!-- PASSWORD -->


            <div class="register-field">


                <label>

                    Password

                </label>



                <div class="register-password">


                    <input

                        type="password"

                        id="password"

                        name="password"

                        placeholder="Minimum 8 characters"

                        minlength="8"

                        required

                    >



                    <button

                        type="button"

                        class="show-password"

                        data-target="password"

                    >

                        Show

                    </button>


                </div>


            </div>








            <!-- CONFIRM PASSWORD -->


            <div class="register-field">


                <label>

                    Confirm Password

                </label>




                <div class="register-password">


                    <input

                        type="password"

                        id="confirm_password"

                        name="confirm_password"

                        placeholder="Enter password again"

                        minlength="8"

                        required

                    >




                    <button

                        type="button"

                        class="show-password"

                        data-target="confirm_password"

                    >

                        Show

                    </button>



                </div>


            </div>








            <!-- ROLE -->


            <div class="register-field role-field">


                <label>

                    Select Role

                </label>




                <div class="register-roles">





                    <label class="register-role">


                        <input

                            type="radio"

                            name="role"

                            value="receptionist"

                            <?= (($role ?? '') === 'receptionist')
                                ? 'checked'
                                : '' ?>

                            required

                        >


                        <span>

                            Receptionist

                        </span>


                    </label>







                    <label class="register-role">


                        <input

                            type="radio"

                            name="role"

                            value="beautician"

                            <?= (($role ?? '') === 'beautician')
                                ? 'checked'
                                : '' ?>

                        >


                        <span>

                            Beautician

                        </span>


                    </label>




                </div>



            </div>









            <!-- MANAGER PERMISSION CODE -->


            <div class="register-field">


                <label>

                    Manager Permission Code

                </label>



                <div class="register-password">


                    <input

                        type="password"

                        id="permission_code"

                        name="permission_code"

                        placeholder="Enter manager permission code"

                        required

                    >



                    <button

                        type="button"

                        class="show-password"

                        data-target="permission_code"

                    >

                        Show

                    </button>



                </div>



                <small>

                    Required for authorized employee registration.

                </small>


            </div>







            <!-- SUBMIT -->


            <button

                type="submit"

                class="register-button"

            >

                Create Account

            </button>





        </form>







        <p class="register-login">


            Already have an account?


            <a href="index.php?page=login">

                Login

            </a>


        </p>





    </div>



</section>






<?php

require __DIR__ . '/partials/footer.php';

?>