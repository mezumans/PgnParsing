<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "tchess";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>


  <?php
          function get_query($query,$countstr,$param1,$param2)
          {
             global $conn;

            $result = mysqli_query($conn, $query);
            $rows = array();
            $table = array();
            $table['cols'] = array(
          
              // Labels for your chart, these represent the column titles.
              /* 
                  note that one column is in "string" format and another one is in "number" format 
                  as pie chart only required "numbers" for calculating percentage 
                  and string will be used for Slice title
              */
          
              array('label' => 'Weekly Task', 'type' => 'string'),
              array('label' => 'Percentage', 'type' => 'number')
          
          );
              /* Extract the information from $result */
              foreach($result as $r) {
          
                $temp = array();
          
                // The following line will be used to slice the Pie chart
          
                $temp[] = array('v' => (string) $r[$param1]); 
          
                // Values of the each slice
          
                $temp[] = array('v' => (int) $r[$param2]); 
                $rows[] = array('c' => $temp);
              }
          
          $table['rows'] = $rows;
          
          // convert data into JSON format
          return json_encode($table);
          //echo $jsonTable;
          
          
          
          }
//echo $jsonTable;
$query1 = 
"SELECT  `old_games`.`YEAR`,`old_games`.`WHITE_NAME`,`old_games`.`BLACK_NAME`,`old_games`.`RESULT`,

`openings_test`.`category`,count(`openings_test`.`name`),`openings_test`.`name`,`openings_test`.`fen`
  FROM `old_games` 
  JOIN  `openings_test` ON `old_games`.`FEN` LIKE CONCAT(`openings_test`.`FEN` ,'%')
 
  group by `openings_test`.`Name`
  ORDER by count(`openings_test`.`Name`) desc
  Limit 4";
  $query2 = "SELECT *,count(RESULT) FROM `test` group by test.RESULT order by count(RESULT) desc";
  
  $query3 = "SELECT *,COUNT(`name`) FROM `jewish_n_openings` where `Year` > 1950 and `Year`<1960 group by `jewish_n_openings`.`name` order by count(`name`) DESC LIMIT 8;  ";
  $query4 = "SELECT `jewish_game`.`YEAR`, `jewish_game`.`WHITE_NAME`, `jewish_game`.`BLACK_NAME`, `jewish_game`.`RESULT`, `openings_test`.`category`,count(`openings_test`.`name`),`openings_test`.`name`,`openings_test`.`fen` FROM `jewish_game` JOIN `openings_test` ON `jewish_game`.`FEN` LIKE CONCAT(`openings_test`.`FEN` ,'%') group by `openings_test`.`Name` ORDER by count(`openings_test`.`Name`) desc Limit 7";
  $jsonTable = get_query($query1,'Number of Openings','name','count(`openings_test`.`name`)');

  $jsonTable2 = get_query($query4,'a','name','count(`openings_test`.`name`)');
?>
 


<html lang="en" class="gr__localhost"><head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <!--Load the Ajax API-->
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      //var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var data1 = new google.visualization.DataTable(<?=$jsonTable2?>);

      var options = {
          title: 'Popular openings',
          is3D: 'true',
          backgroundColor: 'transparent',
          width: 400,
          height: 250
        };
        var options2 = {
          title: 'Openings from jewish players during the 50\'s',
          is3D: 'true',
          backgroundColor: 'transparent',
          width: 350,
          height: 250
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      //var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
      var chart2 = new google.visualization.ColumnChart(document.getElementById('piechart2'));
      //chart.draw(data, options);
      chart2.draw(data1, options2);
    }
    </script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body data-gr-c-s-loaded="true">

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="#">Dashboard</a></li>
        <li class="active"><a href="jewish_prespective.php">Jewish Prespective</a></li>
        <li><a href="about.php">About the Project</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Chess Data-analyzer</h2>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="analysis.php">Dashboard</a></li>
        <li class="active"><a href="jewish_prespective.php">Jewish Prespective</a></li>
        <li ><a href="about.php">About the Project</a></li>

        
       
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>The jewish Perspective</h4>
        
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="well">
          <div id="piechart2" style="width: 300%; height: 400px"></div></div>
          <p> * Further explanations about oenings are in the about section.</p>
          </div>

       <div class="col-sm-5">
        <br>
          <div class="well" style="
          height: 539.988636px;
          width: 339.988636px;">
            <h4>Mikhail Tal</h4>
            <img src="250px-Mikhail_Tal_1982.jpg" alt="Mikhail Tal" style="
            height: 250px;">
            <p>Tal was born in Riga, Latvia, into a Jewish family at 9th November 1936.
            Widely regarded as a creative genius and one of the best attacking players of all time, Tal played in a daring, combinatorial style. His play was known above all for improvisation and unpredictability. Every game, he once said, was as inimitable and invaluable as a poem
            To the left you can see his favourite opening  - The scillian minor variation.
            His Son is leaving in Be'er Sheva.
            </p>
          </div>
      
          </div>
       
   
</div>



</body></html>
<?php 
mysqli_close($conn);

?>