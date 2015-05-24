<?php

if ( @$_GET['show_image'] == 'yes' ) {

    include_once 'includes/Thumbnail.php';

    $filename = 'files/image.jpg';

    // Creating of thumbnail through two steps:
    // Step I
    // 1. PNG image scaled by 50% proportionally
    $options = array(
        'percent' => 0.5,
        'method'  => THUMBNAIL_METHOD_CROP,
    );
    $middleImage = Thumbnail::render($filename, $options);

    // Step II
    // 2. resulting image cropped to PNG image
    // 3. width is below or equal to 150 px
    // 4. height is below or equal to 150 px
    Thumbnail::output($middleImage);

    exit;

}

$title = 'Thumbnails: Theory and practice of thumbnail creation';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" href="files/styles.css" type="text/css" />
<title><?=$title?></title>
</head>

<body>

<h1><?=$title?></h1>

<div id="TOC">
<h2>Contents</h2>

<ul>
<li><a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>">Sources</a>
<li><a href="theory.html">Theory</a>
</ul>
</div>

<div id="BODY">

<h2>Demo 4: Cascade creating of thumbnail through two steps</h2>

<table class="bodyTable">
<tr align="center" valign="top">
<td class="bodyTable"><h3>Original Image<br />JPEG 479 x 600</h3></td>
<td class="bodyTable"><h3>Fixed Thumbnail <br />PNG within 150 x 150</h3></td>
</tr>
<tr align="center" valign="top">
<td class="bodyTable">
<img src="files/image.jpg" />
</td>
<td class="bodyTable">
<div style="background-color: #ccc; border: 1px solid #000; height: 150px; width: 150px;"><img src="<?=$_SERVER['SCRIPT_NAME']?>?show_image=yes" /></div>
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

