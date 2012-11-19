<?php
function compareRelevance($a, $b) {
	if ($a[1] == $b[1]){
		return 0;
	}
	
	return $a[1] < $b[1] ? 1 : -1;
}

if(!isset($_SESSION)){
    session_start();
}

header('Content-Type: text/html; charset=UTF-8');
ini_set('memory_limit','1024M');

if (isset($_GET['query']) and strlen($_GET['query']) < 500){
	$json = file_get_contents('db.json'); //Open and decode questions.
	$questions = json_decode($json, true);
	$results = array(); $query = $_GET['query'];
	
	for ($i = 0; $i < count($questions); $i += 1){
		if (strpos(strtolower($questions[$i]['answer']), strtolower($query)) !== false){
			$similarity = similar_text(strtolower($questions[$i]['answer']), strtolower($query)) / strlen($questions[$i]['answer']);
			$results[] = array($questions[$i], $similarity); //Build up a list of questions to be saved.
		}
	}
	
	if (count($results) > 0){
		usort($results, 'compareRelevance'); //Sort by weighted similar_text.
		
		$_SESSION['handle'] = $results;
		$_SESSION['pointer'] = 0;
		
		$data = array('error' => 0, 'last' => 0, 'first' => 1, 'count' => count($results), 'position' => 0, 'question' => $results[0][0]);
		echo json_encode($data);
	}
	
	else{
		if (isset($_SESSION['handle'])){
			unset($_SESSION['handle']);
		}
				
		if (isset($_SESSION['pointer'])){
			unset($_SESSION['pointer']);
		}
		
		$data = array('error' => 1); //Error code 1, no results found.
		echo json_encode($data);
	}
}

else if (isset($_GET['next']) and isset($_SESSION['handle']) and $_SESSION['pointer'] + 1 != count($_SESSION['handle'])){
	$_SESSION['pointer'] += 1;
	
	if ($_SESSION['pointer'] + 1 != count($_SESSION['handle'])){
		$data = array('error' => 0, 'last' => 0, 'first' => 0, 'count' => count($_SESSION['handle']), 'position' => $_SESSION['pointer'], 'question' => $_SESSION['handle'][$_SESSION['pointer']][0]);
		echo json_encode($data);
	}
	
	else{
		$data = array('error' => 0, 'last' => 1, 'first' => 0, 'count' => count($_SESSION['handle']), 'position' => $_SESSION['pointer'], 'question' => $_SESSION['handle'][$_SESSION['pointer']][0]);
		echo json_encode($data);
	}
}

else if (isset($_GET['previous']) and isset($_SESSION['handle']) and $_SESSION['pointer'] != 0){
	$_SESSION['pointer'] -= 1;
	
	if ($_SESSION['pointer'] != 0){
		$data = array('error' => 0, 'last' => 0, 'first' => 0, 'count' => count($_SESSION['handle']), 'position' => $_SESSION['pointer'], 'question' => $_SESSION['handle'][$_SESSION['pointer']][0]);
		echo json_encode($data);
	}
	
	else{
		$data = array('error' => 0, 'last' => 0, 'first' => 1, 'count' => count($_SESSION['handle']), 'position' => $_SESSION['pointer'], 'question' => $_SESSION['handle'][$_SESSION['pointer']][0]);
		echo json_encode($data);
	}
}

else {
	if (isset($_SESSION['handle'])){
		unset($_SESSION['handle']);
	}
	
	if (isset($_SESSION['pointer'])){
		unset($_SESSION['pointer']);
	}
	
	$data = array('error' => 2);
	echo json_encode($data);
}

?>