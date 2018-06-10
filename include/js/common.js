function createTable(dataArray, tableContainerDiv, cssClassesArray) {
    // class = "class1 class2 class3"
    var styleClass = "<table class = \"";
    for (var i = 0; i < cssClassesArray.length; i++) {
        styleClass += cssClassesArray[i] + " ";
    }
    styleClass += "\" />";

    // create HTML table element
    var table = $(styleClass);
    console.log(styleClass);
    //Get the count of columns.
    var columnCount = dataArray[0].length;

    //Add the header row.
    var row = $(table[0].insertRow(-1));
    for (var i = 0; i < columnCount; i++) {
        var headerCell = $("<th />");
        headerCell.html(dataArray[0][i]);
        row.append(headerCell);
    }

    //Add the data rows.
    for (var i = 1; i < dataArray.length; i++) {
        row = $(table[0].insertRow(-1));
        for (var j = 0; j < columnCount; j++) {
            var cell = $("<td />");
            cell.html(dataArray[i][j]);
            row.append(cell);
        }
    }

    var dvTable = $("#" + tableContainerDiv);
    dvTable.html("");
    dvTable.append(table);
}