<?php
//Start Access Functions Class
class accessFunctions {
	//Declare Global Variables for Access

	//Create DB Function
	public function connetDB() {
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	}

	//Start Login Function for both Agents and Admins
	public function accessLogin($access_type, $agent_passcode, $admin_email, $admin_password) {
		//Declare Local Variables
		$agent_passcode;
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		$expire = time() + 60*60*24;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		//Check Access Type
		if ($access_type == 'agent') {
			//Agent Attempting to Login
		  $query_user = "SELECT * FROM access__agents WHERE agent_passcode = '$agent_passcode'";
		  $result_user = $conn->query($query_user);
		  //Count Rows
			$query_user_check = mysqli_num_rows($result_user);
			if (!empty($query_user_check)) {
				//Get Agent Info
		    while ($row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC)) {
		      $user_id = $row_user['agent_id'];
		      $user_level = $row_user['agent_level'];
		    }
				//Create COOKIES
		    setcookie('user_id', $user_id, $expire, '/');
		    setcookie('user_level', $user_level, $expire, '/');
		    setcookie('user_access_type', $access_type, $expire, '/');
				//Add to Log
				$this->accessLog($user_id, $access_type, 'login', 1, '');
				//Return Good
		    return true;
			} else {
		    //User Info Not Found in Database
				//Add to Log
				$log_input = 'Passcode: '.$agent_passcode;
				$this->accessLog($user_id, $access_type, 'login', 0, $log_input);
				//return
		    return false;
			}
		} else if ($access_type == 'admin') {
		  //Admin Attempting to Login
			$query_user = "SELECT * FROM access__admin WHERE admin_email = '$admin_email' && admin_password = '$admin_password'";
		  $result_user = $conn->query($query_user);
		  //Count Rows
			$query_user_check = mysqli_num_rows($result_user);
			if (!empty($query_user_check)) {
				//Get Agent Info
		    while ($row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC)) {
		      $user_id = $row_user['admin_id'];
		      $user_level = $row_user['admin_level'];
		    }
				//Create COOKIES
		    setcookie('user_id', $user_id, $expire, '/');
		    setcookie('user_level', $user_level, $expire, '/');
		    setcookie('user_access_type', $access_type, $expire, '/');
				//Add to Log
				$this->accessLog($user_id, $access_type, 'login', 1, '');
				//Return Good
		    return true;
			} else {
				//Admin Info Not Found in DB
				//Add to Log
				$log_input = 'Email: '.$admin_email.' Password: '.$admin_password;
				$this->accessLog($user_id, $access_type, 'login', 0, $log_input);
				//Return False
		    return false;
			}
		} else {
			//Who the hell are you?
			return false;
		}
	}
	//End Login Function

	//Start Logout Function
	public function accessLogout($user_id, $access_type) {
		//Add to Log
		$this->accessLog($user_id, $access_type, 'logout', 1, '');
		//Declare Variables
		$expire = time()-1;
		//Create COOKIES
		setcookie('user_id', '', $expire, '/');
		setcookie('user_level', '', $expire, '/');
		setcookie('user_access_type', '', $expire, '/');
		return true;
	}
	//End Logout Function

	//Start Access Log Function
	public function accessLog($log_user, $log_user_type, $log_type, $log_result, $log_input) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		$expire = time() + 60*60*24;
		//Conntect DB
		$conn = new mysqli($servername, $username, $password, $dbname);
		$query_log = "INSERT INTO access__logs (log_user, log_user_type, log_type, log_result, log_input, log_created) VALUES ('$log_user', '$log_user_type', '$log_type', '$log_result', '$log_input', '$current_time')";
		//Add Access Log
		$conn->query($query_log);
	}
	//End Access Log Function

	//Start Create Agent Function
	public function accessCreateAgent($agent_fname, $agent_lname, $agent_level, $agent_phone1, $agent_phone2, $agent_phone3, $agent_sta, $agent_ele, $agent_con, $agent_reg) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		$agent_status = 'active';
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				//User is an Admin
				//Conntect DB
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Create User Credentials
				//Generate Radom Agent Passcode
				do {
					$agent_passcode = mt_rand(10000,99999);
					//Search for this Number in DB
					$query_object = mysqli_query($conn, "SELECT 1 FROM access__agents WHERE agent_passcode = $agent_passcode");
			    $query_record = mysqli_fetch_array($query_object);
			    if(!$query_record) {
			        //Passcode Not Found... Proceeed
							//Insert Agent Data
							$query_agent = "INSERT INTO access__agents (agent_fname, agent_lname, agent_level, agent_passcode, agent_phone1, agent_phone2, agent_phone3, agent_status, agent_created) VALUES ('$agent_fname', '$agent_lname', '$agent_level', '$agent_passcode', '$agent_phone1', '$agent_phone2', '$agent_phone3', '$agent_status', '$current_time')";
							$conn->query($query_agent);
							//Get Agent ID and Return
							$agent_id = mysqli_insert_id($conn);
							//Create Log Entry
							$this->accessLog($admin_id, $access_type, 'create_ag', 1, $agent_id);
							break;
			    }
				} while(1);
				//Check Agent Level
				if ($agent_level == 0) {
					//Agent is at Polling Station Level
					$query_link = "INSERT INTO links__agent_station (agent_id, station_id, linked) VALUES ('$agent_id', '$agent_sta', '$current_time')";
				} else if ($agent_level == 1) {
					//Agent is at the Electoral Level
					$query_link = "INSERT INTO links__agent_ele (agent_id, electoral_id, linked) VALUES ('$agent_id', '$agent_ele', '$current_time')";
				} else if ($agent_level == 2) {
					//Agent is at the Constituency Level
					$query_link = "INSERT INTO links__agent_con (agent_id, constituency_id, linked) VALUES ('$agent_id', '$agent_con', '$current_time')";
				} else if ($agent_level == 3) {
					//Agent is at the Regional Level
					$query_link = "INSERT INTO links__agent_reg (agent_id, region_id, linked) VALUES ('$agent_id', '$agent_reg', '$current_time')";
				} else if ($agent_level == 4) {
					//Agent is at the National Level

				} else {
					//I don't know what level this agent is

				}
				//Link Agent to Appropriate Location
				$conn->query($query_link);
				return $agent_id;
			}
		} else {
			return false;
		}
	}
	//End Create Agent Function

	//Start Edit Agent Function
	public function accessEditAgent($agent_id, $agent_fname, $agent_lname, $agent_level, $agent_phone1, $agent_phone2, $agent_phone3) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Update Info with New Info
				$query_fname = "UPDATE access__agents SET agent_fname = '$agent_fname' WHERE agent_id = '$agent_id'";
				$conn->query($query_fname);
				$query_lname = "UPDATE access__agents SET agent_lname = '$agent_lname' WHERE agent_id = '$agent_id'";
				$conn->query($query_lname);
				$query_level = "UPDATE access__agents SET agent_level = '$agent_level' WHERE agent_id = '$agent_id'";
				$conn->query($query_level);
				$query_phone1 = "UPDATE access__agents SET agent_phone1 = '$agent_phone1' WHERE agent_id = '$agent_id'";
				$conn->query($query_phone1);
				$query_phone1 = "UPDATE access__agents SET agent_phone2 = '$agent_phone2' WHERE agent_id = '$agent_id'";
				$conn->query($query_phone2);
				$query_phone3 = "UPDATE access__agents SET agent_phone3 = '$agent_phone3' WHERE agent_id = '$agent_id'";
				$conn->query($query_phone3);
				//Create Log Entry
				$this->accessLog($admin_id, $access_type, 'edit_ag', 1, $agent_id);
				return true;
			}
		} else {
			return false;
		}
	}
	//End Edit Agent Function

	//Start Suspend Agent Function
	public function accessSuspendAgent($agent_id) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_suspend = "UPDATE access__agents SET agent_status = 'inactive' WHERE agent_id = '$agent_id'";
				$conn->query($query_suspend);
				//Create Log Entry
				$this->accessLog($admin_id, $access_type, 'suspend_ag', 1, $agent_id);
				return true;
			}
		}
	}
	//End Terminate Agent Function

	//Start Purge Agent Function
	public function accessPurgeAgent($agent_id) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "UPDATE access__agents SET agent_status = 'purged' WHERE agent_id = '$agent_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->accessLog($admin_id, $access_type, 'purge_ag', 1, $agent_id);
				return true;
			}
		}
	}
	//End Purge Agent Function

	//Start Purge Agent Function
	public function accessActivateAgent($agent_id) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_activate = "UPDATE access__agents SET agent_status = 'active' WHERE agent_id = '$agent_id'";
				$conn->query($query_activate);
				//Create Log Entry
				$this->accessLog($admin_id, $access_type, 'activate_ag', 1, $agent_id);
				return true;
			}
		}
	}
	//End Purge Agent Function

}
//End Access Class


