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

      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      
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
        <li><a href="#">Dashboard</a></li>
        <li><a href="jewish_prespective.php">Jewish Prespective</a></li>
        <li class="active"><a href="about.php">About the Project</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Chess Data-analyzer</h2>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="analysis.php">Dashboard</a></li>
        <li><a href="jewish_prespective.php">Jewish Prespective</a></li>
        <li class="active"><a href="about.php">About the Project</a></li>
        
       
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>About</h4>
        <p>This is a project for the course: Digital Humanities</p>
      </div>
      <div class="row">
        <div class="col-sm-12" style="
    height: 300px;
">
          <div class="well" style="
    padding-bottom: 300px;
">
              <h4>Background</h4>
              <p>The Project - Demonstrating a tool for analytical research in the chess community </p>
              <b>The process: </b>
              <p>1. Preprocessing - Gather resources of information on games , openings , etc </p>
              <p>2. Parse the information using python's regex  and insert it into SQL tables </p>
              <p>3. Getting the Players nationalities  </p>
              <p>4. Writing the relvant queries</p>
              <p>5. Writing backend server and front end  </p>
              <p> Technolgies used: Python , Wikidata, PHP, Mysql,HTML,Google Chart.
              <p></p>
              <b>A note on chess and it's representaion: </b>
              <p>The main format for reading chess games is pgn - portable game notation </p>
              <p>Portable Game Notation (PGN) is a plain text computer-processible format for recording chess games (both the moves and related data), supported by many chess programs.</p>
              <p>PGN is structured "for easy reading and writing by human users and for easy parsing and generation by computer programs." The chess moves themselves are given in algebraic chess notation. The usual filename extension is </p>
              <p>A chess opening or simply an opening refers to the initial moves of a chess game. The term can refer to the initial moves by either side, White or Black, but an opening by Black may also be known as a defense. There are dozens of different openings, and hundreds of variants. </p>
              <p>Made by : Shaked Mezuman</p>
          </div>
        </div>

        
        
      </div>
      
      
    </div>
  </div>
</div>




</body></html>