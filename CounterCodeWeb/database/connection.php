<?php

	$cwd = getcwd();
	if(strpos($cwd, 'actions') !== false) {
		$db = new PDO('sqlite:../database/cAlfred.db');
	} else {
		$db = new PDO('sqlite:database/cAlfred.db');
	}

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>