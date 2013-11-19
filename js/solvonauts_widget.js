function solvonauts_call(terms,max,div){
		
	jQuery(document).ready(function($) {
														
			var data = {
				action: 'solvonauts_search',
				no_items:max,
				keywords:terms
			};		
						
			jQuery.post(ajaxurl, data, 
							
			function(response){
			
				if(response.length!=0){
				
					document.getElementById("solvonauts_widget_" + div).innerHTML = "<p>Searching Solvonauts for " + terms + "</p>" + response;
					
				}
								
			});
								
	});
			
}