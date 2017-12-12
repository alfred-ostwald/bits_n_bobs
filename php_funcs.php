<?php
 
 function zipdownloadfiles($unique_id){
  
  /*
   this function simply zips up all files beginning with a given unique id.
   written for work where 3 files (road accident, vehicle and casualty data)
   are copied down from a PostgreSQL database as csv

   Possible future enhancement:
     $zip->setPassword(randompasswordgenertor());
     -> add a randomly generated password to the zip folder to send to the user
     -> data isn't particularly sensitive but would be good to have pw
  */

  $path = 'some/path/to/dir/';
  $outfile = $path.$unique_id.'_am_download_files.zip';
  $unique_id .= '_*';

  $zip = new ZipArchive();
  $zip->open($outfile, ZipArchive::CREATE);

  foreach (glob(path.$unique_id) as $am_tab) {
    if (file_exists($am_tab)) {
	  $zip->addFile($am_tab,basename($am_tab));
    }
  }
  $zip->close();
  return file_exists($outfile);
}
 
?>
