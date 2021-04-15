<?php 
 $zip = new ZipArchive;

 	$micarpeta = date('dFY');

 	if (!file_exists('./Uploads')) {
	    mkdir('./Uploads', 0777);
	    chmod('./Uploads', 0777);
	}

	if (!file_exists('./Uploads/'.$micarpeta)) {
	    mkdir('./Uploads/'.$micarpeta, 0777);
	    chmod('./Uploads/'.$micarpeta, 0777);
	}

	$filename = "./Uploads/$micarpeta/NombreDelZip".date('dmY').".zip";

	$dirFiles = "./Uploads/$micarpeta/";

	$dir_open=opendir($dirFiles);

	$files = array();

  while ($current = readdir($dir_open)){
    if( $current != "." && $current != "..") {
      if(is_dir($dirFiles.$current)) {
        //  echo $dirFiles.$current.'/';
      } else {
        //echo $current;
        $files[] = $current;
      }
    }
  }

  if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE){
      exit("cannot open <$filename>\n"); // puedes lanzar una excepción
  }

	foreach($files as $file){
		$localfile = basename($file);
		//print_r($localfile);
	    $zip->addfile($dirFiles.$file, $localfile);
	}

$zip->close();

	foreach($files as $file){
	    unlink($dirFiles.$file);
	}


?>