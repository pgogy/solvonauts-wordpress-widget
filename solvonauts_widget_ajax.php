<?PHP
		
	/**
	 * Add actions for both logged in and not logged in users
	 */
	add_action('wp_ajax_nopriv_solvonauts_search', 'solvonauts_get');
	add_action('wp_ajax_solvonauts_search', 'solvonauts_get');
	
	function solvonauts_get(){
	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'http://solvonauts.org/?action=api_search&term=' . $_POST['keywords']);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,100);
		curl_setopt($ch,CURLOPT_USERAGENT,"Solvonauts WordPress Widget");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
		$data = json_decode(curl_exec($ch));
		
		$data = array_slice($data->results,0,$_POST['no_items']);

		foreach($data as $result){
		
			echo "<li><a href='" . $result->link . "'>" . $result->title . "</a></li>";
		
		}
		
		die();
		
	}
	
?>