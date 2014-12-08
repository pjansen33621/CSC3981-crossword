<?php
/**
 * Created by PhpStorm.
 * User: pjansen
 * Date: 12/6/14
 * Time: 11:38 PM
 */
// require database
require("config.php");
mysql_query("CREATE TABLE messages(
 to_user VARCHAR(30)
 from_user VARCHAR(30)
 deleted VARCHAR(3) DEFAULT 'no',
 sent_deleted VARCHAR(3) DEFAULT 'no',
 message VARCHAR(1000))")
or die(mysql_error());

echo "Table Created!";

?>
