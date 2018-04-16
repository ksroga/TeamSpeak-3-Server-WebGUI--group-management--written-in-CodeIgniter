<!DOCTYPE html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
  <head>
    <title><?php echo $title; ?></title>
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
	                 <h1><a href="index.html"><img src="<?php echo asset_url('images/logo.png'); ?>"></a></h1>
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
		  		<div class="col-md-12 panel-info">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Dodaj grupy</div>
		  			</div>
		  			<div class="content-box-large box-with-header">
			  			<?php echo form_open(); ?>
						<div class="panel-body">
		  					<table class="table table-striped">
				              <thead>
				                <tr>
				                  <th>Ikona</th>
				                  <th>Nazwa</th>
				                  <th>Zaznacz</th>
				                </tr>
				              </thead>
				              <tbody>
				                <?php
				                foreach($groups as $group) {
				                	echo '<tr>';
				                	echo '<td>';
				                	if(!empty($group[2])) echo '<img src="'.asset_url('internal/icons/').'icon_'.$group[2].'">';
				                	echo '</td>';
				                	echo '<td>'.$group[1].'</td>';
				                	echo '<td>';
				                	echo form_checkbox($group[0], $group[0], FALSE);
				                	echo '</td>';
				                	echo '</tr>';
				                }
				                ?>
				              </tbody>
				            </table>
				            <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-refresh"></i> Aktualizuj</button>
				            </form>
		  				</div>
					</div>
		  		</div>
		  	</div>

		  </div>
		</div>
    </div>


