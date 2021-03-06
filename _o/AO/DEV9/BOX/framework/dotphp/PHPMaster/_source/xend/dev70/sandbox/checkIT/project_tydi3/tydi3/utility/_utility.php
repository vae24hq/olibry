//Displays HTML notification
function notify($msg='', $class='notice', $wrap='p'){
	#validate
 	if(is_null($msg) || empty($wrap)){return FALSE;}

 	#prepare
 	$wrap = strtolower($wrap);
 	if(empty($class)){$css = '';}
 	else {$css = ' class="erko-'.$class.'"';}
 	$chore = '<'.$wrap.$css.'>'.$msg.'</'.$wrap.'>';

 	#return result
 	return $chore."\n";
}

//Return size in readable format
function format_size($size=''){
	#validate
	if(is_empty($size)){return FALSE;}

	#prepare task
	if($size>=1073741824){$chore = number_format($size / 1073741824 , 2) . 'GB';}
	elseif($size>=1048576){$chore = number_format($size / 1048576 , 2) . 'MB';}
	elseif($size>=1024){$chore = number_format($size / 1024 , 2) . 'KB';}
	elseif($size>1){$chore = $size . ' bytes';}
	elseif($size==1){$chore = $size . ' byte';}
	else {$task = '0';}

	#return task
 	return $chore;
}

//Return encrypted or decrypted data
function do_crypt($data ='', $pattern = 'flexi'){
	#prepare & return task
	if(!empty($data)){
		if ($pattern == 'crypt'){
			$chore = hash("md5", $data);
			$chore = sha1($chore);
			$chore = md5($chore);
		}
		elseif($pattern == 'strict'){$chore = md5($data);}
		elseif ($pattern == 'reverse'){$chore = base64_decode($data);}
		else {$chore = base64_encode($data);}
	}
	else {return FALSE;}

	return $chore;
}


//Returns unsupported browser notice
function stale_browser($browser=''){
	$prep = '<div class="erko-content">'."\n";
	$prep .= '<h3>Unsupported Browser!</h3>'."\n";
	$prep .= '<p>Opps, we are sorry for this awkwardness<br>'."\n";
	$prep .= 'You appear to be using a ';
	if($browser=='ie'){$prep .= 'very stale version of Internet Explorer ';}
	else {$prep .= 'browser or a very stale version of a browser. ';}	
	$prep .= ' that we currently do not support.<br>'."\n";
	$prep .= 'Please try to upgrade to a more recent version or download a better browser.<br>'."\n";
	$prep .= "Don't know where to start? - ask ".markup_absurl('http://www.google.com', 'Google').'</p>'."\n";
	$prep .= '<p class="spaceTop">You may reach us at ';
	$prep .= '<a href="mailto:'.erko::$mailadmin.'" target="_blank" class="email">'.erko::$mailadmin.'</a></p>'."\n";
	$prep .= '</div>'."\n";
	
	#ouput task
	echo $prep;	return;
}


//Returns error 404 notice
function not_found($data='', $notify_as='display'){ #display | email | sms | log | all
	$chore = '<article id="erko-article">'."\n";
	$chore .= '<h3 class="heading">'.ucwords($data).' - Not Found!</h3>'."\n";
	$chore .= '<div class="article-container">'."\n";
	$chore .= '<div class="content">'."\n";
	$chore .= '<p>We are sorry for this awkwardness as the requested document is not available.<br>
				Please return to '.markup_url('index', erko::$name).'</p>'."\n";
	$chore .= '<p class="spaceTop">You may report this issue to us via ';
	$chore .= '<a href="mailto:'.erko::$mailadmin.'" target="_blank" class="paralink">'.erko::$mailadmin.'</a></p>'."\n";
	$chore .= '</div>'."\n";
	$chore .= '</div>'."\n";
	$chore .= '</article>'."\n";

	if($notify_as=='all' || $notify_as=='display'){echo $chore;}

	return;
}

//Handles redirect
function redirect($location='', $delay='none', $report = 'on'){
	if(!is_empty($location)){
		$duration = $delay; if($delay=='none'){$duration = 0;}
		if (!headers_sent($filename, $linenum)){
			if($duration !=0){header("Refresh:".$duration.";URL=".$location);}
			else{header('Location: '.$location); exit;}
		} else {
			$operation = '<meta http-equiv="refresh" content="'.$duration.'; url='.$location.'">';
			$content ='<p class="redirect">You are now being redirected. <br>Please wait or <a href="'.$location.'">click here</a>.</p>';
			echo $operation; echo "\n"; if($report=='on'){echo $content;}
			if($duration == 0 && $report == 'on'){exit;}
		}
	}
	else {
		return FALSE;
	}
}

//Adds file to document
function add_file($location='', $persist='yeah', $check='strict'){
 	if(is_empty($location)){exit('{file include error}: file for inclusion is required');}
 	
 	if(!found_file($location)){
 		if($check=='strict'){
 			exit('The file "{'.$location.'} does not exist!');
 		}
 	}
 	else { #include file, because it exist
 		if($persist!='no'){include_once($location);}
 		else {include($location);}
 	}
 	return;
}