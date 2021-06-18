<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2021 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Liste des Dons</strong></h2>
		    </div>
			<div class="table-responsive">
				<table class="table table-vcenter table-condensed table-bordered">
				<thead>
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Date de payement</th>
						<th>Montant</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($dons as $key => $value):
						?>
						<tr>
							<td><?=$value->id;?></td>
							<td><?=Users::hashkeyToUsernameAvatar($value->hash_key);?></td>
							<td><?=$value->date;?></td>
							<td><?=$value->montant;?> €</td>
						</tr>
						<?php
					endforeach;
					?>
				</tbody>
				<tfoot>
					<tr>
						<th># ID</th>
						<th>Nom</th>
						<th>Date de payement</th>
						<th>Montant</th>
					</tr>
				</tfoot>
				<tbody>
				</tbody>
			   </table>  
			</div>
		</div>
	</div>
</div>