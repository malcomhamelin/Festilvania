$(function() {
    var liste = [
        "Tommorow Land",
        "test",
        "truc",
        "boutton"
    ];

    $('#searchInput').autocomplete({
        source : 'JS/liste.php'
    });
});