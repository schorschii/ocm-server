<?php
$SUBVIEW = 1;
require_once(__DIR__.'/../../lib/loader.php');
require_once(__DIR__.'/../session.php');
?>

<div id='homepage'>
	<img src='img/logo.dyn.svg'>
	<p>
		<div class='title'><?php echo LANG['app_name_frontpage']; ?></div>
		<div class='subtitle'><?php echo LANG['app_subtitle']; ?></div>
	</p>
	<p>
		<div class='subtitle2'><?php echo LANG['version'].' '.APP_VERSION; ?></div>
	</p>

	<table class='list fullwidth margintop fixed largepadding'>
		<tr>
			<th class='center' colspan='5'><?php echo LANG['server_overview']; ?></th>
		</tr>
		<tr>
			<td class='center' colspan='2'>
				<?php
				$ncpu = 1;
				if(is_file('/proc/cpuinfo')) {
					$cpuinfo = file_get_contents('/proc/cpuinfo');
					preg_match_all('/^processor/m', $cpuinfo, $matches);
					$ncpu = count($matches[0]);
				}
				$percent = round(sys_getloadavg()[2]/$ncpu*100); echo LANG['cpu_usage'];
				?>
				<span class="progressbar"><span class="progress" style="width:<?php echo $percent; ?>%"></span></span>&nbsp;<?php echo $percent; ?>%
			</td>
			<td></td>
			<td class='center' colspan='2'>
				<?php $percent = round(disk_free_space(PACKAGE_PATH)/disk_total_space(PACKAGE_PATH)*100); echo LANG['disk_space']; ?>
				<span class="progressbar"><span class="progress" style="width:<?php echo $percent; ?>%"></span></span>&nbsp;<?php echo $percent; ?>%
			</td>
		</tr>
		<tr>
			<td class='center'><img src='img/users.dyn.svg'><br><?php echo count($db->getAllDomainuser()).' '.LANG['users']; ?></td>
			<td class='center'><img src='img/computer.dyn.svg'><br><?php echo count($db->getAllComputer()).' '.LANG['computer']; ?></td>
			<td class='center'><img src='img/package.dyn.svg'><br><?php echo count($db->getAllPackage()).' '.LANG['packages']; ?></td>
			<td class='center'><img src='img/job.dyn.svg'><br><?php echo count($db->getAllJobcontainer()).' '.LANG['job_container']; ?></td>
			<td class='center'><img src='img/report.dyn.svg'><br><?php echo count($db->getAllReport()).' '.LANG['reports']; ?></td>
		</tr>
	</table>

	<div class='footer'>
		© Georg Sieber 2020-2021 | <a href='https://github.com/schorschii/oco-server' target='_blank'>OCO-Server auf Github</a>
	</div>
</div>
