<div class="sidebar-wrapper">
	<ul class="sidebar-nav list-unstyled">
		<li>
			<a class="<?php if ($pagename == "dashboard"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/">Dashboard</a>
		</li>
		<li>
			<a class="<?php if ($pagename == "klassen"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/klassenlijst.php">Klassen</a>
		</li>
		<li>
			<a class="<?php if ($pagename == "docenten"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/docent.php">Docenten</a>
		</li>
		<li>
			<a class="<?php if ($pagename == "examens"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/examen.php">Examens</a>
		</li>
		<li>
			<a class="<?php if ($pagename == "resultaten"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/resultaten.php">Resultaten</a>
		</li>
	</ul>
	<ul class="sidebar-nav settings-nav list-unstyled">
		<li>
			<a class="<?php if ($pagename == "settings"){echo "active-nav";}?>" href="<?php echo BASE_URL; ?>admin/settings.php">Settings</a>
		</li>
		<li>
			<a href="<?php echo BASE_URL; ?>includes/logout.php">Uitloggen</a>
		</li>
	</ul>
</div>