<?php
Class dbObj{
	/* Database connection start */
	var $conn;

	function getConnstring() {
		$con = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub') or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}
?>