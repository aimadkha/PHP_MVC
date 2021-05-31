<div class="container">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Duration (per day)</label>
            <input type="number" name="duration" class="form-control" id="exampleInputEmail1"
                   aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $user->user_name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">User Last Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $user->user_last_name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Car Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $item->product_name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input type="text" name="desc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $item->product_description ?>" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $item->product_price ?>" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" name="category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   value="<?= $item->product_category ?>" readonly>
        </div>
        <button type="submit" name="confirm" class="btn btn-primary">Confirm Reservation</button>
    </form>
</div>