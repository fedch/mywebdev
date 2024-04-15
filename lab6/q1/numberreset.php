<?php
    session_start();
    // unset all session variables
    session_unset();
    // destroy all data associated with the current session
    session_destroy();
    header('location:number.php');
?>