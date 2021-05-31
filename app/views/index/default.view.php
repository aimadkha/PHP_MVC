<div class="">
    <div class="land_page d-flex align-items-center">
        <div class="content container w-50 d-flex flex-column align-items-center">
            <h2 class="text-black text-center display-5 font-weight-bold">Welcome To Our Location </h2>
            <p class="text-center text-black">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy.</p>
            <button class="btn btn-primary w-25">Make Reservation</button>
        </div>
    </div>
    <div class="main my-5">
        <h3 class="text-center font-weight-bolder offer__heading">Our Offer</h3>
        <p class="offer__para text-center">Lorem Ipsum is simply dummy text of the printing and typesetting</p>
        <div class="container my-5">
            <div class="row m-3">

                <?php if ($products !== false) {
                    foreach ($products as $product) { ?>
                        <div class="col-4 my-5">
                            <div class="card">
                                <img style="height: 18rem" src="<?= 'img/' . $product->product_img ?>"
                                     class="card-img-top" alt="cars image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product->product_name ?></h5>
                                    <p class="card-text"><?= $product->product_description ?></p>
                                    <a href="/index/reserve/<?= $product->product_id ?>" class="btn btn-primary">Make
                                        reservation</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


            </div>

        </div>

    </div>

    <!-- start about section -->
    <div class="about" id="about">
        <div class="container">
            <div class="about__heading">
                <h3>ABOUT US</h3>
                <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, sapiente.</P>
            </div>
            <div class="about__content">
                <img src="img/about.jpg" alt="about us">
                <div class="about__text">
                    <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate reiciendis distinctio
                        officia eaque labore consectetur, voluptatem dolorem odit placeat ex rerum sapiente delectus
                        facilis, maxime veniam quam, adipisci praesentium rem.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end about section -->

    <div class="container my-4">
        <h3 class="text-center contact__heading">Contact Us</h3>
        <p class="contact__para text-center mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting</p>
        <div class="contact d-flex justify-content-center">

            <div class="contact__info mt-5">
                <div class="contact__local">
                    <i class="fas fa-map-marker-alt"></i>
                    <p class="contact__desc">Lorem ipsum dolor sit amet ipsum dolor.</p>
                </div>
                <div class="contact__phone">
                    <i class="fas fa-phone-alt"></i>
                    <p class="contact__num">
                        +212-65465765465
                    </p>
                </div>
                <div class="contact__mail">
                    <i class="fas fa-envelope"></i>
                    <p class="contact__gmail">
                        example@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </div>