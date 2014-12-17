<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 12/11/2014
 * Time: 3:14 PM
 */


if (isset($_POST['submit']))

{

// if the form has been submitted, this inserts it into the Database

    $to_user = $_POST['to_user'];

    $from_user = $_POST['from_user'];

    $message = $_POST['message'];

    $query = "INSERT INTO messages
                                             (to_user, from_user, message)
                                          VALUES
                                             ('$to_user', '$from_user','$message')";
    $db->exec($query);

    //mysql_query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')")or die(mysql_error());

    echo "Successfully sent";

}

else

{

    // if the form has not been submitted, this will show the form

    ?>






<?php

}
?>