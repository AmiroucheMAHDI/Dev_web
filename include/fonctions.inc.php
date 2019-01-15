<?php
require_once "util.inc.php";
/*cette fonction affiche le début de code html de chaque page
*@param un entier
*	numéro de tp
*@return titre de la page
*/
function title_page($titre) {
	$var="<!DOCTYPE html>\n";
	$var.="<html lang='fr'>\n";
	$var.="<head>\n";
	$var.="\t<title>".$titre."</title>\n";
	return $var;
}
/*
*cette fonction permet d'écrire des donées dans un fichier csv.
*/

	function writeDataCSV($fileNameCSV,$listData){
		$file = fopen($fileNameCSV,'a+');
		fputcsv($file,$listData);
		fclose($file);
	}

/**
*cette fonction nous retourn un formulaire (login) HTML composée de deux input un de type texte et l'autre de type password
*@return $form (Formulaire HTML)
*/
	
	
function rmAllDir($strDirectory){
		
    $handle = opendir($strDirectory);
    while(false !== ($entry = readdir($handle))){
    	
        if($entry != '.' && $entry != '..'){
        	
            if(is_dir($strDirectory.'/'.$entry)){
                rmAllDir($strDirectory.'/'.$entry);
            }
            elseif(is_file($strDirectory.'/'.$entry)){
                unlink($strDirectory.'/'.$entry);
            }
        }
    }
    rmdir($strDirectory.'/'.$entry);
    closedir($handle);
	}

	function creat_Groupe_ID($filier, $groupe) {
		$licence = substr($filier,0,2);
		$groupe_carac = substr($groupe,-1);
		
		$groupe_ID = $licence.'Trambino'.$groupe_carac;
		$listData = array($filier,$groupe,$groupe_ID);
	}


	

	
	function str_replace_espace($espace,$string) {
		if($espace){
			$str = str_replace(" ", "_", $string);		
		}
		else{
			$str = str_replace("_", " ", $string);			
		}
		return $str;
	}

	function verify_login($fileNameCSV,$login){
		
		$file = fopen($fileNameCSV,'r');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]){
				$find=true;
			}
		}
		fclose($file);
		return $find;
	}

function upload_image($destination,$nom,$prenom,$numero,$file_ext,$file_destination,$file_error,$file_size,$file_tmp) {
		
		$groupe_etudiant = explode('/', $destination);
		$allowed = array("png","jpg","jpeg");		
	
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				if($file_size <= 2097152){
					if(move_uploaded_file($file_tmp, $file_destination)){
						convertImage($file_destination, '200', '200', $file_ext);
						etudiant_upload_pic($nom,$prenom,$numero,date('l-j-m-Y G:m:s',time()),$file_destination,$destination);
						echo upload_image_error(true);		
					}
					else {
						echo upload_image_error(false);
					}			
				}
				else{
					echo upload_image_error(false,"size");
				}
			}
			else{
				echo upload_image_error(false);
			}
		}
		else{
			echo upload_image_error(false,"ext");
		}	
	}
	
	function convertImage($source, $width, $height, $ext) {
		
		$imageSize = getimagesize($source);
		
		switch($ext) {
			case 'png':
			$imageRessource = imagecreatefrompng($source);
				break;		
				
			case 'jpg':
			$imageRessource = imagecreatefromjpeg($source);
				break;
				
			case 'jpeg':
			$imageRessource = imagecreatefromjpeg($source);
				break;	
		}
		
		$imageFinal = imagecreatetruecolor($width, $height);
		
		$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
		
		switch($ext) {
			case 'png':
			imagepng($imageFinal, $source);
				break;
				
			case 'jpg':
			imagejpeg($imageFinal, $source);
				break;
				
			case 'jpeg':
			imagejpeg($imageFinal, $source);
				break;	
		}
	}	
?>