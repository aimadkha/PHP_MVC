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
        <canvas id="myChart"></canvas>
    </div>

    <script>
        let myChart = document.getElementById('myChart').getContext('2d');
        let popChart = new Chart(myChart, {
            type: 'bar', // you can use bar , horizontalBar, pie, line, daughunt, radar, polarArea
            data: {
                labels: ['Reserved Car', 'Cars', 'user'],
                datasets: [{
                    label: 'Location',
                    data: [
                        <?php echo $count_rsv; ?>,
                        <?php echo $count_product;?>,
                        <?php echo $count_user;?>
                    ]
                }]

            },
        });

    </script>
    </div>
</div>
