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
            array('label' => 'Name', 'type' => 'string'),
            array('label' => (string)$countstr, 'type' => 'number'));  
            $sum_tot = 0;
            /* Extract the information from $result */
            foreach($result as $r)
             {
            $sum_tot = $sum_tot + (int) $r[(string)$param1];
            $temp = array();
            $temp[] = array('v' => (string) $r[(string)$param1]); 
            $temp[] = array('v' => (int) $r[(string)$param2]); 
            $rows[] = array('c' => $temp);
              }
            $temp = array();
            $temp[] = array('v' => 'others'); 
            $temp[] = array('v' => $sum_tot); 
            $rows[] = array('c' => $temp);

            $table['rows'] = $rows;

// convert data into JSON format
            return json_encode($table);}
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
  $query3 = "SELECT *,COUNT(`name`) FROM `jewish_n_openings` where `Year` > 1950 and `Year`<1960 group by `name` order by count(`name`) DESC ";

$jsonTable = get_query($query1,'Number of Openings','name','count(`openings_test`.`name`)');

$jsonTable2 = get_query($query2,'Matches decided in the result','RESULT','count(RESULT)');

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
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var data1 = new google.visualization.DataTable(<?=$jsonTable2?>);

      var options = {
          title: 'Popular openings',
          is3D: 'true',
          backgroundColor: 'transparent',
          width: 400,
          height: 250
        };
        var options2 = {
          title: 'Results distribution',
          colors: ['grey', 'white','black','green'],
          is3D: 'true',
          backgroundColor: 'transparent',
          width: 400,
          height: 250
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
      var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
      chart.draw(data, options);
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
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="jewish_prespective.php">Jewish Prespective</a></li>
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
        <li class="active"><a href="#section1">Dashboard</a></li>
        <li><a href="jewish_prespective.php">Jewish Prespective</a></li>
        <li><a href="about.php">About the Project</a></li>      
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>Topics In Digital Humanity</h4>
        <p>Chess database analyzer        Database : tchess</p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h3># Games Uploaded</h3>
            <?php 
             global $conn;
              $sql = "SELECT COUNT(`WHITE_NAME`) FROM `game` UNION SELECT COUNT(`WHITE_NAME`) FROM `old_games` UNION SELECT COUNT(`WHITE_NAME`) FROM `jewish_game`";
              $result = mysqli_query($conn, $sql);
              $ans = 0 ;
              $row_cnt = mysqli_num_rows($result);
              if ($row_cnt>0){
                while($row = $result->fetch_assoc()){
                  $ans = $ans + $row["COUNT(`WHITE_NAME`)"];
                }
              }
              /* close result set */
              mysqli_free_result($result);
             
            ?>
            <p><?php echo $ans;?> </p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h3># Openings Uploaded</h4>
            <?php 
             global $conn;
              $sql = "SELECT * from `openings`";
              $result = mysqli_query($conn, $sql);
              $ans = 0 ;
              $row_cnt = mysqli_num_rows($result);
              if ($row_cnt == 0){
                  echo 'error zero rows returned';
                }
              
              /* close result set */
              mysqli_free_result($result);
            ?>
            <p><?php echo $row_cnt;?> </p> 
          </div>
        </div>
        <div class="col-sm-3">
        <br />
          
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4" style="
    margin-right: 30px;
    border-left-width: 10px;
    padding-left: 30px;
    width: 400px;
    height: 300px;
    padding-bottom: 30px;">

          <div class="well">
          <div id="piechart2" style="width: 150%; height: 200px"></div>
          </div>
       
        </div>
        <div class="col-sm-4" style="
        width: 380px;
        height: 300px;
        padding-bottom: 15px;">
          <div class="well">
          <div id="piechart1" style="width: 100%; height: 200px"></div>
             
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>



</body></html>
<?php 
mysqli_close($conn);

?>