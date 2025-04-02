<?php

    // database varible
    define("HOSTNAME","localhost");
    define("USERNAME","root");
    define("DBPASSWORD","");
    define("DATABASENAME","small_crm_db");

    // base path
    define("BASE_URL","http://localhost/Small_CRM/");

    session_start();
    $conn = mysqli_connect(HOSTNAME, USERNAME, DBPASSWORD, DATABASENAME);


    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    
?>