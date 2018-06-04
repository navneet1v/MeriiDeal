<?php include '../include/header.php'; ?>

<br>
<div class="container">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Create New Store Listings</h2>
                </div>
            </div>
        </div>
    </header>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-6">
                <form action="/createStore.php">

                    <div class="form-group">
                        <label for="storeName">Store Name: </label>
                        <input type="text" class="form-control" id="storeName" required="true">
                    </div>

                    <div class="form-group">
                        <label for="landmark">Landmark:</label>
                        <input type="text" class="form-control" id="landmark" required="true">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="5" id="description" required="true"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">PhoneNumber:</label>
                        <input type="text" pattern="^\d{4}-\d{3}-\d{4}$" class="form-control" id="phoneNumber" required="true">
                    </div>

                    <button type="submit" class="btn btn btn-success active">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../include/footer.php'; ?>
