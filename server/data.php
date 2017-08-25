<?php

function get_titles($name, $part)
{
	$conn = connect_to_db($name);
	$conn->set_charset("utf8");
	$sql = "SELECT * FROM contents WHERE part=$part";
	//$result = $conn->query($sql);
	$result = mysqli_query($conn, $sql);

	$data = array();
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			$data[] = array( 'id' => $row["id"], 'english' => $row["name_english"], 'arabic' => $row["name_arabic"], 'pages' => $row["pages"], 'volume' => $row["volume"]);
		}
	} 
	
	$conn->close();
	return $data;
}

function send_store_email($name, $message)
{
	$conn = connect_to_db($name);
        $conn->set_charset("utf8");

        $sql = "INSERT INTO feedback(name, email, rating, message) VALUES ('" . $message['name'] . "','" . $message['email'] . "'," . $message['rating'] . ",'" . $message['message']. "')";

        $ret = "";
        if ($conn->query($sql) === TRUE) {
             $ret = "SUCCESS";
        } else {
             $ret = "Error: " . $sql . "<br>" . $conn->error;
        }

	$conn->close();
	return $ret;

}

function connect_to_db($name)
{
	$servername = "localhost";
	$username = "gueSS1441-yada";
	$password = "yasirhasan";
	$dbname = $name;
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	//$conn->set_charset("utf8");

	return $conn;
}

function get_desc($name)
{
	$conn = connect_to_db($name);
		
	$sql = "SELECT * FROM description";
	//$result = $conn->query($sql);
	$result = mysqli_query($conn, $sql);

	$data = array();
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			$arr = array( 'text' => $row["description"]);
			$conn->close();
			return $arr;
		}
	} 
	
	$conn->close();
	return $data;
}

function get_content($name, $id) 
{
    $conn = connect_to_db($name);	
	if ($id != 1)
	    $sql = "SELECT * FROM hadith WHERE content_id=$id";
        else
            $sql = "SELECT * FROM intro";
	$result = mysqli_query($conn, $sql);

	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
                        
			// output data of each row
                        if ($id != 1)
			    $data[] = array( 'id' => $row["id"], 'chapter' => $row["chapter"], 'hadith' => $row["hadith"], 'number' => $row["number"], 'narrator' => utf8_encode($row["narrator"]), 'text' => utf8_encode($row["text"]), 'chapter_name' => utf8_encode($row["chapter_name"]) );
                        else
                            $data[] = array( 'id' => $row["id"], 'header' => $row["header"], 'text' => utf8_encode($row["text"]));
		}
	} 
	$conn->close();
	return $data;
}

function get_content_title($name, $id)
{
	$conn = connect_to_db($name);
	
	$sql = "SELECT name_english FROM contents WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$data = array();
	$chapter_name = $row["name_english"];
 
	$sql = "SELECT DISTINCT chapter, chapter_name FROM hadith where content_id=$id";
	$result = mysqli_query($conn, $sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
                       $data[] = array( 'chapter' => $row["chapter"], 'chapter_name' => $row["chapter_name"]);
                }
        }
	$arr = array( 'text' => $chapter_name , 'chapters' => $data, 'id' => $id, 'book' => $name, 'title' => 'Kitab Al-Kafi');
	$conn->close();
	return $arr;
}
?>