$(document).ready( function () {
	
	// поиск
	$('#search_clear').click( function() {
		$(this).parents('form').find('input[name=search]').val( '' );
		$(this).parents('form').submit();
	} );
	
	// сортировка
	$('#user_list_table th a').click( function() {
		
		$('#search_form input[name=sortby]').val( $(this).data( 'sortby' ) );
		$('#search_form input[name=sort]').val( $(this).data( 'sort' ) );
		$('#search_form').submit();
		
	} );
	
	// удалений записи
	$('.deleteform').click( function() {
		 
		 $('#delete_form input[name=id]').val( $(this).data( 'id' ) );
		 $('#delete_form').submit();
		
	} );
	
	
});