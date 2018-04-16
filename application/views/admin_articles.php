<!DOCTYPE html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
  <head>
    <title>Zarządzanie postami</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo asset_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo asset_url('css/styles.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">TeamSpeak 3 Interface</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li>
	                        <a href="#">Status: <?php echo $online.'/'.$maxclients; ?></a>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <?php $this->view('menu'); ?>
		  <div class="col-md-10">
		  	<div class="row">

		  		<div class="col-md-12">
		  		<?php
		  		while($row = mysql_fetch_assoc($articles)) {
					echo '<div class="row"><div class="col-md-12"><div class="content-box-header">';
					echo '<div class="panel-title">'.$row['topic'].'</div>';
					echo '<div style="float:right;font-size:10px;"><a href="article/edit/'.$row['id'].'">Edytuj post</a> | <a href="article/remove/'.$row['id'].'">Usuń post</a></div></div>';
					echo '<div class="content-box-large box-with-header">';
					echo nl2br($row['contents']);
					echo '<br /><br /></div></div></div>';
				}

		  		?>
			  												
		  		</div>
		  	</div>

		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               TS3 Web Interface v2.0.0<br>Copyright 2016 by efeste
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo asset_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/custom.js'); ?>"></script>
  </body>
</html>
