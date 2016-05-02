<?php

	//get google plus count result/cUrl
	function sort_google_plus_counter( $url ,$existing_ch = false){		
		
 		if( $existing_ch === false )
			$ch = curl_init();
		else {
			$ch = $existing_ch;
		}

		$url = "https://plusone.google.com/u/0/_/+1/fastbutton?url=".urlencode($url)."&count=true";

		$options = array(
			CURLOPT_RETURNTRANSFER => true,	 // return web page
			CURLOPT_HEADER	 => false,	// don't return headers
			CURLOPT_FOLLOWLOCATION => true,	 // follow redirects
			CURLOPT_ENCODING	 => "",	 // handle all encodings
			CURLOPT_USERAGENT	 => 'spider', // who am i
			CURLOPT_AUTOREFERER	=> true,	 // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 3,	 // timeout on connect
			CURLOPT_TIMEOUT	 => 1,	 // timeout on response
			CURLOPT_MAXREDIRS	 => 3,	 // stop after 10 redirects
			CURLOPT_URL	 => $url,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false
		);

		curl_setopt_array($ch, $options);

		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);

		if(  $existing_ch === false )
			curl_close($ch);

		if ($errmsg != '' || $err != '') {
		//print_r($errmsg);
		//print_r($errmsg);
			return 0;
		}
		else {
			$dom = new DOMDocument;
			$dom->preserveWhiteSpace = false;
			@$dom->loadHTML($content);
			$domxpath = new DOMXPath($dom);
			$newDom = new DOMDocument;
			$newDom->formatOutput = true;

			$filtered = $domxpath->query("//div[@id='aggregateCount']");

			if( count( $filtered ) == 0 ){
				return 0;
			}

			return (int)$filtered->item(0)->nodeValue;
		}

		return 0;
	
	}
    
	//get stumbleupon count result/cUrl
	function sort_stumbleupon_counter( $url ,$existing_ch = false ){
		
		$url = "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=".$url;
 	
 		if( $existing_ch === false )
			$ch = curl_init();
		else {
			$ch = $existing_ch;
		}

		$options = array(
			CURLOPT_RETURNTRANSFER => true,	 // return web page
			CURLOPT_HEADER	 => false,	// don't return headers
			CURLOPT_FOLLOWLOCATION => true,	 // follow redirects
			CURLOPT_ENCODING	 => "",	 // handle all encodings
			CURLOPT_USERAGENT	 => 'spider', // who am i
			CURLOPT_AUTOREFERER	=> true,	 // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 3,	 // timeout on connect
			CURLOPT_TIMEOUT	 => 1,	 // timeout on response
			CURLOPT_MAXREDIRS	 => 3,	 // stop after 10 redirects
			CURLOPT_URL	 => $url,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false
		);

		curl_setopt_array($ch, $options);
		
		$responseJSON = curl_exec($ch);

		if(  $existing_ch === false )
			curl_close($ch);

		$response = json_decode( $responseJSON, true );
		
		if( !isset( $response['result'] ) || !isset( $response['result']['views']) ){
			return 0;
		}

		return (int)$response['result']['views'];
	}

	//get twitter count result/cUrl
	function sort_twitter_counter( $url , $existing_ch = false){

		$url = "http://urls.api.twitter.com/1/urls/count.json?url=".urlencode(preg_replace("#https?\:\/\/#","",$url));

 		if( $existing_ch === false )
			$ch = curl_init();
		else {
			$ch = $existing_ch;
		}

		$options = array(
			CURLOPT_RETURNTRANSFER => true,	 // return web page
			CURLOPT_HEADER	 => false,	// don't return headers
			CURLOPT_FOLLOWLOCATION => true,	 // follow redirects
			CURLOPT_ENCODING	 => "",	 // handle all encodings
			CURLOPT_USERAGENT	 => 'spider', // who am i
			CURLOPT_AUTOREFERER	=> true,	 // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 3,	 // timeout on connect
			CURLOPT_TIMEOUT	 => 1,	 // timeout on response
			CURLOPT_MAXREDIRS	 => 3,	 // stop after 10 redirects
			CURLOPT_URL	 => $url,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false
		);

		curl_setopt_array($ch, $options);

		$responseJSON = curl_exec($ch);

		if(  $existing_ch === false )
			curl_close($ch);
 	
 		if( empty( $responseJSON ) ) {
 			return 0;
 		}

		$response = @json_decode( $responseJSON, true );

		if( empty($response) || !isset( $response["count"] ) ){
			return 0;
		}

		return (int)$response['count'];
	}

	//get facebook count result/cUrl
	function sort_facebook_counter( $url , $existing_ch = false){

		$url = "https://api.facebook.com/method/fql.query?query=SELECT%20total_count%20FROM%20link_stat%20WHERE%20url=%20\"".$url."\"";

 		if( $existing_ch === false )
			$ch = curl_init();
		else {
			$ch = $existing_ch;
		}

		$options = array(
			CURLOPT_RETURNTRANSFER => true,	 // return web page
			CURLOPT_HEADER	 => false,	// don't return headers
			CURLOPT_FOLLOWLOCATION => true,	 // follow redirects
			CURLOPT_ENCODING	 => "",	 // handle all encodings
			CURLOPT_USERAGENT	 => 'spider', // who am i
			CURLOPT_AUTOREFERER	=> true,	 // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 3,	 // timeout on connect
			CURLOPT_TIMEOUT	 => 1,	 // timeout on response
			CURLOPT_MAXREDIRS	 => 3,	 // stop after 10 redirects
			CURLOPT_URL	 => $url,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false
		);

		curl_setopt_array($ch, $options);

		$responseXML = curl_exec($ch);

		if(  $existing_ch === false )
			curl_close($ch);

		if( empty( $responseXML ) ){
			return 0;
		}

		$response = @simplexml_load_string( $responseXML );

		if( !isset( $response->link_stat ) ){
			return 0;
		}

		return (int)$response->link_stat->total_count;

	}

	//get linkedin count result/cUrl
	function sort_linkedin_counter( $url , $existing_ch = false ){

		$url = "http://www.linkedin.com/countserv/count/share?url=".$url."&lang=en_US&callback=?";
		
 		if( $existing_ch === false )
			$ch = curl_init();
		else {
			$ch = $existing_ch;
		}

		$options = array(
			CURLOPT_RETURNTRANSFER => true,	 // return web page
			CURLOPT_HEADER	 => false,	// don't return headers
			CURLOPT_FOLLOWLOCATION => true,	 // follow redirects
			CURLOPT_ENCODING	 => "",	 // handle all encodings
			CURLOPT_USERAGENT	 => 'spider', // who am i
			CURLOPT_AUTOREFERER	=> true,	 // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 3,	 // timeout on connect
			CURLOPT_TIMEOUT	 => 1,	 // timeout on response
			CURLOPT_MAXREDIRS	 => 3,	 // stop after 10 redirects
			CURLOPT_URL	 => $url,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => false
		);

		curl_setopt_array($ch, $options);

		$responseJSON = curl_exec($ch);

		if(  $existing_ch === false )
			curl_close($ch);
 
		if( empty( $responseJSON ) ){
			return 0;
		}

 		$responseJSON = preg_replace("#(^\?\()|(\);$)#","",trim($responseJSON));

		$response = @json_decode( $responseJSON, true );

		if( !isset( $response['count'] )){
			return 0;
		}

		return (int)$response['count'] ;
	}


	function sort_pinterest_counter($url, $existing_ch = false) {
		$url = empty($url) ? get_permalink() : $url;
		try {
		$json_string = file_get_contents( 'http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url='.$url);
		
		$raw_json = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $json_string);
		$json = json_decode($raw_json, true);
	   
		return intval( $json['count'] );
				}
		catch (Exception $e) {
			return '0';
		}
	}

?>