# Async.php
Async Muliti Communication Class.

```php
// Get Instance.
$Async		    = new Async();

// Add ch(url).
$Async->addCh( 'APPLE' ,    $url1 );
$Async->addCh( 'TWITTER' ,  $url2 );
$Async->addCh( 'FACEBOOK' , $url3 );

// Async Muliti Communication.
$talk		  = $Async->talk();

// Get Responses.
$response	  = $talk->getResponse( 'APPLE',	array( 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'TWITTER',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'FACEBOOK',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );

```
