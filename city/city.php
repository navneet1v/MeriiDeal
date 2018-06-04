<?php include '../include/header.php'; ?>
    <script>
        $(document).ready(function () {
            $("#addCitybtn").click(function () {
                $("#viewCity").hide();
                $("#addCity").show();
            });

            $("#viewCitybtn").click(function () {
                $("#addCity").hide();
                $("#viewCity").show();
                $("#cityAdditionAlertBox").hide();
                getAllCities();
            });

            // --------------------------------------------------------------------------------------- //

            /**
             * This section has the functions responsible for adding a city.
             */

            $("#addCityFormButton").click(validateCityData);

            function validateCityData() {
                var addCityForm = $("#addCityForm");
                var cityName = addCityForm.find("input#cityName").val();
                var state = addCityForm.find("input#state").val();
                var country = addCityForm.find("input#country").val();
                $.post("addCity.php",
                    {
                        cityName: cityName,
                        state: state,
                        country: country
                    },).done(function(data){
                        var data = JSON.parse(data);
                        console.log(data["message"]);
                        $("#cityAdditionMessage").text(data["message"]);
                        $("#cityAdditionAlertBox").show();
                    }).fail(function(data){
                        $("#cityAdditionMessage").text("Fail to add city. Please try again");
                        $("#cityAdditionAlertBox").show();
                    });

            }

            // --------------------------------------------------------------------------------------- //

            /**
             * This section has the functions responsible for viewing the cities
             */
            function getAllCities() {
                console.log("Getting all the cities");
            }
        });

    </script>

    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <div class="container col-md-6 col-md-offset-3" style="margin-top: 2%; margin-bottom: 1%;">
                <button type="button" id="addCitybtn" class="btn btn-secondary btn-sm">Add City</button>
                <button type="button" id="viewCitybtn" class="btn btn-secondary btn-sm">View Cities</button>
            </div>
        </div>
    </div>

    <div class="alert alert-success alert-dismissible fade show hiddenStyle" id="cityAdditionAlertBox" role="alert">
        <strong id="cityAdditionMessage"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="container" style="margin-top: 2%;">
        <div id="addCity" class="container hiddenStyle col-md-6 col-md-offset-3">
            <form id="addCityForm" action="/">
                <div class="form-group">
                    <label for="cityName">City Name: </label>
                    <input type="text" class="form-control" id="cityName" required="true">
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" id="state" required="true">
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" required="true">
                </div>

                <button type="button" id="addCityFormButton" class="btn btn btn-success active">Add</button>
            </form>

        </div>

        <div id="viewCity" class="container hiddenStyle col-md-6 col-md-offset-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">State</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Kaithal</td>
                    <td>Haryana</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Kurukshetra</td>
                    <td>Haryana</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php include '../include/footer.php'; ?>