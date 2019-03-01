<!-- HTML structure for Armor database -->
<html>
<head>
<title>Armor App</title>
</head>
<body>
    <h1>King's Raid Armor</h1>
    <form action="index.php" method="post">
    <p>Armor Color: </p>
    <input type="text" name="color" require>
    <p>Armor Type: </p>
    <input type="text" name="type">
    <p>Stat 1: </p>
    <input type="text" name="stat1">
    <p>Stat 2: </p>
    <input type="text" name="stat2">
    <p>Stat 3: </p>
    <input type="text" name="stat3">
    <p>Stat 4: </p>
    <input type="text" name="stat4">
    <input type="submit" name="submit" value="Add">
    </form>
</body>
</html>

<!-- Connect to database -->

<?php

//Variables for the server
$dbConn = getenv('CLOUDSQL_CONNECTION_NAME');
$dbUser = getenv('CLOUDSQL_USER');
$dbPass = getenv('CLOUDSQL_PASSWORD');
$dbName = getenv('CLOUDSQL_DATABASE_NAME');
$dsn = "mysql:unix_socket=/cloudsql/$dbConn;dbname=$dbname";

try{
    $pdo = new PDO($dsn ,$dbUser,$dbPass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";

    //insert data into table
    //prepare and bind parameters
    $stmt = $pdo->prepare("INSERT INTO gear (gear_color, gear_type, stat_one, stat_two, stat_three, stat_four) VAlUES (?, ?, ?, ?, ?, ?)");
    echo "Successfully prepared parameter <br>";
    $stmt->execute([$color, $type, $one, $two, $three, $four]);
    echo "Successfully bound parameter";

    //insert a row
    // $color = "red";
    // $type = "orb";
    // $one = "atk";
    // $two = "hp";
    // $three = "crit dmg";
    // $four = "atk spd";
    // $stmt->execute();
    // echo "New record created successfully";
} catch(PDOExeception $e){
    echo "Error: ".$e->getMessage();
}

// Start of Database functionality
// if(isset($_POST['submit'])){
//     // Variables for if statment
//     $color = $_POST['color'];
//     $type = $_POST['type'];
//     $stat1 = $_POST['stat1'];
//     $stat2 = $_POST['stat2'];
//     $stat3 = $_POST['stat3'];
//     $stat4 = $_POST['stat4'];
    
    
    //Create record
//     $stmt = $pdo->prepare("INSERT INTO gear (gear_color, gear_type, stat_one, stat_two, stat_three, stat_four) VALUES (:gear_color, :gear_type, :stat_one, :stat_two, :stat_three, :stat_four)");
//     $stmt->bindParam(':gear_color', $gear_color);
//     $stmt->bindParam(':gear_type', $gear_type);
//     $stmt->bindParam(':stat_one', $stat_one);
//     $stmt->bindParam(':stat_two', $stat_two);
//     $stmt->bindParam(':stat_three', $stat_three);
//     $stmt->bindParam(':stat_four', $stat_four);
//     $pdo->exec($sql);
    
// }
//Create table to hold database info
// echo "<table style='border: solid 2px black;'>";
// echo "<tr><th>Armor Color</th><th>Armor Type</th><th>Stat One</th><th>Stat Two</th><th>Stat Three</th><th>Stat Four</th></tr>";
// $stmt = $pdo->prepare("SELECT * FROM gear");
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $result = $stmt->fetchAll();
// foreach($result as $row){
//  global $idbutton;
//  $idbutton = $row['Gear_ID'];
//  echo "<tr><td>".$row['gear_color']."</td><td>". $row['armor_typing']."</td><td>".$row['stat_one']."</td><td>".$row['stat_two']."</td><td>".$row['stat_three']."</td><td>".$row['stat_four']."</td><td><form action='index.php' method='post'><input name='delete' value=$idbutton hidden ><input type='submit' value='delete'></input></form></td></tr>";
//     }
// echo "</table>";



$pdo = null;
?>