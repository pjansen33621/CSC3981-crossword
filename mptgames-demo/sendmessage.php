<?php
/**
 * Created by PhpStorm.
 * User: pjansen
 * Date: 12/6/14
 * Time: 11:44 PM
 */
session_start();
//require("config.php");
$localhost = "localhost";
$mysqlusername  = "testuser";
$mysqlpassword  = "sys64738";
$db = "testdatabase";
$con = mysql_connect($localhost, $mysqlusername, $mysqlpassword);
mysql_select_db("$db", $con);

$message = $_POST['forward2'];
 if (isset($_POST['submit']))
{
// if the form has been submitted, this inserts it into the Database
  $to_user = $_POST['to_user'];
  $from_user = $_POST['from_user'];
  $message = $_POST['message'];
  mysql_query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')")or die(mysql_error());
  echo "Message succesfully sent!";
}
else
{
    // if the form has not been submitted, this will show the form
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table border="0">
<tr><td colspan=2><h3>Send PM:</h3></td></tr>
<tr><td></td><td>
<input type="hidden" name="from_user" maxlength="32" value = <?php echo $_SESSION['user']['username']; ?>>
</td></tr>
<tr><td>To User: </td><td>
<input type="text" name="to_user" maxlength="32" value = "">
</td></tr>
<tr><td>Message: </td><td>
<TEXTAREA NAME="message" COLS=50 ROWS=10 WRAP=SOFT></TEXTAREA>
</td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="submit" value="Send Message">
</td></tr>
</table>
</form>
<?php
}
?>
