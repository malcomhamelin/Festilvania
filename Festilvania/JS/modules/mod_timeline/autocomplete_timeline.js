$(function() {
    $('#searchInput').autocomplete({
        source : 'JS/modules/mod_timeline/list.php'
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li class='list-group-item line-autocomplete'>" )
		.append( "<div class='form-control-md'>" + item.value + "<small> - " + item.value + "</small></div>" )
        .appendTo( ul );
    };
});