		<div class="row">
			  <div class="col-md-6 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Informations <small>Confidentiel</small></h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					<br />
					<form action="/registration/sendPrivate/<?=$user->id?>?management&page&parameter=true" method="post" class="form-horizontal form-label-left">

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input value="<?=$user->username?>" type="text" class="form-control has-feedback-left" placeholder="userName" readonly="readonly">
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input name="email" value="<?=$user->email?>" type="email" class="form-control" id="inputSuccess3" placeholder="email">
						<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input value="<?=$user->ip?>" type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="IP" readonly="readonly">
						<span class="fas fa-at form-control-feedback left" aria-hidden="true"></span>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control" readonly="readonly" id="inputSuccess5" value="<?=$user->hash_key?>">
						<span class="fas fa-key form-control-feedback right" aria-hidden="true"></span>
					  </div><div class="clearfix"></div>
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Submit</button>
					  </div>

					</form>
				  </div>
				</div>

				<div class="x_panel">
				  <div class="x_title">
					<h2>Gestions du groupe <small>Principale</small></h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					<form action="/registration/sendMainGroup?management&page&parameter=true" method="post" class="form-horizontal form-label-left">
					  <div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <select name="main" class="select2_single form-control" tabindex="-1">
						  <?php
						  foreach (Secures::getGroups() as $key => $value):
							$title = defined(strtoupper($value)) ? constant(strtoupper($value)) : $value;
							$main_groups = $key == $user->main_groups ? 'selected="selected"': '';
							?>
							<option <?=$main_groups?> value="<?=$key?>"><?=$title?></option>
							<?php
						  endforeach;
						  ?>  
						  </select>
						</div>
					  </div>
				   </div>
				   <div class="clearfix"></div>
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Submit</button>
					  </div>
					</form>
				</div>

				<div class="x_panel">
				  <div class="x_title">
					<h2>Gestions des groupes <small>Secondaire</small></h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					<form action="/registration/sendSecondGroup?management&page&parameter=true" method="post" class="form-horizontal form-label-left">
					  <div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <?php
						  foreach (Secures::getGroups() as $key => $value):
							$title = defined(strtoupper($value)) ? constant(strtoupper($value)) : $value;
							$groups = explode('|', $user->groups);
							if (in_array($key, $groups)) {
								$groups = 'checked="checked"';
							} else {
								$groups = '';
							}
							$groupsuser = $key == 2 ? 'checked="checked" readonly=""': ''; 
							?>
							<div>
							  <label>
								<input value="<?=$key?>" name="second[]" type="checkbox" class="js-switch" <?=$groups?> <?=$groupsuser?>> <?=$title?>
							  </label>
							</div>
							<?php
						  endforeach;
						  ?>  
						</div>
					  </div>
					   
				  </div>
					  <div class="clearfix"></div>
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Submit</button>
					  </div>
					</form>
				</div>

				<div class="x_panel">
				  <div class="x_title">
					<h2>Gestion Social</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					<form action="/registration/sendSocial?management&page&parameter=true" method="post" class="form-horizontal form-label-left">
					<?php
					foreach ($social as $key => $value) {
					  if ($key != 'id' && $key != 'hash_key'):
					  ?>
					  <label for="<?=$key?>"><?=$key?> :</label>
					  <input type="text" id="<?=$key?>" class="form-control" name="<?=$key?>" value="<?=$value?>">
					  <?php
					  endif;
					}
					?>
					  <div class="clearfix"></div>
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Submit</button>
					  </div>
					</form>
				  </div>
				</div>


			  </div>

			  <div class="col-md-6 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Information <small>public</small></h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					<form action="/registration/sendInfoPublic?management&page&parameter=true" method="post" class="form-horizontal form-label-left">

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<?php
						$profil->birthday = Common::DatetimeSQL($profil->birthday, false, 'Y-m-d');
						?>
						<input id="birthday" class="form-control" type="date" name="birthday" value="<?=$profil->birthday?>">
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input name="public_mail" value="<?=$profil->public_mail?>" type="email" class="form-control" id="inputSuccess3" placeholder="public email">
						<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<select name="gender" class="form-control">
						  <?php
						  if ($profil->gender == 'male') {
							$male      = 'selected="selected"';
							$female    = null;
							$unisexual = null;
						  } elseif ($profil->gender == 'female') {
							$female    = 'selected="selected"';
							$male      =  null;
							$unisexual = null;
						  } elseif ($profil->gender == 'unisexual') {
							$unisexual =' selected="selected"';
							$male      = null;
							$female    = null;
						  }
						  ?>
						  <option <?=$unisexual?> value="unisexual">Non spécifié</option>
						  <option <?=$male?> value="male">Homme</option>
						  <option <?=$female?> value="female">Femme</option>
						</select>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<select name="country" class="form-control">
						  <?php
						  foreach (Common::contryList() as $k => $v):
							$selected = $profil->country == $v ? 'selected="selected"' : '';
							echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
						  endforeach;
						  ?>
						</select>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input name="websites" value="<?=$profil->websites?>" type="url" class="form-control" placeholder="https://">
						<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
					  </div>

					  <div class="clearfix"></div>
					  <div class="ln_solid"></div>
					  <div class="form-group">
						  <button type="submit" class="btn btn-success">Submit</button>
					  </div>

					</form>
				  </div>
				</div>
			  </div>

			</div>