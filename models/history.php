<?php  

  
class  history{
	private $id;
	private $currency_begin;
	private $currency_end;
	private $amount;
	private $result;
	private $created_at;
	
	public function get_id(){ return $this->id ;}
	public function get_currency_begin(){ return $this->currency_begin ;}
	public function get_amount(){ return $this->amount ;}
	public function get_currency_end(){ return $this->currency_end ;}
	public function get_result(){ return $this->result ;}
	public function get_created_at(){ return $this->created_at ;}
	
	public function set_id($id){  $this->id = $id ;}
	public function set_currency_begin($currency_begin){  $this->currency_begin = $currency_begin ;}
	public function set_currency_end($currency_end){  $this->currency_end = $currency_end ;}
	public function set_amount($amount){  $this->amount = $amount ;}
	public function set_result($result){  $this->result = $result ;}
	public function set_created_at($created_at){  $this->created_at = $created_at ;}
	
	public function save() {
   		global $db;
		$req = $db->prepare('INSERT INTO history_convertion(currency_begin, currency_end, amount ,result) VALUES(?, ?,? ,?)');
		$req->execute(array($this->currency_begin,$this->currency_end,$this->amount,$this->result));
							
		}
		
		public function get_history_all_convertion(){
			global $db;    
			$reponse = $db->query("SELECT * from history_convertion order by created_at desc");
			return $reponse ;
		}
}

?>