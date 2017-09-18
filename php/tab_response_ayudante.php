
<?php
	//include connection file 
	include_once("tab_connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Employee($connString);

	switch($action) {
	 case 'edit':
		$empCls->updateEmployee($params);
	 break;
	 default:
	 $empCls->getEmployees($params);
	 return;
	}
	
	class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getEmployees($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	
	function getRecords($params) {
	   
	   // getting total number records without any search
		$sql = "SELECT * FROM Ayudantes WHERE fecha_hasta IS NULL";
		
		$queryRecords = mysqli_query($this->conn, $sql) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}
		
		return $data;   // total data array
	}
	function updateEmployee($params) {
		$data = array();
		$sql = "Update Ayudantes set ".$params["name"]." = '" . $params["value"] . "' WHERE id_inscripto='".$params["pk"]."'";
		
		if($result = mysqli_query($this->conn, $sql)) {
			echo 'Successfully! Record updated...';
		} else {
			die("error to update '".$params["name"]."' with '".$params["value"]."'");
		}
	}
}
?>
	