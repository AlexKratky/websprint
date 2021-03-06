# Custom functions

panx-framework include `panx.php` file (located `/app/classes/panx`) containing special function.

List of special functions:

* `error($code)` - Include template file of specified error and exit() executing of script.
* `redirect($url, $goto)` - Redirects to $url. If is $goto equal to TRUE, saves to session the current URL. If is equal to FALSE, it will not saves anything to session. Otherwise, it will save string passed to session.
* `aliasredirect($alias, $params = null, $get = null, $goto = false)`  - Redirects to alias converted into $url
* `goToPrevious()` - Redirect to previous url (Saved from redirect() with parameter $goto equal to true) or return false if there is not any previous url.
* `d($var, $should_exit = true, $var_name_manual = null)` - Dump a variable $var and exit exceuting of script if $should_exit is equals to true.
* `json($json)` - Indents a flat JSON string to make it more human-readable.
* `html()` - beautify the outputed HTML using Tidy extension, currently should not be used.
* `__($key, $default = false, $replacement = array(), $returnKeyOnFailure = true, $keyFormat = "__%s")` - Function to obtain translation of $key. The language is specified in .config. The $defualt determine, if the translation is located in default language files (useful in updates, so translation will not be overwritten). Return the translation string of false (or the key in $keyFormat). Also, you can use %s in string which will be replaced by the $replacment value (1:1).
* `_ga()` - Prints the JS code with GoogleAnalytics. You need specife the UA code in config.

### Usage

You can use all these function from yours templates files, just by calling them without any prefix, for example:

```php
$is_user_logged_in = false;
if(!$is_user_logged_in)
	error("USER_NOT_LOGGED_IN");
```

> When you are using error() function, don't forget to include route for error file, e.g. Route::setError("USER_NOT_LOGGED_IN", "errors/not_logged_in.php");