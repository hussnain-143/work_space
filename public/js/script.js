$(document).ready(function() {
    $("#toggleSidebar").click(function() {
        $("#sidebar").toggleClass("show");
    });

    $(".dropdown-toggle").click(function (event) {
        event.preventDefault(); // Prevent default anchor behavior

        let dropdownMenu = $(this).next(".dropdown-menu");

        // Close all other dropdowns
        $(".dropdown-menu").not(dropdownMenu).slideUp();

        // Toggle the clicked dropdown menu
        dropdownMenu.slideToggle();
    });

    // Close dropdown when clicking outside
    $(document).click(function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-menu").slideUp();
        }
    });
});