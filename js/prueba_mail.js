jQuery(document).on('submit', '', function(event){
	event.preventDefault();

 
		jQuery.ajax({
		  url: '../mail.php',
		  type: 'POST',
		  dataType: 'json',
		  data: {param1: 'value1'},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    //called when successful
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }

}
		
});