//Start Data Functions Class
class dataFunctions {
	//Declare Global Variables for Data

	//Start Access Log Function
	public function dataLog($log_user, $log_user_type, $log_type, $log_result, $log_input) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		$expire = time() + 60*60*24;
		//Conntect DB
		$conn = new mysqli($servername, $username, $password, $dbname);
		$query_log = "INSERT INTO data__logs (log_user, log_user_type, log_type, log_result, log_input, log_created) VALUES ('$log_user', '$log_user_type', '$log_type', '$log_result', '$log_input', '$current_time')";
		//Add Access Log
		$conn->query($query_log);
	}
	//End Access Log Function

	//Start Create Polling Station Function
	public function dataCreateStation($station_code, $station_name, $station_electoral, $station_constituency, $station_district, $station_region, $station_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($station_code) || empty($station_name) || empty($station_voters)) {
					return false;
				} else {
					//No Empty Values
					$query_station = "INSERT INTO data__stations (station_code, station_name, station_electoral, station_constituency, station_district, station_region, station_voters, station_created) VALUES ('$station_code', '$station_name', '$station_electoral', '$station_constituency', '$station_district', '$station_region', '$station_voters', '$current_time')";
					$conn->query($query_station);
					//Get Agent ID and Return
					$station_id = mysqli_insert_id($conn);
					if (empty($station_id)) {
						return false;
					} else {
						//Station Created
						//Create Log Entry
						$this->dataLog($admin_id, $access_type, 'create_sta', 1, $station_id);
						return true;
					}
				}
			}
		} else {
			return false;
		}
	}
	//End Create Polling Station Function

	//Start Edit Polling Station Function
	public function dataEditStation($station_id, $station_code, $station_name, $station_electoral, $station_constituency, $station_district, $station_region, $station_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($station_code) || empty($station_name) || empty($station_voters)) {
					return false;
				} else {
					//No Empty Values..Update DB
					//Update Station Code
					$query_station_code = "UPDATE data__stations SET station_code = '$station_code' WHERE station_id = '$station_id'";
					$conn->query($query_station_code);
					//Update Station Name
					$query_station_name = "UPDATE data__stations SET station_name = '$station_name' WHERE station_id = '$station_id'";
					$conn->query($query_station_name);
					//Update Station Electoral
					$query_station_electoral = "UPDATE data__stations SET station_electoral = '$station_electoral' WHERE station_id = '$station_id'";
					$conn->query($query_station_electoral);
					//Update Station constituency
					$query_station_constituency = "UPDATE data__stations SET station_constituency = '$station_constituency' WHERE station_id = '$station_id'";
					$conn->query($query_station_constituency);
					//Update Station District
					$query_station_district = "UPDATE data__stations SET station_district = '$station_district' WHERE station_id = '$station_id'";
					$conn->query($query_station_district);
					//Update Station Region
					$query_station_region = "UPDATE data__stations SET station_region = '$station_region' WHERE station_id = '$station_id'";
					$conn->query($query_station_region);
					//Update Station Voters
					$query_station_voters = "UPDATE data__stations SET station_voters = '$station_voters' WHERE station_id = '$station_id'";
					$conn->query($query_station_voters);
					//Update Station Modified
					$query_station_modified = "UPDATE data__stations SET station_modified = '$current_time' WHERE station_id = '$station_id'";
					$conn->query($query_station_modified);
					//Create Log Entry
					$this->dataLog($admin_id, $access_type, 'edit_sta', 1, $station_id);
					return true;
				}
			}
		} else {
			return false;
		}
	}
	//End Edit Polling Station Function

	//Start Purge Station Function
	public function dataPurgeStation($station_id, $station_code) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "DELETE FROM data__stations WHERE station_id = '$station_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->dataLog($admin_id, $access_type, 'purge_sta', 1, $station_code);
				return true;
			}
		}
	}
	//End Purge Station Function

	//Start Create Electoral Function
	public function dataCreateElectoral($electoral_code, $electoral_name, $electoral_constituency, $electoral_district, $electoral_region, $electoral_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($electoral_code) || empty($electoral_name)) {
					return false;
				} else {
					//No Empty Values
					$query_electoral = "INSERT INTO data__electoral (electoral_code, electoral_name, electoral_constituency, electoral_district, electoral_region, electoral_voters, electoral_created) VALUES ('$electoral_code', '$electoral_name', '$electoral_constituency', '$electoral_district', '$electoral_region', '$electoral_voters', '$current_time')";
					$conn->query($query_electoral);
					//Get Agent ID and Return
					$electoral_id = mysqli_insert_id($conn);
					if (empty($electoral_id)) {
						return false;
					} else {
						//Station Created
						//Create Log Entry
						$this->dataLog($admin_id, $access_type, 'create_ele', 1, $electoral_id);
						return true;
					}
				}
			}
		} else {
			return false;
		}
	}
	//End Create Electoral Function

	//Start Edit Electoral Function
	public function dataEditElectoral($electoral_id, $electoral_code, $electoral_name, $electoral_constituency, $electoral_district, $electoral_region, $electoral_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($electoral_code) || empty($electoral_name) || empty($electoral_voters)) {
					return false;
				} else {
					//No Empty Values..Update DB
					//Update Station Code
					$query_electoral_code = "UPDATE data__electoral SET electoral_code = '$electoral_code' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_code);
					//Update Station Name
					$query_electoral_name = "UPDATE data__electoral SET electoral_name = '$electoral_name' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_name);
					//Update Station constituency
					$query_electoral_constituency = "UPDATE data__electoral SET electoral_constituency = '$electoral_constituency' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_constituency);
					//Update Station District
					$query_electoral_district = "UPDATE data__electoral SET electoral_district = '$electoral_district' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_district);
					//Update Station Region
					$query_electoral_region = "UPDATE data__electoral SET electoral_region = '$electoral_region' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_region);
					//Update Station Voters
					$query_electoral_voters = "UPDATE data__electoral SET electoral_voters = '$electoral_voters' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_voters);
					//Update Station Modified
					$query_electoral_modified = "UPDATE data__electoral SET electoral_modified = '$current_time' WHERE electoral_id = '$electoral_id'";
					$conn->query($query_electoral_modified);
					//Create Log Entry
					$this->dataLog($admin_id, $access_type, 'edit_ele', 1, $electoral_id);
					return true;
				}
			}
		} else {
			return false;
		}
	}
	//End Edit Electoral Function

	//Start Purge Electoral Function
	public function dataPurgeElectoral($electoral_id, $electoral_code) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "DELETE FROM data__electoral WHERE electoral_id = '$electoral_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->dataLog($admin_id, $access_type, 'purge_ele', 1, $electoral_code);
				return true;
			}
		}
	}
	//End Purge Electoral Function

	//Start Create Constituency Function
	public function dataCreateConstituency($constituency_code, $constituency_name, $constituency_district, $constituency_region, $constituency_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($constituency_code) || empty($constituency_name)) {
					return false;
				} else {
					//No Empty Values
					$query_constituency = "INSERT INTO data__constituencies (constituency_code, constituency_name, constituency_district, constituency_region, constituency_voters, constituency_created) VALUES ('$constituency_code', '$constituency_name', '$constituency_district', '$constituency_region', '$constituency_voters', '$current_time')";
					$conn->query($query_constituency);
					//Get Agent ID and Return
					$constituency_id = mysqli_insert_id($conn);
					if (empty($constituency_id)) {
						return false;
					} else {
						//Station Created
						//Create Log Entry
						$this->dataLog($admin_id, $access_type, 'create_con', 1, $constituency_id);
						return true;
					}
				}
			}
		} else {
			return false;
		}
	}
	//End Create Constituency Function

	//Start Edit Constituency Function
	public function dataEditConstituency($constituency_id, $constituency_code, $constituency_name, $constituency_district, $constituency_region, $constituency_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($constituency_code) || empty($constituency_name) || empty($constituency_voters)) {
					return false;
				} else {
					//No Empty Values..Update DB
					//Update Station Code
					$query_constituency_code = "UPDATE data__constituencies SET constituency_code = '$constituency_code' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_code);
					//Update Station Name
					$query_constituency_name = "UPDATE data__constituencies SET constituency_name = '$constituency_name' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_name);
					//Update Station District
					$query_constituency_district = "UPDATE data__constituencies SET constituency_district = '$constituency_district' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_district);
					//Update Station Region
					$query_constituency_region = "UPDATE data__constituencies SET constituency_region = '$constituency_region' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_region);
					//Update Station Voters
					$query_constituency_voters = "UPDATE data__constituencies SET constituency_voters = '$constituency_voters' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_voters);
					//Update Station Modified
					$query_constituency_modified = "UPDATE data__constituencies SET constituency_modified = '$current_time' WHERE constituency_id = '$constituency_id'";
					$conn->query($query_constituency_modified);
					//Create Log Entry
					$this->dataLog($admin_id, $access_type, 'edit_con', 1, $constituency_id);
					return true;
				}
			}
		} else {
			return false;
		}
	}
	//End Edit Constituency Function

	//Start Purge Constituency Function
	public function dataPurgeConstituency($constituency_id, $constituency_code) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "DELETE FROM data__constituencies WHERE constituency_id = '$constituency_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->dataLog($admin_id, $access_type, 'purge_con', 1, $constituency_code);
				return true;
			}
		}
	}
	//End Purge Constituency Function

	//Start Create District Function
	public function dataCreateDistrict($district_code, $district_name, $district_region, $district_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($district_code) || empty($district_name)) {
					return false;
				} else {
					//No Empty Values
					$query_district = "INSERT INTO data__districts (district_code, district_name, district_region, district_voters, district_created) VALUES ('$district_code', '$district_name', '$district_region', '$district_voters', '$current_time')";
					$conn->query($query_district);
					//Get Agent ID and Return
					$district_id = mysqli_insert_id($conn);
					if (empty($district_id)) {
						return false;
					} else {
						//Station Created
						//Create Log Entry
						$this->dataLog($admin_id, $access_type, 'create_dis', 1, $district_id);
						return true;
					}
				}
			}
		} else {
			return false;
		}
	}
	//End Create District Function

	//Start Edit Constituency Function
	public function dataEditDistrict($district_id, $district_code, $district_name, $district_region, $district_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($district_code) || empty($district_name) || empty($district_voters)) {
					return false;
				} else {
					//No Empty Values..Update DB
					//Update Station Code
					$query_district_code = "UPDATE data__districts SET district_code = '$district_code' WHERE district_id = '$district_id'";
					$conn->query($query_district_code);
					//Update Station Name
					$query_district_name = "UPDATE data__districts SET district_name = '$district_name' WHERE district_id = '$district_id'";
					$conn->query($query_district_name);
					//Update Station Region
					$query_district_region = "UPDATE data__districts SET district_region = '$district_region' WHERE district_id = '$district_id'";
					$conn->query($query_district_region);
					//Update Station Voters
					$query_district_voters = "UPDATE data__districts SET district_voters = '$district_voters' WHERE district_id = '$district_id'";
					$conn->query($query_district_voters);
					//Update Station Modified
					$query_district_modified = "UPDATE data__districts SET district_modified = '$current_time' WHERE district_id = '$district_id'";
					$conn->query($query_district_modified);
					//Create Log Entry
					$this->dataLog($admin_id, $access_type, 'edit_dis', 1, $district_id);
					return true;
				}
			}
		} else {
			return false;
		}
	}
	//End Edit Constituency Function

	//Start Purge District Function
	public function dataPurgeDistrict($district_id, $district_code) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "DELETE FROM data__districts WHERE district_id = '$district_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->dataLog($admin_id, $access_type, 'purge_dis', 1, $district_code);
				return true;
			}
		}
	}
	//End Purge District Function

	//Start Create Region Function
	public function dataCreateRegion($region_code, $region_name, $region_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($region_code) || empty($region_name)) {
					return false;
				} else {
					//No Empty Values
					$query_region = "INSERT INTO data__regions (region_code, region_name, region_voters, region_created) VALUES ('$region_code', '$region_name', '$region_voters', '$current_time')";
					$conn->query($query_region);
					//Get Agent ID and Return
					$region_id = mysqli_insert_id($conn);
					if (empty($region_id)) {
						return false;
					} else {
						//Station Created
						//Create Log Entry
						$this->dataLog($admin_id, $access_type, 'create_reg', 1, $region_id);
						return true;
					}
				}
			}
		} else {
			return false;
		}
	}
	//End Create Region Function

	//Start Edit Region Function
	public function dataEditRegion($region_id, $region_code, $region_name, $region_voters) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create DB connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Check for Empty Values
				if (empty($region_code) || empty($region_name) || empty($region_voters)) {
					return false;
				} else {
					//No Empty Values..Update DB
					//Update Station Code
					$query_region_code = "UPDATE data__regions SET region_code = '$region_code' WHERE region_id = '$region_id'";
					$conn->query($query_region_code);
					//Update Station Name
					$query_region_name = "UPDATE data__regions SET region_name = '$region_name' WHERE region_id = '$region_id'";
					$conn->query($query_region_name);
					//Update Station Voters
					$query_region_voters = "UPDATE data__regions SET region_voters = '$region_voters' WHERE region_id = '$region_id'";
					$conn->query($query_region_voters);
					//Update Station Modified
					$query_region_modified = "UPDATE data__regions SET region_modified = '$current_time' WHERE region_id = '$region_id'";
					$conn->query($query_region_modified);
					//Create Log Entry
					$this->dataLog($admin_id, $access_type, 'edit_reg', 1, $region_id);
					return true;
				}
			}
		} else {
			return false;
		}
	}
	//End Edit Region Function

	//Start Purge District Function
	public function dataPurgeRegion($region_id, $region_code) {
		//Declare Local Variables
		$servername = "localhost";
		$username = "sketchventures";
		$password = "Darling2202";
		$dbname = "ballothq";
		$current_time = time();
		//Get Admin ID from COOKIE
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_access_type'])) {
			$admin_id = $_COOKIE['user_id'];
			$access_type = $_COOKIE['user_access_type'];
			if ($access_type != 'admin') {
				//User Not an Admin
				return false;
			} else {
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				//Suspend Agent
				$query_purge = "DELETE FROM data__regions WHERE region_id = '$region_id'";
				$conn->query($query_purge);
				//Create Log Entry
				$this->dataLog($admin_id, $access_type, 'purge_reg', 1, $region_code);
				return true;
			}
		}
	}
	//End Purge District Function
}
//End Data Functions Class
?>
