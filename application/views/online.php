	  <div class="col-md-10">
		  <div class="row">
		  		<div class="col-md-12">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">Aktualnie online</div>
		  			</div>
		  			<div class="content-box-large box-with-header">
						<div class="panel-body">
		  					<?php
		  					foreach($clients as $client) {
		  						if(strstr($client->client_nickname, 'from [::1]')) $client->client_nickname = 'CCTV';
		  						echo '<div style="width: 33%; height:90px; float:left; margin:auto; font-size:17px;">';
		  						echo '<a href="profile/'.$client->cl_db_id.'"><img src='.$client->client_avatar.' class="avatar"> ';
		  						echo $client->client_nickname;
		  						echo '</a><hr></div>';
		  					}
		  					?>
		  				</div>
					</div>
		  		</div>
		  	</div>

		  </div>
		</div>
    </div>
