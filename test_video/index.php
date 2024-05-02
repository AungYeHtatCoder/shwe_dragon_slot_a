<?php

include "./getID3-master/getid3/getid3.php";

$getID3 = new getID3;
$filename = 'test.mp4';
$ThisFileInfo = $getID3->analyze($filename);
$getID3->CopyTagsToComments($ThisFileInfo);
echo $ThisFileInfo['playtime_seconds'];