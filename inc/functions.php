<?


	//Dateipfad und Tags[array] werden übergeben
	function show($file_content, $tags)
	{
		//Tags werden gesplittet einzeln durchgeführt
		foreach($tags as $name => $value)
		  {
			 //Tags der Datei werden ersetzt durch funktionen und Sprachelemente
			 $file_content = str_replace('['.$name.']', $value, $file_content);
		  }
		//Datei wird fertig generiert zurück gegeben.
		return $file_content;
	}
	
	function db ($input, $fetch, $rows)
	{	
			//Moe INPUT HIER
	}
	

	/*
	//-> MySQL-Datenbankangaben
	$prefix = $sql_prefix;                      
	$db = array("host" =>           $DB_HOST,
				"user" =>           $DB_USER,
				"pass" =>           $DB_PASS,
				"db" =>             $DB_NAME,
				//"artikel" =>        $prefix."artikel",
				);

	if($db['host'] != '' && $db['user'] != '' && $db['pass'] != '' && $db['db'] != '')
	{
		if(!$msql = mysql_connect($db['host'],$db['user'],$db['pass'])) die("Fehler beim Zugriff auf die Datenbank!");
		if(!mysql_select_db($db['db'],$msql)) die("Die angegebene Datenbank ".$db['db']." existiert nicht!");
	}
	else die("Es wurden nicht alle Datenbank Daten zur Verbindung angegeben");
	
	function db($db)
	{
	  global $prefix;
	  if(!$qry = mysql_query($db)) die('<b>MySQL-Query failed:</b><br /><br /><ul>'.
									   '<li><b>ErrorNo</b> = '.str_replace($prefix,'',mysql_errno()).
									   '<li><b>Error</b>   = '.str_replace($prefix,'',mysql_error()).
									   '<li><b>Query</b>   = '.str_replace($prefix,'',$db).'</ul>');
	  return $qry;
	}*/


?>