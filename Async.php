<?php

// Async Muliti Communication Class.
class Async{

	// Curl muliti handle.
	private $mh;

	// Url list.
	private $requests		= array();

	// Curl ch list.
	private $chList		    	= array();

	// Default option array.
	private $defaultSetoptArray	= array();

	// Running flg
	private $isRunFlg	    	= false;

	// Response
	private $responses		= array();

	// Curl getinfo
	private $infos			= array();

	// Memcache.
	private $memcache		= false;

	// Construter.
	public function __construct(){

		// Set muliti handle.
	        $this->mh = curl_multi_init();
		
		// Set default option array.
		$this->defaultSetoptArray = include CONFIG_ROOT . basename( __FILE__ );

		// If on memcache.
		if( $this->memcache ){
		    
			// Set memcache.
			$this->memcache		    = include LIB_ROOT .'memcache.php';
		}
	}

	// Add ch(url).
	public function addCh( $name, $url, $setopt_array = array() ){

		// If on memcache.
		$response   = ( $this->memcache ) ? $this->memcache->get( $name . $url ) : false ;

		// If No memcache data.
		if( !$response OR count( $response ) == 0 ){

			// Add url.
			$this->requests[]	= array( 'name' => $name, 'url' => $url );

			// Set that Make new curl resorce.
			$this->chList[ $url ]	= curl_init( $url );

			// Replace setopt array.
			$setopt_array		= array_replace( $this->defaultSetoptArray, $setopt_array );

			// Set option array.
			curl_setopt_array( $this->chList[ $url ], $setopt_array );

			// Add handle.
			curl_multi_add_handle( $this->mh, $this->chList[ $url ] );	
		}else{

		        // Get data.
			$this->responses[ $name ] 	= $response;
			
			// On cache flg.
			$this->infos[ $name ]		= array( 'on_cache' => true );
		}
	}

	// Execute multi(async) curl.
	public function talk(){

		// If exist requests.
		if( count( $this->requests ) > 0 ){

			// Set php timelimit.
			set_time_limit( 0 ); 

			// Execute multi(async) curl.
			do { curl_multi_exec( $this->mh, $this->isRunFlg ); } while ( $this->isRunFlg );

			// Loop url list.
			foreach( $this->requests as $request ) {

				// Get data.
				$this->responses[ $request['name'] ]		    = curl_multi_getcontent( $this->chList[ $request['url'] ] );
				
				// Get getinfo().
				$this->infos[ $request['name'] ]		    = curl_getinfo( $this->chList[ $request['url'] ] );

				// On cache flg.
				$this->infos[ $request['name'] ][ 'on_cache' ]	    = false;

				// If on memcache.
				if( $this->memcache ){
		    
					// Set memcache data
					$this->memcache->set( $request['name'] . $request['url'], $this->responses[ $request['name'] ], ADAPI_CACHE_SECOND );
				}

				// Remove curl handle.
				curl_multi_remove_handle( $this->mh, $this->chList[ $request['url'] ] );

				// Close curl handle.
				curl_close( $this->chList[ $request['url'] ] );
			}

			// Remove multi(async) curl handle.
			curl_multi_close( $this->mh );
		}

		// Return this.
		return $this;
	}

	// Get talk response.
	public function getResponse( $name = null, $transration_functions = array() ){

		if( !is_null( $name ) AND isset( $this->responses[ $name ] ) ){
		    
			$this->transration( $name, $transration_functions );

			return $this->responses[ $name ];
		}else{
			return $this->responses;
		}
	}
	
	// Get talk info.
	public function get_info( $name = null ){

		if( !is_null( $name ) AND isset( $this->infos[ $name ] ) ){
			return $this->infos[ $name ];
		}else{
			return $this->infos;
		}
	}

	// Transration talk response.
	public function transration( $name, $functions = array() ){

		if( isset( $this->responses[ $name ] ) ){
	    
		        if( is_array( $functions ) AND count( $functions ) > 0 ){

				foreach( $functions as $function ){
				    
					$function_name	= __FUNCTION__ . '_' . $function;

					if( method_exists( __CLASS__, $function_name ) ){
					    
						$this->{ $function_name }( $name );
					}
				}
			}
		}

		// Return this.
		return $this;
	}

	private function transration_str_to_xmlstr( $name ){
		$array			    = explode( '<?xml', $this->responses[ $name ] );	
		$this->responses[ $name ]   = simplexml_load_string( '<?xml' . $array[ 1 ] );
	}
	
	private function transration_xmlstr_to_arr( $name ){
		$this->responses[ $name ]    = json_decode( json_encode( simplexml_load_string( $this->responses[ $name ] ) ), true );
	}
}

?>
