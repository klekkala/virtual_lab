<?php
date_default_timezone_set ('Asia/Calcutta');
$time=strtotime('+1 hour');
$time1=strtotime('+2 hours');
echo date('h:i:s A',$time);
echo date('h:i:s A',$time1);

?>