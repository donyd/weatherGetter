<?php

function curlGET($url){
      $firstRun = true;
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_URL, $url);


      if(timeChecker() || $firstRun){
        $firstRun = false;
              $results = curl_exec($ch);
              curl_close($ch);
              return $results;
      }

      return file_get_contents('result.json');
    }

 
function timeChecker(){
  // Get the current time and set a variable for timeout session.
  $rightAboutNow = new DateTime();
  $elapsedTime = clone $rightAboutNow;

  // Doc Doc, we gotta get back to the api!!
  // Alright Marty set the time-coordinates to 10 minutes ahead
  $interval = new DateInterval('PT10M');
  
  // Check Doc
  $elapsedTime = $rightAboutNow->add($interval);
  

  if($elapsedTime < new DateTime()){
    return true;    
  } else {
    return false;
  }

}
?>