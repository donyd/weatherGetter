<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Weather Getter</title>

  <script src="js/script.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600" rel="stylesheet">
  <link rel="stylesheet" href=".\css\styles.css">

  <?php
    include('weatherGetter.php');
    date_default_timezone_set("Europe/Dublin");
    $weatherResults = curlGET('api.openweathermap.org/data/2.5/forecast?id=7288565&units=metric&mode=JSON&APPID=7401d8be512f8c43fe517884b777cded');
    //$weatherResults = curlGET('api.openweathermap.org/data/2.5/weather?id=7288565&APPID=##########################');
    //echo $weatherResults;

    //$results = file_get_contents('result.json');
    $json = json_decode($weatherResults, true);

    $innerValues = $json["list"];

    ?>
</head>

<body>
<div class='container'>
  <h1>Dublin 5 Day Forecast</h1>
  <h6>Current Time is: <?php echo ' ' . date('g:i a'); ?></h6>

<?php

print_r('<table class="table table-hover">');
$dateCheck = 0; //
$preventDouble = 0;
foreach($innerValues as $value){
  $dateInfo = date('M jS D', strtotime($value['dt_txt']));
  $dateNum = date('j', strtotime($value['dt_txt'])); // check to create one header per date
  $time = date('g a', strtotime($value['dt_txt']));

  if ($dateCheck < $dateNum){
    print_r('<tr>'. '<th colspan="3" class="groupheader">' . $dateInfo . '</th>' . '</tr>');
    $dateCheck = $dateNum;
  }
  elseif ($dateNum == 1 && !(is_null($preventDouble))) {
    print_r('<tr>'. '<th colspan="3" class="groupheader">' . $dateInfo . '</th>' . '</tr>');
    $preventDouble = null;
    $dateCheck = $dateNum;
  }

  print_r('<tr>'.
              '<td>' . $time. '</td>' .
              '<td>' . $value['main']['temp'] . ' &#8451;' . '</td>' .
              '<td>' . $value['weather'][0]['description'] . '</td>' .
            '</tr>');
}
print_r('</table>');
?>

<footer>
<?php 
    print_r('&copy; 2018-' . date('Y') . ' | Dony \'D\' Made | ');
    print_r('<a href="https://github.com/donyd/weatherGetter">Git Source</a>')
?> 
</footer>
</div>

</body>
</html>
