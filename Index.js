// Toggle the visibility of the search bar
function opensearchBar() {
    var opensearchBar = document.getElementById("searchBarContainer");
    opensearchBar.classList.toggle("active");
}

// Perform the search
function performSearch() {
    var query = document.getElementById("searchInput").value;
    if (query) {
        // For demonstration, logging the query. Replace with actual search logic.
        console.log("Searching for: " + query);
        
        // Example: Redirect to a search results page with the query
        // window.location.href = "search-results.html?q=" + encodeURIComponent(query);
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



// JavaScript to toggle between view and edit mode
function showEditForm() {
    document.getElementById('viewMode').style.display = 'none';
    document.getElementById('editMode').style.display = 'block';
}

function cancelEdit() {
    document.getElementById('editMode').style.display = 'none';
    document.getElementById('viewMode').style.display = 'block';
}

// Additional JavaScript functions
