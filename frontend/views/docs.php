<?php
$SUBVIEW = 1;
require_once('../../loader.inc.php');
require_once('../session.php');

const DOCS_DIR = __DIR__.'/../../docs';

$fileName = 'README.md';
if(!empty($_GET['page']) && in_array($_GET['page'], scandir(DOCS_DIR)))
	$fileName = $_GET['page'];

if(file_exists(DOCS_DIR.'/'.$fileName)) {
	$Parsedown = new Parsedown();
	$content = file_get_contents(DOCS_DIR.'/'.$fileName);
	if(empty($content)) die("<div class='alert error'>".LANG('not_found')."</div>");
	$html = $Parsedown->text($content);

	$dom = new DOMDocument;
	@$dom->loadHTML('<?xml encoding="utf-8" ?>'.$html);
	// link adjustments
	$nodes = $dom->getElementsByTagName('a');
	foreach($nodes as $node) {
		$attr = $node->getAttribute('href');
		if(!empty($attr)) {
			if(startsWith($attr, 'https://github.com/')) continue;
			$node->setAttribute('href', 'index.php?view=docs&page='.urlencode($attr));
		}
	}
	// image adjustments
	$nodes = $dom->getElementsByTagName('img');
	foreach($nodes as $node) {
		$attr = $node->getAttribute('src');
		if(!empty($attr)) {
			$base64 = base64_encode(file_get_contents(DOCS_DIR.'/'.$node->getAttribute('src')));
			$node->setAttribute('src', 'data:image/png;base64,'.$base64);
		}
	}
	echo $dom->saveHTML();
} else {
	echo "<div class='alert error'>".LANG('not_found')."</div>";
}
