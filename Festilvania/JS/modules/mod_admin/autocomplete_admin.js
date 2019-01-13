function autocomplete_admin() {
    $('#userToAffect').autocomplete({
        source : 'js/modules/mod_admin/list.php'
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li class='list-group-item col-1'>" )
		.append( "<div class='form-control-md'>" + item.value + "</div>" )
        .appendTo( ul );
    };
}