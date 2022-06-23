<div class="d-flex text-muted pt-3">
<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
<p class="pb-3 mb-0 small lh-sm border-bottom">
  <strong class="d-block text-gray-dark"><?=$comment["author"]?></strong>
  <?=$comment["date_publ"]?><br>
  <strong class="d-block text-gray-dark"><?=$comment["title"]?></strong>
  <?=$comment["comment"]?><br>
  <!--<?=$comment["likes"]?><br><?=$comment["dislikes"]?><br><?=$comment["rate"]?><br>-->
<?php
echo("<img src='files/img/like_icon.png' width='20px'> <span class='text-primary'>" . $comment["likes"] . "</span>\n");
echo("<img src='files/img/dislike_icon.png' width='20px'> <span class='text-danger'>" . $comment["dislikes"] . "</span>\n");
$color = "";
if ($comment["rate"] > 0) {
    $color = "text-primary";
}
if ($comment["rate"] < 0) {
    $color = "text-danger";
}
echo("Rate: <span class='$color'>" . round($comment["rate"], 2) . "</span><br>\n");
echo("<hr>\n");
?>
</p>
</div>