// Toggle the visibility of the search bar
function toggleSearchBar() {
    var searchBarContainer = document.getElementById("searchBarContainer");
    searchBarContainer.classList.toggle("active");
}

// Perform the search
function performSearch() {
    var query = document.getElementById("searchInput").value;
    if (query) {
        // For demonstration, logging the query. Replace with actual search logic.
        console.log("Searching for: " + query);
        
        // Example: Redirect to a search results page with the query
        // window.location.href = "search-results.html?q=" + encodeURIComponent(query);
    } else {
        alert("Please enter a search term.");
    }
}

// Other JavaScript functions for opening side navigation and dropdowns
function openNav() {
    document.getElementById("mySidenav").classList.add("active");
}

function closeNav() {
    document.getElementById("mySidenav").classList.remove("active");
}

function toggleDropdown() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.profile-icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}