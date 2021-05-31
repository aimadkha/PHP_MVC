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
        <?php if (isset($_SESSION['message'])) { ?>
            <p class="message <?=isset($error) ? 'error' : '' ?>"><?= $_SESSION['message'] ?></p>
            <?php
            unset($_SESSION['message']);
        }
        ?>
        <table class="table table-striped">
            <thead>
            <tr>

                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($products !== false) {
                foreach ($products as $product) {
                    ?>
                    <tr>
                        <td><?= $product->product_name ?></td>
                        <td><?= $product->product_description ?></td>
                        <td><?= $product->product_price ?>$</td>
                        <td><?= $product->product_category ?></td>
                        <td><img class="img-fluid float-left" style="height: 4rem; width: 4rem" src=' <?= IMG. $product->product_img ?>'></td>
                        <td>
                            <a href="/product/edit/<?= $product->product_id ?>"><i class="fas fa-edit"></i></a>
                            <a href="/product/delete/<?= $product->product_id ?>" onclick="if (!confirm('Do you want to delete this product?')) return false;"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <td><p>Sorry no products to list</p></td>
                <?php
            }
            ?>

            </tbody>
            <a href="/product/add"><button class="my-5 btn btn-primary"><i class="fas fa-plus"></i> Add new Offer</button> </a>
        </table>
    </div>

</div>