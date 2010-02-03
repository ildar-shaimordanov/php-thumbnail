<?php

include_once '_config.php';
include_once 'EmuSQL.php';

$db =& new EmuSQL('', array(
	'fetchmode'	=> 1,
));

$db->setFetchMode(1);

print_r($db);

?>
