<?php

class convertion{
	
	private $currency_from;
	private $currency_to;
	private $amount ;
	
	public function get_currency_from() {return $this->currency_from;}
	public function get_currency_to() {return $this->currency_to;}
	public function get_amount() {return $this->amount;}
	
	public function set_currency_from($currency_from) { $this->currency_from=$currency_from;}
	public function set_currency_to($currency_to) { $this->currency_to=$currency_to;}
	public function set_amount($amount) { $this->amount=$amount;}
	
	public function result_convertion(){
	 return $this->rate()*$this->amount;
	}
	
	public function rate(){
		$curl = curl_init();
		$input= $this->currency_from.'_'.$this->currency_to;
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://free.currconv.com/api/v7/convert?q='.$input.'&compact=ultra&apiKey=bcbf598d874a8c367681',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
			'Ocp-Apim-Subscription-Key: 393e1eb938b24e27b222f49f438fc93e',
			'Authorization: Basic YzQ4YTQ2YzctYjQ1ZC00ZjdiLTkzYzMtODdhM2U0MTYyZmFjOjFiYWQxZDRjMDdiZTRkY2NiYzQ2OGRkMmRjYzNjNzNl'
		  ),
		));

		$response = curl_exec($curl);
		// Decode JSON response:
		$conversionResult = json_decode($response, true);

		// access the conversion result
		curl_close($curl);
		return( $conversionResult[$input]);
	}
	
	
}


?>