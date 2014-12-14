<?php

function debug($var){

	$debug = debug_backtrace();
	echo '<p>&nbsp;</p><p><a href="#" onclick=$(this).parent().next(\'ul\').slideToggle();><strong>'.$debug[0]['file'].'</strong> L - '.$debug[0]['line'].'</a></p>';
	echo '<ol style="display=none">';
	foreach ($debug as $k=>$v) {
		if ($k>0) {
			echo'<li><strong>'.$v['file'].'</strong> L -'.$v['line'].'</li>';
		}
	}
	echo '</ol>';
	echo '<pre>';
	print_r($var);
	echo '</pre>';

}


function writeHere($txt){
	echo htmlentities($txt, ENT_QUOTES, 'iso-8859-1');
}


function get_uuid($slug, $class){


}

function check_Post($p){

	if( empty($p) ){ 
		return false; 
	}else{
		return true;
	}

}


function redirect($l){
	header("Location: ".rocstinteractive.$l);
}


//Function that compute the sale start/end dates
function getSaleDate( $d, $j,$h ){

	$SaleDate = new DateTime( "$d", new DateTimeZone('Africa/Abidjan') );
	$SaleDate->modify("-$j days");
	$SaleDate->modify("-$h hours");

	return $SaleDate->format("Y-m-d h:i:s");

	
}

function DateToString($d){
	$date = new DateTime("$d");	

	return $date->format("j F Y g:i");
}
// function today(){
	
// }

function uploadFichier($tmp, $name){

	if( !move_uploaded_file ($tmp, CDN.$name ) ){
		return false;
	}else{
		
		//$extensionsAutorisees = array(".jpeg", ".jpg", ".png", ".gif");
		$namefile = $name;

		$extension = substr($namefile, strrpos($namefile, "."));
		$date =date("YmdHisu");
		$newname = sha1("F**CKME".sha1('you')."NOWIGOTIT").$date.$extension;
		
		//rename("../uploads/".sha1($_SESSION["AUTH"]["id"])."/".sha1($_SESSION["AUTH"]["album"])."/".$_FILES["images"]["name"][$key], 
		//"../uploads/".sha1($_SESSION["AUTH"]["id"])."/".sha1($_SESSION["AUTH"]["album"])."/".$newname))

		if(rename ( CDN.$name ,CDN.$newname ) ){
			return $newname;
		}else{
			print_r('error');
		}

		
	}

}


function deletefile($filename){
	//define('DS', DIRECTORY_SEPARATOR);
	//define('CDN','C:'.DS.'xampp'.DS.'htdocs'.DS.'CDN'.DS);
	$dir = CDN;
	$obj = new stdClass();
	if( unlink( $dir.'/'.$filename ) ) {
		$obj->result = true;
	}else{
		$obj->result = false;
	}
	
	return $obj;

}


?>