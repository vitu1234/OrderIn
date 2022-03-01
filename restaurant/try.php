<?php
 $now = new DateTime();
$back = $now->sub(DateInterval::createFromDateString('30 days'));
echo $back->format('yy-m-d 00:00:00');

?>