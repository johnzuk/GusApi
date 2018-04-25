# UPGRADE FROM 3.x to 4.0

Creating the client
-------------------
Before:
```php
$gus = new GusApi(
    'abcde12345abcde12345',
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL,
        RegonConstantsInterface::BASE_WSDL_ADDRESS
    )
);
```

After:
```php
$gus = new GusApi(
    'abcde12345abcde12345',
    'prod' // or 'dev'
);
```

Calling API methods
-------------------
The GusApi class now handles the session so you don't need to pass SID to every method.
Remember

Before:
```php
$sessionId = $gus->login(); // returns SID on success
$gusReports = $gus->getByNip($sessionId, '7740001454');
```

After:
```php
$loggedIn = $gus->login(); // returns true on success
$gusReports = $gus->getByNip('7740001454');

// You can still fetch SID by calling:
$sessionId = $gus->getSessionId();
```
