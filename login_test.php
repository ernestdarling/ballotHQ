<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['action'])) {
  $action = $_GET['action'];
  //$access_type = 'admin';
  $access_type = 'admin';
  $admin_email = 'ernestdarling@live.com';
  $admin_password = 'petenash1';
  $agent_passcode = 'jackpot';
  //Include Functions
  include_once('includes/classAccess.php');
  $class = new accessFunctions;
  $classdata = new dataFunctions;

  if ($action == 'login') {
    //Login
    $check_login = $class->accessLogin($access_type, $agent_passcode, $admin_email, $admin_password);
    if ($check_login == true) {
      echo 'Login Successful';
    } else {
      echo 'Login Unsuccessful';
    }
  }

  else if ($action == 'logout') {
    //Logout
    $user_id = $_COOKIE['user_id'];
    $access_type = $_COOKIE['user_access_type'];
    $check_logout = $class->accessLogout($user_id, $access_type);
    if ($check_logout == true) {
      echo 'Logout Successful';
    } else {
      echo 'Logout Unsuccessful';
    }
  }

  else if ($action == 'createagent') {
    //Declare Variables
    $agent_fname = 'Kwaku';
    $agent_lname = 'Manu';
    $agent_level = 0;
    $agent_phone1 = '0244133544';
    $agent_phone2 = '';
    $agent_phone3 = '';
    $agent_sta = 1;
    $agent_ele = 2;
    $agent_con = 3;
    $agent_reg = 10;

    //Create Agent
    $check_agent = $class->accessCreateAgent($agent_fname, $agent_lname, $agent_level, $agent_phone1, $agent_phone2, $agent_phone3, $agent_sta, $agent_ele, $agent_con, $agent_reg);
    echo 'Agent ID is '.$check_agent;
  }

  else if ($action == 'suspendagent') {
    //Declare Variables
    $agent_id = 1;

    //Create Agent
    $check_agent = $class->accessSuspendAgent($agent_id);
    echo 'Agent '.$agent_id.' is suspended';
  }

  else if ($action == 'purgeagent') {
    //Declare Variables
    $agent_id = 1;

    //Create Agent
    $check_agent = $class->accessPurgeAgent($agent_id);
    echo 'Agent '.$agent_id.' is purged';
  }

  else if ($action == 'activateagent') {
    //Declare Variables
    $agent_id = 1;

    //Create Agent
    $check_agent = $class->accessActivateAgent($agent_id);
    echo 'Agent '.$agent_id.' is activated';
  }

  else if ($action == 'reset_db') {
    $servername = "localhost";
		$username = "sketchventures";
	  $password = "Darling2202";
		$dbname = "ballothq";
    // Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
    //Clear Access and Data
    $reset_access_agents = "TRUNCATE TABLE access__agents";
    $conn->query($reset_access_agents);

    $reset_access_logs = "TRUNCATE TABLE access__logs";
    $conn->query($reset_access_logs);

    $reset_data_constituencies = "TRUNCATE TABLE data__constituencies";
    $conn->query($reset_data_constituencies);

    $reset_data_districts = "TRUNCATE TABLE data__districts";
    $conn->query($reset_data_districts);

    $reset_data_electoral = "TRUNCATE TABLE data__electoral";
    $conn->query($reset_data_electoral);

    $reset_data_logs = "TRUNCATE TABLE data__logs";
    $conn->query($reset_data_logs);

    $reset_data_mps = "TRUNCATE TABLE data__mps";
    $conn->query($reset_data_mps);

    $reset_data_parties = "TRUNCATE TABLE data__parties";
    $conn->query($reset_data_parties);

    $reset_data_presidents = "TRUNCATE TABLE data__presidents";
    $conn->query($reset_data_presidents);

    $reset_data_regions = "TRUNCATE TABLE data__regions";
    $conn->query($reset_data_regions);

    $reset_data_stations = "TRUNCATE TABLE data__stations";
    $conn->query($reset_data_stations);
  }

  else if ($action == 'createstation') {
    $station_code = 1001;
    $station_name = 'LA Primary School';
    $station_electoral = 122;
    $station_constituency = 32;
    $station_district = 34;
    $station_region = 1;
    $station_voters = 25000;

    $checkdata = $classdata->dataCreateStation($station_code, $station_name, $station_electoral, $station_constituency, $station_district, $station_region, $station_voters);
    if ($checkdata == 0) {
      echo 'Station Creation Unsuccessful';
    } else {
      echo 'Station Successfully Created';
    }
  }

  else if ($action == 'editstation') {
    $station_id = 5;
    $station_code = 1001;
    $station_name = 'Methodist Primary School';
    $station_electoral = 102;
    $station_constituency = 31;
    $station_district = 30;
    $station_region = 2;
    $station_voters = 24000;

    $checkdata = $classdata->dataEditStation($station_id, $station_code, $station_name, $station_electoral, $station_constituency, $station_district, $station_region, $station_voters);
    if ($checkdata == 0) {
      echo 'Station Editing Unsuccessful';
    } else {
      echo 'Station Successfully Edited';
    }
  }

  else if ($action == 'purgestation') {
    $station_id = 5;
    $station_code = 1001;

    $checkdata = $classdata->dataPurgeStation($station_id, $station_code);
    if ($checkdata == 0) {
      echo 'Station Purge Unsuccessful';
    } else {
      echo 'Station Successfully Purged';
    }
  }

  else if ($action == 'createelectoral') {
    $electoral_code = 1001;
    $electoral_name = 'Ayawaso Electoral Area';
    $electoral_constituency = 32;
    $electoral_district = 34;
    $electoral_region = 1;
    $electoral_voters = 25000;

    $checkdata = $classdata->dataCreateElectoral($electoral_code, $electoral_name, $electoral_constituency, $electoral_district, $electoral_region, $electoral_voters);
    if ($checkdata == 0) {
      echo 'Electoral Creation Unsuccessful';
    } else {
      echo 'Electoral Successfully Created';
    }
  }

  else if ($action == 'editelectoral') {
    $electoral_id = 1;
    $electoral_code = 999;
    $electoral_name = 'Gyaakye Pramso East';
    $electoral_constituency = 19;
    $electoral_district = 10;
    $electoral_region = 3;
    $electoral_voters = 9000;

    $checkdata = $classdata->dataEditElectoral($electoral_id, $electoral_code, $electoral_name, $electoral_constituency, $electoral_district, $electoral_region, $electoral_voters);
    if ($checkdata == 0) {
      echo 'Electoral Editing Unsuccessful';
    } else {
      echo 'Electoral Successfully Edited';
    }
  }

  else if ($action == 'purgeelectoral') {
    $electoral_id = 1;
    $electoral_code = 999;

    $checkdata = $classdata->dataPurgeElectoral($electoral_id, $electoral_code);
    if ($checkdata == 0) {
      echo 'Electoral Purge Unsuccessful';
    } else {
      echo 'Electoral Successfully Purged';
    }
  }

  else if ($action == 'createconstituency') {
    $constituency_code = 419;
    $constituency_name = 'Bantama';
    $constituency_district = 34;
    $constituency_region = 1;
    $constituency_voters = 100000;

    $checkdata = $classdata->dataCreateConstituency($constituency_code, $constituency_name, $constituency_district, $constituency_region, $constituency_voters);
    if ($checkdata == 0) {
      echo 'Constituency Creation Unsuccessful';
    } else {
      echo 'Constituency Successfully Created';
    }
  }

  else if ($action == 'editconstituency') {
    $constituency_id = 1;
    $constituency_code = 999;
    $constituency_name = 'Asokwa';
    $constituency_district = 10;
    $constituency_region = 3;
    $constituency_voters = 914;

    $checkdata = $classdata->dataEditConstituency($constituency_id, $constituency_code, $constituency_name, $constituency_district, $constituency_region, $constituency_voters);
    if ($checkdata == 0) {
      echo 'Constituency Editing Unsuccessful';
    } else {
      echo 'Constituency Successfully Edited';
    }
  }

  else if ($action == 'purgeconstituency') {
    $constituency_id = 1;
    $constituency_code = 999;

    $checkdata = $classdata->dataPurgeConstituency($constituency_id, $constituency_code);
    if ($checkdata == 0) {
      echo 'Constituency Purge Unsuccessful';
    } else {
      echo 'Constituency Successfully Purged';
    }
  }

  else if ($action == 'createdistrict') {
    $district_code = 419;
    $district_name = 'Asunafo';
    $district_region = 1;
    $district_voters = 100000;

    $checkdata = $classdata->dataCreateDistrict($district_code, $district_name, $district_region, $district_voters);
    if ($checkdata == 0) {
      echo 'District Creation Unsuccessful';
    } else {
      echo 'District Successfully Created';
    }
  }

  else if ($action == 'editdistrict') {
    $district_id = 1;
    $district_code = 999;
    $district_name = 'Asutifi';
    $district_region = 3;
    $district_voters = 914;

    $checkdata = $classdata->dataEditDistrict($district_id, $district_code, $district_name, $district_region, $district_voters);
    if ($checkdata == 0) {
      echo 'District Editing Unsuccessful';
    } else {
      echo 'District Successfully Edited';
    }
  }

  else if ($action == 'purgedistrict') {
    $district_id = 1;
    $district_code = 999;

    $checkdata = $classdata->dataPurgeDistrict($district_id, $district_code);
    if ($checkdata == 0) {
      echo 'District Purge Unsuccessful';
    } else {
      echo 'District Successfully Purged';
    }
  }

  else if ($action == 'createregion') {
    $region_code = 12;
    $region_name = 'Asunafo';
    $region_voters = 100000;

    $checkdata = $classdata->dataCreateRegion($region_code, $region_name, $region_voters);
    if ($checkdata == 0) {
      echo 'Region Creation Unsuccessful';
    } else {
      echo 'Region Successfully Created';
    }
  }

  else if ($action == 'editregion') {
    $region_id = 1;
    $region_code = 999;
    $region_name = 'Brong Ahafo';
    $region_voters = 914;

    $checkdata = $classdata->dataEditRegion($region_id, $region_code, $region_name, $region_voters);
    if ($checkdata == 0) {
      echo 'Region Editing Unsuccessful';
    } else {
      echo 'Region Successfully Edited';
    }
  }

  else if ($action == 'purgeregion') {
    $region_id = 1;
    $region_code = 999;

    $checkdata = $classdata->dataPurgeRegion($region_id, $region_code);
    if ($checkdata == 0) {
      echo 'Region Purge Unsuccessful';
    } else {
      echo 'Region Successfully Purged';
    }
  }
}
?>
