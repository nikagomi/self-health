<?php 

//phpinfo();

$date = '';
$bday = new \DateTime('1980-10-04'); // Your date of birth
$startDate = (\trim($date) == '') ? new \Datetime(\date('Y-m-d')) : new \Datetime($date);
$ageDiff = $startDate->diff($bday);
echo "<pre>";
print_r( $ageDiff);
echo "</pre>";