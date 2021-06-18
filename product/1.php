<?php
//$output = shell_exec('/script/test.sh');
//echo "$output";
echo exec('/bin/bash /script/test.sh');
?>
