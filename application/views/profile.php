<!DOCTYPE html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
  <head>
    <title>Profil użytkownika <?php echo $profileInfo['client_nickname']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    
    <!-- styles -->
    <link href="<?php echo asset_url('css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset_url('css/profile.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- profile js -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo asset_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
		$(".btn-pref .btn").click(function () {
    		$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    		// $(".tab").addClass("active"); // instead of this do the below 
    		$(this).removeClass("btn-default").addClass("btn-primary");   
		});
		});
    </script>
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
	                      <li class="dropdown">
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
		  <?php $this->view('groups_menu'); ?>
		  <div class="col-md-10">
		  <div class="row">
		  		<div class="col-md-12">

							    <div class="card hovercard">
							        <div class="card-background">
							            <img class="card-bkimg" alt="" src=<?php echo $profileAvatar; ?> >
							            <!-- http://lorempixel.com/850/280/people/9/ -->
							        </div>
							        <div class="useravatar">
							            <img alt="" src=<?php echo $profileAvatar; ?> >
							        </div>
							        <div class="card-info"> <span class="card-title"><?php echo $profileInfo['client_nickname']; ?></span>

							        </div>
							    </div>
							    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
							        <div class="btn-group" role="group">
							            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
							                <div class="hidden-xs">Informacje</div>
							            </button>
							        </div>
							        <div class="btn-group" role="group">
							            <button type="button" id="guests" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
							                <div class="hidden-xs">Ostatnie odwiedziny</div>
							            </button>
							        </div>
							    </div>

							        <div class="well">
							      <div class="tab-content">
							        <div class="tab-pane fade in active" id="tab1">
							          Id użytkownika: <?php echo $profileInfo['client_database_id']; ?><br><br>
							          Opis użytkownika: <?php echo $profileInfo['client_description']; ?><br><br>
							          Pierwsza wizyta: <?php echo gmdate("d-m-Y H:i:s",$profileInfo['client_created']); ?><br><br>
							          Ostatnio widziany: <?php echo gmdate("d-m-Y H:i:s",$profileInfo['client_lastconnected']); ?><br><br>
							          Ilość połączeń: <?php echo $profileInfo['client_totalconnections']; ?><br><br>
							        </div>
							        <div class="tab-pane fade in" id="tab2">
							          <?php
							          if($visits) {
							          	echo '<div style="width:25%; margin: 0 auto;">Ostatnie odwiedziny:</div><br>';
							          	foreach($visits as $visitor) {
							          		echo '<div style="width:25%; margin: 0 auto;">';
							          		echo '<a href="../profile/'.$visitor['client_database_id'].'"><img src='.$visitor['profileAvatar'].' class="avatar" /> '.$visitor['client_nickname'].'</a> ('.$visitor['date'].')';
							          		echo '<hr></div>';
							          	}
							          } else {
							          	echo '<div class="row">
							          			<div class="col-md-12 panel-danger">
			  										<div class="content-box-header panel-heading">
		  												<div class="panel-title ">Wystąpił błąd</div>
			  										</div>
			  										<div class="content-box-large box-with-header">
			  											Widocznie jeszcze nikt Cię nie odwiedził!
													</div>
		  									  	</div>
		  									  </div>';
							          }
							          ?>
							        </div>
							      </div>
							    </div>
		  		</div>
		  	</div>
		  </div>
		</div>
    </div>

