/*
 * This file adds in the neccessary JavaScript to make the search box text
 * change correctly when it has focus and loses focus
 */

$(document).ready(function() {
    $("#edit-search-theme-form-1").attr("value", "Search CIS, Users, K-State");
    $("#edit-search-theme-form-1").focus(function() {
        $(this).attr("value", "");
    });
    $("#edit-search-theme-form-1").blur(function() {
        // This will need to be changed based upon your department or unit
        $(this).attr("value", "Search CIS, Users, K-State");
    });
});
