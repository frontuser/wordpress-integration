<?php

/**
 * Created by PhpStorm.
 * User: al-013
 * Date: 27/5/17
 * Time: 12:17 PM
 */
class SmartCode
{

	/**
	 * SmartCode constructor.
	 */
	function __construct()
	{

	}

	/**
	 * Outputs the given setting
	 *
	 * @return String
	 * @since 1.0
	 */
	public static function render()
	{
		$enable = get_option( 'frontuser_enable', 0 );
		$webhash = get_option( 'frontuser_website_code', '' );

		if(!empty( $enable) && $enable == 1 && !empty( $webhash)) {

			echo "
				<script type=\"text/javascript\">
				    (function(p,u,s,h){
				        var t='$webhash';
				        p._fq=p._fq||[];
				        p._fq.push(['_currentTime',Date.now()]);
				        s=u.createElement('script');
				        s.type='text/javascript';
				        s.async=true;
				        s.src='https://cdn.frontuser.com/sdk/1.0/fuser-'+t+'.js',
				        h=u.getElementsByTagName('script')[0];
				        h.parentNode.insertBefore(s,h);
				    })(window,document);
				</script>
			";
		}
	}


	public static function matrix()
	{
		global $post;

		$matrix_data = array();
		if(!empty($post) && $post instanceof WP_Post) {
			$matrix_data['page'] = array(
				'name'  => $post->post_title,
				'type'  => $post->post_name,
				'url'   => get_permalink($post),
				'status'=> $post->post_status,
				'type'  => $post->post_type,
				'created_on'  => $post->post_date,
				'updated_on'  => $post->post_modified,
			);
		}

		$user = wp_get_current_user();
		if(!empty($user) && $user instanceof WP_User) {
			if(!empty($user->to_array())) {

				$matrix_data['user'] = array(
					'id'    => $user->__get( 'ID' ),
					'name'  => $user->__get( 'display_name' ),
					'email' => $user->__get( 'user_email' )
				);

				$user_attributes = json_decode( get_option('frontuser_user_attribute', '{}' ), true);
				if(!empty( $user_attributes )) {
					foreach ($user_attributes as $key => $field) {
						$value = $user->get( $field );
						if(!empty( $value )) {
							$matrix_data['user'][$key] = $value;
						}
					}
				}
			}
		}

		if(is_home()) {
			$matrix_data['referrer'] = array(
				'host' => $_SERVER['HTTP_HOST'],
				'path' => $_SERVER['DOCUMENT_ROOT'],
				'search' => $_SERVER['QUERY_STRING'],
				'utm' => array(
					'medium' => !empty($_REQUEST['medium'])?$_REQUEST['medium']:'',
					'source' => !empty($_REQUEST['source'])?$_REQUEST['source']:'',
					'campaign' => !empty($_REQUEST['campaign'])?$_REQUEST['campaign']:'',
				)
			);
		}

		$matrix_data = json_encode($matrix_data);

		echo "
			<script type=\"text/javascript\">
				window.fu_matrix = $matrix_data;
			</script>
		";
	}


	public static function filteramount($amount = 0)
	{
		$amount = strip_tags($amount);
		$amount = preg_replace("/&#?[a-z0-9]+;/i","", strip_tags($amount));
		$amount = floatval( $amount );

		return $amount;
	}
}