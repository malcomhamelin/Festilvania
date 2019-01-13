$(function() {
    $('#searchInput').autocomplete({
        source : 'JS/modules/mod_timeline/list.php'
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li class='list-group-item line-autocomplete'>" )
		.append( "<div class='form-control-md'><img src=" + item.label + " alt='autocomplete img' style='width:48px; margin-right : 10px; border-radius: 2px;'/>" + item.value + " - <small>" + item.id + "</small></div>" )
        .appendTo( ul );
    };
});