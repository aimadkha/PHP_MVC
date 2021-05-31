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
            <li class="m-3"><a class="text-white " href="/dashboard/statistique"><i class="fas fa-chart-bar"></i>
                    Statistique</a></li>
            <li class="m-3"><a class="text-white " href="/reservation"><i class="fas fa-shopping-cart"></i> Reservation</a></li>
            <li class="m-3"><a class="text-white " href="/user"><i class="fa fa-user text-white"></i> Customer</a></li>
            <li class="m-3"><a class="text-white " href="/product"><i class="fas fa-car"></i> Offer</a></li>
            <li class="m-3"><a class="text-white " href="/user/logout"
                               onclick="if (!confirm('Do you want to log out?')) return false;"><i
                            class="fas fa-sign-out-alt"></i> Sign out</a></li>
        </ul>

    </nav>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>

                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">Car Name</th>
                <th scope="col">Car Price</th>
                <th scope="col">Duration</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($reserved !== false) {
                foreach ($reserved as $reserve) {
                    ?>
                    <tr>
                        <td><?= $reserve->reservation_id ?></td>
                        <td><?= $reserve->product_id ?></td>
                        <td><?= $reserve->user_id ?></td>
                        <td><?= $reserve->duration ?> Day</td>

                        <td>
                            <a href="/reservation/edit/<?= $reserve->reservation_id ?>"><i class="fas fa-edit"></i></a>
                            <a href="/reservation/delete/<?= $reserve->reservation_id ?>" onclick="if (!confirm('Do you want to delete this product?')) return false;"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <td><p>Sorry no reserved cars to list</p></td>
                <?php
            }
            ?>

            </tbody>
            <a href="/reservation/add"><button class="my-5 btn btn-primary"><i class="fas fa-plus"></i> Add new reservation</button> </a>
        </table>
    </div>
</div>