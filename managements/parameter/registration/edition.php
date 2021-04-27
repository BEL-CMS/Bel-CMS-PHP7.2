<div class="row">
    <div class="col-md-6">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2><strong>Informations</strong> Confidentiel</h2>
            </div>
            <!-- END Form Elements Title -->

            <!-- Basic Form Elements Content -->
       		<form action="/registration/sendPrivate/<?=$user->id?>?management&page&parameter=true" enctype="multipart/form-data" method="post" class="form-horizontal form-bordered">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess1"><?=NAME?></label>
                    <div class="col-md-9">
                        <input value="<?=$user->username?>" id="inputSuccess1" type="text" class="form-control" placeholder="userName" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess2">E-mail Privé</label>
                    <div class="col-md-9">
                     	<input name="email" value="<?=$user->email?>" type="email" class="form-control" id="inputSuccess2" placeholder="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess3">IP Utilisateur</label>
                    <div class="col-md-9">
                        <input value="<?=$user->ip?>" type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="IP" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess4">HashKey</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" readonly="readonly" id="inputSuccess4" value="<?=$user->hash_key?>">
                    </div>
                </div>
                <input type="hidden" name="hash_key" value="<?=$user->hash_key;?>">
				<div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
            <!-- END Basic Form Elements Content -->
        </div>
        <div class="block">
            <!-- Horizontal Form Title -->
            <div class="block-title">
                <h2><strong>Information</strong> public</h2>
            </div>
       		<form action="/registration/sendInfoPublic?management&page&parameter=true" enctype="multipart/form-data" method="post" class="form-horizontal form-bordered">
       			<?php
				$profil->birthday = Common::DatetimeSQL($profil->birthday, false, 'Y-m-d');
				?>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess1">Anniversaire</label>
                    <div class="col-md-9">
                        <input id="birthday" class="form-control" type="date" name="birthday" value="<?=$profil->birthday?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess2">Public email</label>
                    <div class="col-md-9">
                     	<input name="public_mail" value="<?=$profil->public_mail?>" type="email" class="form-control" id="inputSuccess3" placeholder="public email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess3">Genre</label>
                    <div class="col-md-9">
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
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess4">Pays</label>
                    <div class="col-md-9">
						<select name="country" class="form-control">
						  <?php
						  foreach (Common::contryList() as $k => $v):
							$selected = $profil->country == $v ? 'selected="selected"' : '';
							echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
						  endforeach;
						  ?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess4">Website</label>
                    <div class="col-md-9">
						<input name="websites" value="<?=$profil->websites?>" type="url" class="form-control" placeholder="https://">
                    </div>
                </div>
                <input type="hidden" name="hash_key" value="<?=$user->hash_key;?>">
				<div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END Basic Form Elements Block -->

    </div>
    <div class="col-md-6">
        <!-- Horizontal Form Block -->
        <div class="block">
            <!-- Horizontal Form Title -->
            <div class="block-title">
                <h2><strong>Gestions du groupe</strong> Principale</h2>
            </div>
            <!-- END Horizontal Form Title -->

            <!-- Horizontal Form Content -->
            <form action="/registration/sendMainGroup?management&page&parameter=true" method="post" class="form-horizontal form-bordered">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputSuccess2">Groupe</label>
                    <div class="col-md-9">
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
                <input type="hidden" name="hash_key" value="<?=$user->hash_key;?>">
				<div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
            <!-- END Horizontal Form Content -->
        </div>
        <!-- END Horizontal Form Block -->

        <!-- Normal Form Block -->
        <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
                <h2><strong>Gestions du groupe</strong> Secondaire</h2>
            </div>
            <!-- END Normal Form Title -->

            <!-- Normal Form Content -->
            <form action="/registration/sendSecondGroup?management&page&parameter=true" method="post" class="form-horizontal form-bordered">
				<?php
				foreach (Secures::getGroups() as $key => $value):
				?>
                <div class="form-group">
                    <?php
					$title  = defined(strtoupper($value)) ? constant(strtoupper($value)) : $value;
					$groups = explode('|', $user->groups);
					if (in_array($key, $groups)) {
						$groups = 'checked="checked"';
					} else {
						$groups = '';
					}
					$groupsuser = $key == 2 ? 'checked="checked" readonly=""': ''; 
					?> 
					<label class="col-md-3 control-label" for="inputSuccess2"><?=$title?></label>
					<div class="col-md-9">
						<input value="<?=$key?>" name="second[]" type="checkbox" <?=$groups?> <?=$groupsuser?>> 
					</div>
            	</div>
                <?php
				endforeach;
				?>
				<input type="hidden" name="hash_key" value="<?=$user->hash_key;?>">
				<div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
            <!-- END Normal Form Content -->
        </div>
        <!-- END Normal Form Block -->

        <!-- Inline Form Block -->
        <div class="block">
            <!-- Inline Form Title -->
            <div class="block-title">
                <h2><strong>Gestion</strong> Social</h2>
            </div>

            <form action="/registration/sendSocial?management&page&parameter=true" method="post" class="form-horizontal form-bordered">
                <div class="form-group">
					<?php
					foreach ($social as $key => $value):
						if ($key != 'id' && $key != 'hash_key'):
						?>
						<div class="form-group">
							<label class="col-md-3 control-label" for="<?=$key?>"><?=$key?></label>
							<div class="col-md-9">
								<input type="text" id="<?=$key?>" class="form-control" name="<?=$key?>" value="<?=$value?>">
							</div>
						</div>
					  	<?php
						endif;
					endforeach;
					?>
				</div>
				<input type="hidden" name="hash_key" value="<?=$user->hash_key;?>">
				<div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
