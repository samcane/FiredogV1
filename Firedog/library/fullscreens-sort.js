jQuery(document).ready(function($) {		
	var groupList = $('#fullscreen_ordering');
 
	groupList.sortable({
		update: function(event, ui) {
			//$('#loading-animation').show(); // Show the animate loading gif while waiting
 
			var final_sort = groupList.sortable('toArray').toString();
			$('#fullscreen_order_value').val(final_sort);
			//alert(final_sort);
		}
	});	
});