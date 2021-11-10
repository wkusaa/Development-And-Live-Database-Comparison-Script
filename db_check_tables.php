<?php

$jsonData = json_decode(file_get_contents("cross_checker.json"), true);

// request database
$mysqli_server1 		= new mysqli( $jsonData['server1']['hostname'], $jsonData['server1']['username'], $jsonData['server1']['password'], $jsonData['server1']['database'], $jsonData['server1']['port'], $jsonData['server1']['socket']) ; // Connect to database
$mysqli_server1->set_charset("utf8") ;
if ( $mysqli_server1->connect_errno ) {
    die( 'Connect Error: ' . $mysqli_server1->connect_errno ) ;
    exit ;
}

// request database
$mysqli_server_2		= new mysqli( $jsonData['server2']['hostname'], $jsonData['server2']['username'], $jsonData['server2']['password'], $jsonData['server2']['database'], $jsonData['server2']['port'], $jsonData['server2']['socket']) ; // Connect to database
$mysqli_server_2->set_charset("utf8") ;
if ( $mysqli_server_2->connect_errno ) {
    die( 'Connect Error: ' . $mysqli_server_2->connect_errno ) ;
    exit ;
}


    // $table_name = readline("Enter the database name : ");
    // $query_columns = "SELECT `COLUMN_NAME` 
    // FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    // WHERE `TABLE_NAME`='".$table_name."' ";


    
    // $mysqli_column_names = $mysqli_server1->query($query_columns);
    // $server1 = array();
    // echo "\n";
    // echo "SERVER 1\n";
    // echo "--------\n";
    // if($mysqli_column_names->num_rows > 0) {
    //     while($row = $mysqli_column_names->fetch_assoc()) {
    //         echo $row['COLUMN_NAME']."\n";
    //         array_push($server1, $row['COLUMN_NAME']);
    //     }
    // } else {
    //     echo "Empty.\n";
    // }
    
    
    // $query_columns = "SELECT `COLUMN_NAME` 
    // FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    // WHERE `TABLE_NAME`='".$table_name."' ";
    
    // $mysqli_column_names = $mysqli_server_2->query($query_columns);
    // $server2 = array();
    // echo "\n";
    // echo "SERVER 2\n";
    // echo "--------\n";
    // if($mysqli_column_names->num_rows > 0) {
    //     while($row = $mysqli_column_names->fetch_assoc()) {
    //         echo $row['COLUMN_NAME']."\n";
    //         array_push($server2, $row['COLUMN_NAME']);
    //     }
    // } else {
    //     echo "Empty.\n";
    // }

$mysqli_tables_names = $mysqli_server1->query("SHOW TABLES;");
$server1 = array();
echo "\n";
echo "SERVER 1\n";
echo "--------\n";
if($mysqli_tables_names->num_rows > 0) {
    while($row = $mysqli_tables_names->fetch_assoc()) {
        echo $row['Tables_in_'.$jsonData['server1']['username']]."\n";
        array_push($server1, $row['Tables_in_'.$jsonData['server1']['username']]);
    }
} else {
    echo "Empty.\n";
}

$mysqli_tables_names = $mysqli_server_2->query("SHOW TABLES;");
$server2 = array();
echo "\n";
echo "SERVER 2\n";
echo "--------\n";
if($mysqli_tables_names->num_rows > 0) {
    while($row = $mysqli_tables_names->fetch_assoc()) {
        echo $row['Tables_in_'.$jsonData['server2']['username']]."\n";
        array_push($server2, $row['Tables_in_'.$jsonData['server2']['username']]);
    }
} else {
    echo "Empty.\n";
}

$diff = array_diff($server1, $server2);
echo "Missing Tables\n";
echo "---------------\n";

foreach ($diff as $key => $value) {
    if(!in_array($value, $server1)) {
        echo "Table '$value' is missing in Server 1\n";
    } else {
        echo "Table '$value' is missing in Server 2\n";
    }
}
