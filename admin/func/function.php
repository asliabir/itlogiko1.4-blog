<?php
/*/ 
-> Name: function.php
-> Folder: /admin
-> Description: 
-> Function Page for admin panel of Blog
*/

// #########Category related Functions#################
// including database connection
include "../db/conn.php";


// adding category function
function addCat($cat_name, $cat_description, $cat_status){
    global $db;
    $query = "INSERT INTO `tbl_category`(`cat_name`, `cat_description`,`cat_status`) ";
    $query .= "VALUES('{$cat_name}','{$cat_description}',{$cat_status}) ";
    $create_category_query = $db->query($query);
    if ($create_category_query) {
        $_SESSION['errMsgClass'] = "alert alert-success";
        $_SESSION['errMsg'] = "Category added succesfully!";
        header("Location: ../allCategory.php");
    } else {
        $_SESSION['errMsgClass'] = "alert alert-danger";
        $_SESSION['errMsg'] = "Something went wrong!! " . mysqli_error($db);
        header("Location: ../addCategory.php");
    }
}

// show category name in all post
function showCatNameById($id){
    global $db;
    $sql = "SELECT `cat_name` FROM `tbl_category` WHERE `cat_id` = $id";
    $result = $db->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            return $row['cat_name'];
        }
    }  else {
            return "Not Found!";
        }
}
// show categories in add post
function showCat(){
    global $db;
    $sql = "SELECT `cat_id`,`cat_name` FROM `tbl_category`";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
    }
}
// logout function
function logout(){
    if (isset($_GET['logout']) && $_SESSION['id']) {
        session_destroy();
        header("Location: login.php");
    }
}

function adminCheck(){
    if(isset($_SESSION) && $_SESSION['role'] !== '1'){
        header("Location: login.php");
    }
}
?>