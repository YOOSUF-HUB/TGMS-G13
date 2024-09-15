function openNav() {
    // You can add the functionality for opening side navigation if required
    alert("Navigation menu clicked!");
}

// Function to toggle the dropdown menu on click
function toggleDropdown() {
    // Get the dropdown element by its ID
    var dropdown = document.getElementById("myDropdown");
    // Toggle the 'show' class on or off
    dropdown.classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    // Check if the clicked target is not the profile icon
    if (!event.target.matches('.profile-icon')) {
        // Get all elements with the class 'dropdown-content'
        var dropdowns = document.getElementsByClassName("dropdown-content");
        // Loop through all dropdowns
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            // If a dropdown is open (has 'show' class), remove the class to close it
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Function to open the side navigation
function openNav() {
    // Add the 'active' class to the side navigation to expand its width
    document.getElementById("mySidenav").classList.add("active");
}

// Function to close the side navigation
function closeNav() {
    // Remove the 'active' class from the side navigation to collapse it
    document.getElementById("mySidenav").classList.remove("active");
}

// Function to show or hide the search form when the search icon is clicked
function toggleSearch() {
    // Get the search form by its ID
    const searchForm = document.getElementById('searchForm');
    
    // Toggle the "show" class to either reveal or hide the form
    searchForm.classList.toggle('show');
}

// Function that runs when the search form is submitted
function performSearch() {
    // Get the value entered in the search input
    const searchQuery = document.getElementById('searchInput').value;

    // If there is a search term entered, show it in an alert
    if (searchQuery) {
        alert("You searched for: " + searchQuery);

        // Here you would normally add actual search logic to process the search term
    } else {
        // Alert if the search input is empty
        alert("Please enter a search term.");
    }

    // Prevent the form from submitting (default behavior) for demo purposes
    return false;
}