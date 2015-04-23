# Async.php
Async Muliti Communication Class.

// Get Instance.
```php
$async		    = new Async();
```

// Add ch(url).
$async->addCh( 'AMZON' ,    $url1 );
$async->addCh( 'GOOGLE' ,   $url2 );
$async->addCh( 'APPLE' ,    $url3 );
$async->addCh( 'TWITTER' ,  $url4 );
$async->addCh( 'FACEBOOK' , $url5 );

// Async Muliti Communication.
$talk		    = $async->talk();

// Get Responses.
$response	  = $talk->getResponse( 'AMAZON', array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'GOOGLE', array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'APPLE', array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'TWITTER', array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
$response	  = $talk->getResponse( 'FACEBOOK', array( 'str_to_xmlstr', 'xmlstr_to_arr' ) );
