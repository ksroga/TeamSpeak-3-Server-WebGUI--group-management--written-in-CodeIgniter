<div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li <?php if($this->uri->segment(1) == 'main') { echo 'class="current"><a href="#">'; } else { echo '><a href="main">'; } ?><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li <?php if($this->uri->segment(1) == 'online') { echo 'class="current"><a href="#">'; } else { echo '><a href="online">'; } ?><i class="glyphicon glyphicon-user"></i> Aktualnie online</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Grupy
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li <?php if($this->uri->segment(1) == 'groups' && $this->uri->segment(2) == 'add') { echo 'class="current"><a href="#">'; } else { echo '><a href="groups/add">'; } ?>Dodaj grupy</a></li>
                            <li <?php if($this->uri->segment(1) == 'groups' && $this->uri->segment(2) == 'rem') { echo 'class="current"><a href="#">'; } else { echo '><a href="groups/rem">'; } ?>Usuń grupy</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-info-sign"></i> Informacje
                            <span class="caret pull-right"></span>
                         </a>
                         <ul>
                            <li <?php if($this->uri->segment(1) == 'page' && $this->uri->segment(2) == 'rules') { echo 'class="current"><a href="#">'; } else { echo '><a href="page/rules">'; } ?>Regulamin serwera</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>