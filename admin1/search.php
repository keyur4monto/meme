<?php
   include('db.php');
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = mysqli_query($conn, "SELECT * FROM tag WHERE tag_name LIKE '%".$searchTerm."%' ORDER BY tag_name ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['tag_name'];
    }
    
    //return json data
    echo json_encode($data);
?>