

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