<?php
$link_current  = $this->vars['current'];
$link_user     = null;
$link_safety   = null;
$link_security = null;
$link_social   = null;
switch ($link_current) {
	case 'user':
		$link_user     = 'class="belcms_btn belcms_btn_blue"';
	break;
	case 'safety':
		$link_safety   = 'class="belcms_btn belcms_btn_blue"';
	break;
	case 'security':
		$link_security = 'class="belcms_btn belcms_btn_blue"';
	break;
	case 'social':
		$link_social   = 'class="belcms_btn belcms_btn_blue"';
	break;
	default:
	
	break;
}
?>
<nav id="belcms_section_user_nav">
	<ul>
		<li>
			<a <?=$link_user?> href="User">Infos Personnel</a>
		</li>
		<li>
			<a <?=$link_safety?> href="User/safety">Confidentialité</a>
		</li>
		<li>
			<a <?=$link_security?> href="User/security">Sécurité</a>
		</li>
		<li>
			<a <?=$link_social?> href="User/social">Liens Social</a>
		</li>
	</ul>
</nav>