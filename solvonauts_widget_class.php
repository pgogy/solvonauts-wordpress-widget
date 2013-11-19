<?php 

class solvonauts_widget extends WP_Widget_RSS {

	function solvonauts_widget() {
	
		$widget_ops = array( 'description' => __('Displays Solvonauts Content') );
		$this->WP_Widget( 'solvonauts_widget', __('Solvonauts search and display'), $widget_ops);
		
	}

	function widget($args, $instance) {
	
		global $wpdb, $post;

		if ( isset($instance['error']) && $instance['error'] )
			return;
						
		if(!is_home()){
		
			$words = array();
		
			$post_categories = wp_get_post_categories($post->ID);
			
			foreach($post_categories as $data => $value){
				
				$cat = get_category( $value );
			
				?><script type="text/javascript" language="javascript">
					solvonauts_call('<?PHP echo $cat->name; ?>','<?PHP echo $instance["number_links"]; ?>','<?PHP echo $cat->name; ?>');	
				</script>				
				<ul id='solvonauts_widget_<?PHP echo $cat->name; ?>'></ul>
				<?PHP
			
			}
		
		}else{		
			
			$data = $wpdb->get_results( 
											"SELECT name, count(term_taxonomy_id) as total
											FROM $wpdb->terms term, $wpdb->term_relationships relation
											where term.term_id = relation.term_taxonomy_id
											group by name
											order by total desc
											limit 1");
											
			$words = array($data[0]->name);
			
			?>
			<script type="text/javascript" language="javascript">
				solvonauts_call('<?PHP echo $words[0]; ?>','<?PHP echo $instance["number_links"]; ?>','<?PHP echo $words[0]; ?>');	
			</script>				
			<ul id='solvonauts_widget_<?PHP echo $words[0]; ?>'></ul>
			<?PHP
			
		}
	
	}

	function form($instance) {		
		
		echo '<p><label for="' . $this->get_field_id("number_links") .'">Number of links to display (maximum):</label>';
		echo '<input type="text" name="' . $this->get_field_name("number_links") . '" '; 
		echo 'id="' . $this->get_field_id("number_links") . '" value="' . $instance["number_links"] . '" /></p>';

	}
	
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;		
		$instance['number_links'] = $new_instance['number_links'];	
		return $instance;
		
	}
	
}
