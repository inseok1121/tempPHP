<?php
$screenshot = $_POST['screenshot'];
$screenshot = str_replace('data:image/jpeg;base64,', '', $screenshot);
$screenshot = str_replace(' ', '+', $screenshot);
$data = base64_decode($screenshot);
$file = uniqid() . '.jpeg';
$success = file_put_contents($file, $data);

$filepath = $success;
$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$filename = $path_parts['basename'];
$extension = $path_parts['extension'];

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

ob_clean();
flush();
readfile($filepath);

?>
