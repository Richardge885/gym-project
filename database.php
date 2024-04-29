<?php
// Database connection info 
define("dns", "mysql:host=localhost:3306;dbname=gymDB"); // host and database name
define("username", "richardge"); // database username change value for your needs
define("password", "000000"); // database password change value for your needs

$db = new PDO(dns, username, password);

// User Login Funtion
function userLogin($db, $username, $password)
{
    // SQL syntax query for searching the user table
    $query = "SELECT * FROM `user` WHERE `USERNAME` = :username";

    // Prepare query statement
    $statement = $db->prepare($query);

    // Bind parameters
    $statement->bindParam(':username', $username);

    // Execute query statement
    $statement->execute();

    // Fetch the user information
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if user exists
    if ($userInfo) {
        // Check if password matches
        // TODO password mismatch also returning true
        if ($userInfo['password'] == $password) {
            $_SESSION['username'] = $username;
            // echo "true"; // User found and password matches
        } else {
            echo "wrong password"; // User found but password doesn't match
        }
    } else {
        echo "not existing user"; // User not found
    }

    // Close database connection
    $statement->closeCursor();
}

userLogin($db, "admin@mail.com", "0000");
