<?php
/**
 * Created by PhpStorm.
 * User: pjansen
 * Date: 12/7/14
 * Time: 1:24 AM
 */
session_start();

$localhost = "localhost";
$mysqlusername  = "testuser";
$mysqlpassword  = "sys64738";
$db = "testdatabase";
$con = mysql_connect($localhost, $mysqlusername, $mysqlpassword);
mysql_select_db("$db", $con);

// require("config.php");
// need to refactor to work with config.php.  Also need to combine inbox and outbox in a message station page.
// also would be good to clean up the

$user = $_SESSION['user']['username'];

if (isset($POST['view_old'])) {
    $user = $_SESSION['user']['username'];
    $query = mysql_query("SELECT * FROM messages WHERE to_user = '$user' AND deleted = 'no'") or die(mysql_error);
    while ($row2 = mysql_fetch_array($query)) {
        echo "<table border=1>";
        echo "<tr><td>";
        echo "Message ID#: ";
        echo $row2['id'];
        echo "</td></tr>";
        echo "<tr><td>";
        echo "To: ";
        echo $row2['to_user'];
        echo "</td></tr>";
        echo "<tr><td>";
        echo "From: ";
        echo $row2['from_user'];
        echo " ";
        echo "</td></tr>";
        echo "<tr><td>";
        echo "Message: ";
        echo bb($row2['message']);
        echo "</td></tr>";
        echo "</br>";
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <table border="0">
                <tr>
                    <td colspan=2></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" maxlength="32" value="<?php echo $row2['id']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="submit" name="delete" value="Delete PM # <?php echo $row2['id']; ?>">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    }
}


if (isset($_POST['delete'])) {
$id = $_POST['id'];
$user = $_SESSION['user']['username'];
$sql = mysql_query("UPDATE messages SET deleted = 'yes' WHERE id = '$id' AND to_user = '$user'")or die(mysql_error());
echo "Your message has been succesfully deleted.";
}

$sql = mysql_query("SELECT * FROM messages WHERE to_user = '$user' AND deleted='no'")or die(mysql_error());
while($row = mysql_fetch_array($sql))
{
$user = $_SESSION['user']['username'];
  echo "<table border=1>";
  echo "<tr><td>";
  echo "Message ID#: ";
  echo $row['id'];
  echo "</td></tr>";
  echo "<tr><td>";
  echo "To: ";
  echo $row['to_user'];
  echo "</td></tr>";
  echo "<tr><td>";
  echo "From: ";
  echo $row['from_user'];
  echo "</td></tr>";
  echo "<tr><td>";
  echo "Message: ";
  echo $row['message'];
  echo "</td></tr>";
  echo "</br>";
  mysql_query("UPDATE messages SET read_yet = 'yes' WHERE to_user = '$user' AND id ='$row[id]'")or die(mysql_error());
?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table border="0">
<tr><td colspan=2></td></tr>
<tr><td></td><td>
<input type="hidden" name="id" maxlength="32" value = "<?php echo $row['id']; ?>">
</td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="delete" value="Delete PM # <?php echo $row['id']; ?>">
</td></tr>
</table>
</form>

<?

}
echo "</table>";
?>