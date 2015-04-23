# Async.php
Async Muliti Communication Class.

```php

// Get Instance.
$Async		    = new Async();

// Add ch(url).
$Async->addCh( 'AMZON' ,    $url1 );
$Async->addCh( 'GOOGLE' ,   $url2 );
$Async->addCh( 'APPLE' ,    $url3 );
$Async->addCh( 'TWITTER' ,  $url4 );
$Async->addCh( 'FACEBOOK' , $url5 );

// Async Muliti Communication.
$talk		  = $Async->talk();

// Get Responses.
$response	  = $talk->getResponse( 'AMAZON',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'GOOGLE',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'APPLE',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'TWITTER',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'FACEBOOK',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );

```
