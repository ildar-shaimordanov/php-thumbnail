<?php

/**
 *
 * Include the thumbnail library
 *
 */
include_once 'includes/Thumbnail.php';
include_once 'includes/Thumbnail/Control.php';

/**
 *
 * Demo image and it's size
 *
 */
$filename = 'files/image.jpg';
list($maxWidth, $maxHeight) = getimagesize($filename);

/**
 *
 * Minimal sizes of the thumbnail
 *
 */
$minWidth = 150;
$minHeight = 150;

/**
 *
 * Handle the thumbnail creating
 *
 */
if ( @$_GET['show_image'] == 'yes' ) {

    // Options of the thumbnail
    $options = array(
        'request' => 'get',
        'method'  => isset($_GET['method']) ? (int)$_GET['method'] : THUMBNAIL_METHOD_SCALE_MAX,
        'width'   => isset($_GET['width']) && $_GET['width'] >= $minWidth && $_GET['width'] <= $maxWidth ? (int)$_GET['width'] : $minWidth,
        'height'  => isset($_GET['height']) && $_GET['height'] >= $minHeight && $_GET['height'] <= $maxHeight ? (int)$_GET['height'] : $minHeight,
        'percent' => isset($_GET['percent']) && $_GET['percent'] >= 0 && $_GET['percent'] <= 1 ? (float)$_GET['percent'] : 0,
        'halign'  => isset($_GET['halign']) ? $_GET['halign'] : 0,
        'valign'  => isset($_GET['valign']) ? $_GET['valign'] : 0,
    );

    if ( $options['method'] == THUMBNAIL_METHOD_CROP && ( $options['width'] > $minWidth || $options['height'] > $minHeight || $options['percent'] > 0 ) ) {
        // Cascade create of thumbnail over two steps
        $middleImage = Thumbnail::render($filename, $options);
        Thumbnail::output($middleImage);
    } else {
        // Create the thumbnail over one step
        Thumbnail::output($filename, null, $options);
    }

    exit;

}

$title = 'Thumbnails: Theory and practice of thumbnail creation';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title><?=$title?></title>
<style type="text/css"><!--

table.bodyTable	{
	border-collapse: separate;
	border-spacing: 5px;
}
td.bodyTable	{
	border: 1px solid #39c;
}

--></style>
<link rel="stylesheet" href="files/styles.css" type="text/css" />
</head>

<body>

<h1><?=$title?></h1>

<div id="TOC">
<h2>Contents</h2>

<ul>
<li><a href="<?=$_SERVER['SCRIPT_NAME']?>">Start</a>
<li><a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>">Sources</a>
<li><a href="theory.html">Theory</a>
</ul>
</div>

<div id="BODY">

<h2>Interactive Demo</h2>

<table class="bodyTable">
<tr align="center" valign="top">
<td class="bodyTable"><h3>Original<br /><?=$maxWidth?> x <?=$maxHeight?></h3></td>
<td class="bodyTable"><h3>Fixed Thumbnail<br /><?=$minWidth?> x <?=$minHeight?></h3></td>
</tr>

<tr align="center" valign="top">
<td class="bodyTable">

<?

/**
 *
 * Control data are receiving from the GET request
 *
 */
$options = array(
    'request' => 'get',
);

/**
 *
 * Display of the thumbnail control panel
 *
 */
Thumbnail_Control::showCSS();
Thumbnail_Control::showJavascript();
Thumbnail_Control::showHtml($filename, $options);

?>

</td>
<td class="bodyTable" width="<?=$minWidth?>">

<div style="background-color: #ccc; border: 1px solid #000; height: <?=$minHeight?>px; width: <?=$minWidth?>px;"><img src="<?=$_SERVER['REQUEST_URI'] . ( false === strpos($_SERVER['REQUEST_URI'], '?') ? '?' : '&' ) . 'show_image=yes'?>" /></div>

</td>
</tr>
</table>

<div class="CODE">
<?

/**
 *
 * Display itself
 *
 */
highlight_file(__FILE__);

?>
</div>

<div style="padding: 10px; text-align: right;">Last modified at <?=date('Y/m/d')?></div>
</div>

</body>

</html>
