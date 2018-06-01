<?php
require __DIR__ . '/../inc/core.php';

// PUT requests need to be redirected to push.php
if (request_method() === 'PUT') {
    include __DIR__ . '/push.php';
    die();
}

// If this page is not accessed by NuGet, redirect the request to the status page.
if ($_SERVER['HTTP_USER_AGENT'] !== 'Mozilla/5.0 NuGet') {
    header('Location: /status.php', true, 302);
}

header('Content-Type: text/xml; charset=utf-8');
$base_url = url_scheme() . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
echo '<' . "?xml version='1.0' encoding='utf-8' standalone='yes'?>";
echo '
<service xml:base="' . rtrim($base_url, '/') . '"' .
  '
	xmlns:atom="http://www.w3.org/2005/Atom"
  xmlns:app="http://www.w3.org/2007/app"
	xmlns="http://www.w3.org/2007/app">
	<workspace>
	  <atom:title>Default</atom:title>
	  <collection href="Packages">
	    <atom:title>Packages</atom:title>
	  </collection>
	</workspace>
</service>';
