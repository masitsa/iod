<?php
$zip = new ZipArchive;
$res = $zip->open('instorelook.zip');
if ($res === TRUE) {
  $zip->extractTo('/var/www/html/');
  $zip->close();
  echo 'woot!';
} else {
  echo 'doh!';
}
?>