<div class="d-flex">
    <nav class="main_navigation bg-dark w-25 d-flex flex-column justify-content-center align-items-center">

        <div class="employee_info text-white m-3">
            <div class="profile_picture">
                <i class="fas fa-user-alt fa-6x"></i>
                <!--            <img src="" alt="User profile picture">-->
            </div>
            <span class="name ">aimad</span>
            <span class="privilege">admin</span>
        </div>
        <ul class="app_navigation">
            <li class="m-3"><a class="text-white " href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistique</a></li>
            <li class="m-3"><a class="text-white " href="/reservation"><i class="fas fa-shopping-cart"></i> Reservation</a></li>
            <li class="m-3"><a class="text-white " href="user"><i class="fa fa-user text-white"></i> Customer</a></li>
            <li class="m-3"><a class="text-white " href="product"><i class="fas fa-car"></i> Offer</a></li>
            <li class="m-3"><a class="text-white " href="/user/logout"
                               onclick="if (!confirm('Do you want to log out?')) return false;"><i
                            class="fas fa-sign-out-alt"></i> Sign out</a></li>
        </ul>

    </nav>
    <div class="container">
        <form method="post" enctype="application/x-www-form-urlencoded">
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" name="first_name" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" value="<?= $user->user_first_name ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" value="<?= $user->user_last_name ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       value="<?= $user->user_name ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" value="<?= $user->user_email ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" value="<?= $user->user_pass ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" value="<?= $user->user_address ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
</div>