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
                    }).done(function (data) {
                        var data = JSON.parse(data);
                        $("#cityAdditionMessage").text(data["message"]);
                        $("#cityAdditionAlertBox").show();
                    }).fail(function (data) {
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
                $.post("getAllCities.php").done(function (data) {
                    var data = JSON.parse(data);
                    var cities = data["cities"];
                    callCreateTable(cities);
                }).fail(function () {
                    $("#cityAdditionMessage").text("Fail to Load the cities. Please try again.");
                    $("#cityAdditionAlertBox").show();
                });
            }

            function callCreateTable(cities) {
                var tableArray = [];
                tableArray.push(["#", "Name", "State", "Country"]);
                for (var i = 0; i < cities.length; i++) {
                    var cityArray = [];
                    var country = cities[i]["country"];
                    var state = cities[i]["state"];
                    var name = cities[i]["name"];
                    cityArray.push(i + 1);
                    cityArray.push(name);
                    cityArray.push(state);
                    cityArray.push(country);
                    tableArray.push(cityArray);
                }
                createTable(tableArray, "viewCityTable", ["table", "table-striped"]);
            }

            // --------------------------------------------------------------------------------------- //

            /**
             * This section is responsible for importing the things to Excel
             */
            $("#importToExcelButton").click(importToExcel);

            function importToExcel() {
                $.post("exportCities.php").done(function (data){
                    var data = JSON.parse(data);
                    var fileUrl = data["filename"];
                    console.log(fileUrl + data);
                    $("#cityAdditionMessage").html("File ready to download <a href=\'" + fileUrl + "\'>File Link</a>");
                    $("#cityAdditionAlertBox").show();
                }).fail(function(){
                    $("#cityAdditionMessage").text("Failed To Export Cities. Please try again later.");
                    $("#cityAdditionAlertBox").show();
                });
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

    <div class="alert alert-primary alert-dismissible fade show hiddenStyle" id="cityAdditionAlertBox" role="alert">
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
            <div id="viewCityTable">
            </div>
            <div class="container col-md-6">
                <button type="button" id="importToExcelButton" class="btn btn btn-success active">Import To Excel
                </button>
            </div>
            <br>
        </div>
    </div>

<?php include '../include/footer.php'; ?>