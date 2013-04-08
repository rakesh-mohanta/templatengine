<?php

use Library\Helper\Html as HtmlHelper;

// --------------------------------
// the Boilerplate assets web accessible directory
if (empty($boilerplate_assets)) {
    $boilerplate_assets = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__), '/');
}
if (strlen($boilerplate_assets)) {
    $boilerplate_assets = rtrim($boilerplate_assets, '/').'/';
}

// ------------------
// metas
$old_metas = $_template->getTemplateObject('MetaTag')->get();
$_template->getTemplateObject('MetaTag')->reset();

// => charset and others
$_template->getTemplateObject('MetaTag')
	->add('Content-Type', 'text/html; charset=UTF-8', true)
	->add('X-UA-Compatible', 'IE=edge,chrome=1', true)
	->add('viewport', 'width=device-width');

// => description
if (!empty($meta_description))
{
	$_template->getTemplateObject('MetaTag')
		->add('description', $meta_description);
}
// => keywords
if (!empty($meta_keywords))
{
	$_template->getTemplateObject('MetaTag')
		->add('keywords', $meta_keywords);
}
// => author
if (!empty($author))
{
	$_template->getTemplateObject('MetaTag')
		->add('author', $author);
}
// => generator
if (!empty($app_name) && !empty($app_version))
{
	$_template->getTemplateObject('MetaTag')
		->add('generator', $app_name.(!empty($app_version) ? ' '.$app_version : ''));
}
// => + old ones
$_template->getTemplateObject('MetaTag')->set($old_metas);

// ------------------
// LINKS
$old_links = $_template->getTemplateObject('LinkTag')->get();
$_template->getTemplateObject('LinkTag')->reset();

// => favicon.ico
if (file_exists($assets.'icons/favicon.ico'))
{
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'icon',
			'href'=>$assets.'icons/favicon.ico',
			'type'=>'image/x-icon'
		) )
		->add( array(
			'rel'=>'shortcut icon',
			'href'=>$assets.'icons/favicon.ico',
			'type'=>'image/x-icon'
		) );
}
// => + old ones
$_template->getTemplateObject('LinkTag')->set($old_links);

// ------------------
// TITLE
$old_titles = $_template->getTemplateObject('TitleTag')->get();
$_template->getTemplateObject('TitleTag')->reset();

// => $title
if (!empty($title))
{
	$_template->getTemplateObject('TitleTag')
		->add( $title );
}
// => + old ones
$_template->getTemplateObject('TitleTag')->set($old_titles);
// => meta_title last
if (!empty($meta_title))
{
	$_template->getTemplateObject('TitleTag')
		->add( $meta_title );
}

// --------------------------------
// the content
if (empty($content)) $content = '<p>Test content</p>';

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
<?php
echo
	$_template->getTemplateObject('MetaTag')->write("\n\t\t %s "),
	$_template->getTemplateObject('TitleTag')->write("\n\t\t %s "),
	$_template->getTemplateObject('LinkTag')->write("\n\t\t %s "),
	"\n";
?>
        <link rel="stylesheet" href="<?php echo $boilerplate_assets; ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo $boilerplate_assets; ?>css/main.css">
        <script src="<?php echo $boilerplate_assets; ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<?php foreach($_template->getPageStructure() as $item) : ?>
    <?php if (isset($$item)) : ?>
        <div id="<?php echo HtmlHelper::getId($item); ?>" class="structure-<?php echo $item; ?>">
            <?php echo $$item; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $boilerplate_assets; ?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?php echo $boilerplate_assets; ?>js/plugins.js"></script>
        <script src="<?php echo $boilerplate_assets; ?>js/main.js"></script>

    </body>
</html>