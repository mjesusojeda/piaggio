<?php
	$folderRoot = dirname(__FILE__);
	
	if($_SERVER['HTTP_HOST']=="localhost") {
		$homeRoot = 'http://localhost/piaggio';
	}
	else {
		$homeRoot = 'http://piaggio.herokuapp.com';
	}

	require_once($folderRoot.'/includes/func_url.php');
	require_once($folderRoot.'/includes/defines.php');

	$arrayPath = array();
	if(isset($_SERVER['REQUEST_URI'])) {
		$arrayPath = getVariablesURL($_SERVER['REQUEST_URI']);
	}

	switch($arrayPath[0]){
		case 'de' :
		case 'en' :
		case 'fr' :
		case 'la' : {
			$language = $arrayPath[0];
		}; break;
		default : {
			$language = 'de';
		}; break;
	}
	require_once($folderRoot.'/languages/dictionary_'.$language.'.php');

	switch ($arrayPath[1]) {
		case 'internetshop':
		case 'perlen':
		case 'diamenten':
		case 'farbedelsteine':
		case 'home':
		case 'impressum':
		case 'platin-gold':{
			$actualSection = 'section';
		};
		break;
		default: {
			$actualSection = 'home';
			$actualSection = 'section';
		}
		break;
	}

	if(!file_exists($folderRoot.'/inc/'.$actualSection.'.php')){
		$actualSection = 'home';
	}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="<?=$language?>"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="<?=$language?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="<?=$language?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="<?=$language?>"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>GOLDSCHMIEDE ATELIER PIAGGIO</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name='viewport' content='width=1024,user-scalable=yes'>

	<link rel="stylesheet" href="<?=$homeRoot?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?=$homeRoot?>/stylesheets/piaggio.css">
	<link rel="stylesheet" href="<?=$homeRoot?>/stylesheets/skeleton.css">
	<link rel="stylesheet" href="<?=$homeRoot?>/stylesheets/layout.css">
	<link rel="stylesheet" href="<?=$homeRoot?>/stylesheets/jquery.fancybox.css">

	<link rel="shortcut icon" href="<?=$homeRoot?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?=$homeRoot?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=$homeRoot?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=$homeRoot?>/images/apple-touch-icon-114x114.png">

</head>
<body class="<?=isset($arrayPath[1])? $arrayPath[1] : ''?> <?=isset($arrayPath[2])? $arrayPath[2] : ''?>">
	<div id="wrapper">
		<?php
		include($folderRoot.'/inc/layout/header.php');
		?>
		<div class="container">
			<?php
			include($folderRoot.'/inc/layout/keypad.php');
			?>
			<section class="columns sectionContent eleven right">
				<?php
				include($folderRoot.'/inc/'.$actualSection.'.php');
				?>
			</section>
		</div>
	</div>

	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery.ez-bg-resize.js"></script>
	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="<?=$homeRoot?>/scripts/jquery.jcarousel.min.js"></script>

	<script>
		homeRoot = '<?=$homeRoot?>';
	</script>
	<script src="<?=$homeRoot?>/scripts/functions.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</body>
</html>
