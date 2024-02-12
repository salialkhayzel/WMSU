document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById("search");
    var userTable = document.querySelector(".user-table");
    var rows = userTable.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function() {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function(row) {
            var cells = row.querySelectorAll("td");
            var shouldShow = false;

            cells.forEach(function(cell) {
                var cellText = cell.textContent.toLowerCase();
                if (cellText.indexOf(searchTerm) !== -1) {
                    shouldShow = true;
                }
            });

            row.style.display = shouldShow ? "" : "none";
        });
    });
});
