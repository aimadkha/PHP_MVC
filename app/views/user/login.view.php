
<div class="container" style="height: 82.7vh;">
    <div class="form-group w-50 m-auto">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="text-center">
                <h3>User Login</h3>
            </div>
            <?php if (isset($_SESSION['msg'])) { ?>
            <p><?= $_SESSION['msg'] ?></p>
            <?php
            unset($_SESSION['msg']);
            } ?>
            <!-- Login Form -->
            <form method="post">
                <label>User Name</label>
                <input type="text" id="login" class="form-control" name="name" placeholder="login"><br>
                <label>Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="password"><br>
                <input type="submit" name="login" class="btn btn-primary btn-block" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <p>Dont't have an account ? <a class="" href="/user/register">Register Now.</a> </p>
                <a class="" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
</div>
