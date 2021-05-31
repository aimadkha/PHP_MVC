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
</div>
