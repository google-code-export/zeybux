<?php
include_once(DOSSIER_SITE_UTILS . "Log.php"); // Définition du level de log
include_once(DOSSIER_SITE_CONFIGURATION . "/LogLevel.php"); // Définition du level de log
?>

<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Logs du zeybux</div>
	<div class="com-center">
		Les Logs sont au niveau :
<?php 
if(LOG_LEVEL === PEAR_LOG_DEBUG) {
	echo "Debug<br/><br/>";
	echo 	"<a href=\"./index.php?m=LogLevel&amp;action=chgLevel&amp;type=info\">
				<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\">Passer au niveau Info</button>
			</a>";
} else if(LOG_LEVEL === PEAR_LOG_INFO) {
	echo "Info<br/><br/>";
	echo 	"<a href=\"./index.php?m=LogLevel&amp;action=chgLevel&amp;type=debug\">
				<button class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\">Passer au niveau Debug</button>
			</a>";
}

$lVersions = array();
$d = dir(DOSSIER_SITE_LOGS);
while (false !== ($entry = $d->read())) {	   
	if(	$entry != '.' && $entry != '..' && $entry != '.svn' && $entry != '.htaccess') {
		if(is_file($d->path.'/'.$entry)) {
			array_push($lVersions,$entry);
   		}
   }
}
$d->close();
rsort($lVersions);
?>
	<br/><br/>
</div>
	<table class="com-table">
		<tr class="ui-widget ui-widget-header" >
			<th class="com-table-th-debut" >Date</th>
			<th class="com-table-th-med td-edt"></th>
			<th class="com-table-th-fin td-edt"></th>
		</tr>
		<?php foreach($lVersions as $lVersion) {?>
		<tr>
			<td class="com-table-td-debut"><?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3]; ?></td>
			<td class="com-table-td-med">
				<a href="./index.php?m=LogLevel&amp;action=getLog&amp;file=<?php echo $lVersion;?>" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Télécharger">
					<span class="ui-icon ui-icon-arrowthick-1-n"></span>
				</a>
			</td>
			<td class="com-table-td-fin">
				<a href="./index.php?m=LogLevel&amp;action=del&amp;file=<?php echo $lVersion;?>" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Supprimer">
					<span class="ui-icon ui-icon-trash"></span>
				</a>
			</td>
		</tr>
		<?php }?>
		
	</table>
</div>