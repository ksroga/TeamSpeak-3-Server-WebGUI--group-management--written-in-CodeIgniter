


		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title"><img src=<?php echo $avatar; ?> class="avatar"> Witaj<b><?php if($client) echo " <a href=profile/".$client['client_database_id'].">".$client['client_nickname']."</a>" ?></b>!</div>
						</div>
		  				<div class="panel-body"><hr>
		  					<?php if($client['client_database_id']) { ?>
		  					Oto twoje statystyki:<br>
		  					<ul>
		  					<li>Twoje UID: <?php  echo $client['client_unique_identifier']; ?></li>
		  					<li>Korzystasz z wersji <?php echo $client['client_version']; ?></li>
		  					<li>Ostatni raz zalogowałeś się <?php echo gmdate("d-m-Y", $client['client_lastconnected']); ?></li>
		  					<li>Pierwszy raz odwiedziłeś nas <?php echo gmdate("d-m-Y", $client['client_created']); ?></li>
		  					</ul>
							<?php } else { ?>
							Znajdujesz się w panelu serwera głosowego TeamSpeak3.<br><br>
							Nie jesteś aktualnie połączony z serwerem.<br>
							Aby to zrobić, <a href="ts3server://fr00st.pl?port=9987">kliknij tutaj</a>.<br><br>

							Od ponad dwóch lat świadczymy najlepsze usługi naszym użytkownikom. Przekonaj się sam i dołącz do społeczności naszych użytkowników, którzy są zadowoleni!
							<?php } ?>
		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Najświeższy News</div>								
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				Wersja nowego panelu v2.0 została opublikowana.
					  			
								<br /><br />
							</div>
		  				</div>
		  			</div>
		  			
		  		</div>
		  	</div>

		  	<div class="row">
		  		<div class="col-md-12 panel-warning">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Ostatnie zmiany</div>
		  			</div>
		  			<div class="content-box-large box-with-header">
			  			<?php echo $news; ?>
						<br /><br />
					</div>
		  		</div>
		  	</div>

		  </div>
		</div>
    </div>

