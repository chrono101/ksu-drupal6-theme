$(document).ready(function() {
    $("#edit-search-theme-form-1").attr("value", "Search CIS, Users, K-State");
    $("#edit-search-theme-form-1").focus(function() {
        $(this).attr("value", "");
    });
    $("#edit-search-theme-form-1").blur(function() {
        $(this).attr("value", "Search CIS, Users, K-State");
    });
});
