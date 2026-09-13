<?php

$pageTitle = "Login | LA MIRROR";


require __DIR__ . '/partials/header.php';

?>



<section class="login-page">



    <div class="login-image">


        <div class="login-image-content">


            <span>

                WELCOME BACK

            </span>



            <h1>

                Welcome to
                LA MIRROR.

            </h1>



            <p>

                Sign in to access your
                salon workspace.

            </p>


        </div>


    </div>






    <div class="login-panel">


        <div class="login-box">





            <div class="login-heading">


                <span>

                    EMPLOYEE LOGIN

                </span>



                <h2>

                    Sign In

                </h2>



                <p>

                    Enter your account details.

                </p>


            </div>







            <?php if (!empty($loginError)): ?>


                <div class="login-error">


                    <?= htmlspecialchars($loginError) ?>


                </div>


            <?php endif; ?>








            <form

                method="POST"

                action="index.php?page=login"

                class="login-form"

            >







                <div class="login-field">


                    <label for="login">

                        Email or Username

                    </label>



                    <input

                        type="text"

                        id="login"

                        name="login"

                        placeholder="Enter email or username"


                        value="<?= htmlspecialchars(

                            $loginValue ?? ''

                        ) ?>"


                        required

                    >



                </div>









                <div class="login-field">


                    <label for="password">

                        Password

                    </label>





                    <div class="login-password">



                        <input

                            type="password"

                            id="password"

                            name="password"

                            placeholder="Enter your password"

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









                <!-- REMEMBER ME -->


                <div class="remember-field">


                    <label>


                        <input

                            type="checkbox"

                            name="remember_me"

                            value="1"

                        >



                        Remember Me


                    </label>


                </div>









                <button

                    type="submit"

                    class="login-button"

                >

                    Sign In


                </button>





            </form>









            <p class="signup-link">


                Don't have an account?


                <a href="index.php?page=signup">


                    Sign Up


                </a>


            </p>







        </div>



    </div>




</section>







<?php

require __DIR__ . '/partials/footer.php';

?>