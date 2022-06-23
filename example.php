<?php
include("include/db_config.php");

/*$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_text = "SELECT * FROM `posts` WHERE `id` = $num";
$result = mysqli_query($conn, $sql_text);
if (mysqli_num_rows($result) > 0) {
    echo("<h3>Post:</h3>");
    while($row = mysqli_fetch_assoc($result)) {
        //echo($row["id"] . "<br>\n");
        echo("<b>" . $row["title"] . "</b><br>\n");
        echo($row["author"] . "<br>\n");
        echo($row["date_publ"] . "<br>\n"); 
        echo($row["text"] . "<br>\n");
    }
}

$mysqli2 = new mysqli($servername, $username, $password, $dbname);
$result2 = $mysqli2->query("SELECT * FROM `users`");
while ($row2 = $result2->fetch_assoc()) {
    $num = $row2["id"];
    $username = $row2["username"];
    $role = $row2["role"];
    $date_reg = $row2["date_reg"];
    $last_login = $row2["last_login"];
    echo("<table><tr>\n<td>$num</td>\n<td>$username</td>\n<td>$role</td>\n<td>$date_reg</td>\n<td>$last_login</td>\n</tr></table>\n");
}
$mysqli2->close();*/

/*$rows = $result->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row) {
    echo("<p><b>" . $row["title"] . "</b><br>\n");
    echo($row["author"] . "<br>\n");
    echo($row["date_publ"] . "<br>\n"); 
    echo($row["text"] . "</p>\n");
}*/

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql = "SELECT * FROM `posts`";
$result = $pdo->query($sql);

$count = $result->rowCount();
echo("Read $count rows.<br>\n");

while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
    echo("<p><b>" . $row["title"] . "</b><br>\n");
    echo($row["author"] . "<br>\n");
    echo($row["date_publ"] . "<br>\n"); 
    echo($row["text"] . "</p>\n");
}

$pdo = null;

?>
