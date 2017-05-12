<?php

if ($_FILES["fileToUpload"]["error"]> 0) {
    return "Error: " . $_FILES["fileToUpload"]["error"];
} else {
    echo $_FILES["fileToUpload"]["name"] . "<br/>";
    echo $_FILES["fileToUpload"]["type"]. "<br/>";
    echo $_FILES["fileToUpload"]["size"] . "<br />";
    echo $_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./image/" . $_FILES["fileToUpload"]["name"]);
}
?>
