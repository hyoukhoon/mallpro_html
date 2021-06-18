<?php
/*
$cmd='/usr/bin/python3 /home/mallpro/tao1Test.py';
$result=exec("$cmd", $output);
echo "결과:".$result;
*/

echo shell_exec('sh /home/mallpro/test.sh'); 


?>