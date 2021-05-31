<div class="d-flex">
    <nav class="main_navigation bg-dark w-25 d-flex flex-column justify-content-center align-items-center">

        <div class="employee_info text-white m-3">
            <div class="profile_picture">
                <i class="fas fa-user-alt fa-6x"></i>
                <!--            <img src="" alt="User profile picture">-->
            </div>
            <!--        <span class="name "></span>-->
            <span class="text-center">user</span>
        </div>
        <ul class="app_navigation">
            <li class="m-3"><a class="text-white " href="/reservation/reserveuser"><i class="fas fa-shopping-cart"></i> Reservation</a></li>
            <li class="m-3"><a class="text-white " href="/user/logout" onclick="if (!confirm('Do you want to log out?')) return false;"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
        </ul>

    </nav>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Reservation Number</th>
                <th scope="col">User name</th>
                <th scope="col">User Email</th>
                <th scope="col">Cars Name</th>
                <th scope="col">Cars Price</th>
                <th scope="col">Duration</th>
                <th scope="col">Control </th>
            </tr>
            </thead>
            <tbody>

            <?php if ($reserved !== false) {
//                foreach ($reserveds as $reserved) {
                    ?>
                    <tr>
                        <td><?= $reserved['reservation_id'] ?></td>
                        <td><?= $reserved['user_name'] ?></td>
                        <td><?= $reserved['user_email'] ?></td>
                        <td><?= $reserved['product_name'] ?></td>
                        <td><?= $reserved['product_price'] ?></td>
                        <td><?= $reserved['duration'] ?> Day</td>

                        <td>
                            <a href="#" onclick="print()"><i class="fas fa-print"></i></a>
                            <a href="/reservation/delete/<?= $reserved['reservation_id'] ?>" onclick="if (!confirm('Do you want to delete this product?')) return false;"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php
//                }
            } else {
                ?>
                <td><p>Sorry no reserved cars to list</p></td>
                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</div>
</div>
