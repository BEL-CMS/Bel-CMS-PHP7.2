<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
 */
$df = disk_free_space(ROOT);
// $ds contient le nombre d'octets du dossier "/"
$ds = disk_total_space(ROOT);
debug(Common::ConvertSize($df));
debug(Common::ConvertSize($ds));
?>