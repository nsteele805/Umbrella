<?php

/* ---------------------------------------------- *
 *	Title: RingPool Number Fetcher 				  *
 *	Authors: Garvan Kuskey & Dan Dubinsky		  *
 *	Returns: Formatted RingPool Number 			  *
 *	Usage: echo $invocaNumber anywhere on page 	  *
 *												  *
 *		All code is (c) Invoca 2014-2015		  *
 * ---------------------------------------------- *


/* 													*

		Don't touch any of these functions ever!! 
				Look below for user input.
*													*/

	
	function ringPoolNumber($id, $apiKey, $queries)
	{
		$url = 'https://invoca.net/api/2014-07-28/ring_pools/'.$id.'/allocate_number.json?ring_pool_key='.$apiKey.'';

		// Append all Pool Params to $url
		foreach ( $queries as $key ) 
		{
			$url .= "&".$key[0]."=".$key[1];				
		}


		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_GET, 1);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec( $ch );
		$response = json_decode($response);

		return $response->promo_number_formatted;

	}

	function getAllQueries()
	{
		$keys = array_keys($_GET);
		$values = $_GET;
		$queries;
		foreach ($keys as $key) 
		{
			$queries[] =  array($key, $values[$key]);
		}

		return $queries;
	}

/* 
	End of the functions 
*/


	// Don't modify this
	$queries = getAllQueries();

	// Add your unique API Key here
	$apiKey = 'Rn5ItBdZ2RaIkck4HBs_IWXdbLb8V0YQ';

	// Add your RingPool ID here
	$id = '14208';

	// Here is your Invoca RingPool Number
	$invocaNumber = ringPoolNumber($id, $apiKey, $queries );

	/* 
	 * 		Place this code on your page where you want the promo number to show:
	 *
	 *						<?php echo $invocaNumber; ?>
	 *
	 */

echo $invocaNumber;

?>