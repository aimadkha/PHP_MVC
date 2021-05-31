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
            <li class="m-3"><a class="text-white " href="/user/logout" onclick="if (!confirm('Do you want to log out?')) return false;"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
        </ul>

    </nav>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>

                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Full Name</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>

            <?php if ($users !== false) {
                foreach ($users as $user) {
                    ?>

                    <tr>

                        <td><?= $user->user_name ?></td>
                        <td><?= $user->user_email ?></td>
                        <td><?= $user->user_address ?></td>
                        <td><?= $user->user_first_name . " " . $user->user_last_name ?></td>
                        <td>
                            <a href="/user/edit/<?= $user->user_id ?>"><i class="fas fa-edit"></i></a>
                            <a href="/user/delete/<?= $user->user_id ?>" onclick="if (!confirm('Do you want to delete this product?')) return false;"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <td><p>Sorry no user to list</p></td>
                <?php
            }
            ?>
            </tbody>
            <a href="/user/register"><button class="my-5 btn btn-primary"><i class="fas fa-plus"></i> Add new User</button> </a>
        </table>
    </div>
</div>