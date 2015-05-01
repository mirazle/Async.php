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
$Talk		  = $Async->talk();

// Get Responses.
$Response	  = $Talk->getResponse( 'APPLE',	array( 'xmlstr_to_arr' ) );
$Response	  = $Talk->getResponse( 'TWITTER',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$Response	  = $Talk->getResponse( 'FACEBOOK',	array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );

```
