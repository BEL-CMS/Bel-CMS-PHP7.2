			<div id="bel_cms_widgets_connected" class="widget">
				<ul>
					<li>
						<span>Hier</span>
						<span><strong><?=Visitors::getVisitorYesterday()->count?></strong></span>
					</li>
					<li>
						<span>Aujourd'hui</span>
						<span><strong><?=Visitors::getVisitorDay()->count?></strong></span>
					</li>
					<li>
						<span>Maintennant</span>
						<span><strong><?=Visitors::getVisitorConnected()->count?></strong></span>
					</li>
					<li>
						<ul id="getVisitorConnected">
							<?php
							$i = 0;
							foreach (Visitors::getVisitorConnected()->data as $k => $v):
								if (Users::isLogged() === true) {
									$visitor = Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']);
								} else {
									$visitor = VISITOR;
								}
								?>
								<li>
									<span><?=Common::truncate($visitor, 20)?></span>
									<span><?=$v->visitor_page?></span>
								</li>
								<?php
								if ($i++ == 5) {
									break;
								}
							endforeach;
							?>
						</ul>
					</li>
				</ul>
			</div>
