<?php

class JSON_API_Tags_Controller {

	public function get_tag_posts() {
		global $json_api;
		extract($json_api->query->get(array('slug')));

		if($slug) {
			$posts = $json_api->introspector->get_posts(array(
				'tag' => str_replace(" ", "+", $slug)
			));
			return $this->posts_object_result($posts, $slug);

		} else {
			$json_api->error("Include 'slug' var in your request.");
		}
	}

	protected function posts_object_result($posts, $object) {
		global $wp_query;
		return array(
			'count' => count($posts),
			'pages' => (int) $wp_query->max_num_pages,
			'slug' => $object,
			'posts' => $posts
		);
	}
}

?>