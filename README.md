# Crosscall

Some PHP-hacks to access data from external servers in JavaScript. These PHP scripts will only serve HTTP-requests from JavaScript using ajax-calls.

## crosscall.php
> Executes a cross-domain call to a given url and returns the response data of that url
> Voert een cross-domain call naar een bepaalde url uit, en geeft de response data van die url in return

This script will only serve HTTP-requests from JavaScript using ajax-calls.

### HTTP POST parameters
*       url			the url to be called
*		postData	[optional] data to be passed to the url via POST method

### Examples
Example using jquery.ajax() function
```javascript
var sendData = {url: 'http://www.example.com'};
$.ajax({
    url: 'crosscall.php',
    data: sendData,
    type: 'POST',
    success: function(data){ console.log(data); } 
});
```
Example using jquery.post() shorthand function
```javascript
var sendData = {url: 'http://www.example.com'};
$.post('crosscall.php', sendData, function(data){ console.log(data); });
```
### Testing if a URL can be parsed
Use the ```tryme/index.html``` to check whether a certain URL can be fetched using the crosscall script.
    TODO: next version will check if the data from fetched URL can be parsed as HTML or XML using jQuery
    
## hotlink.php
> Fetches an image from an external server and returns the image in base64 format

This script is able to fetch images that are hotlink-protected. It was written for educational purposes and should also solely be used for educational purposes.
This script will only serve HTTP-requests from JavaScript using ajax-calls.

### HTTP GET parameters
*       url			the url of the image to be linked

### Examples
Example using jquery.ajax() function
```javascript
var imageURL = 'http://www.example.com/example.jpg';
var imageID = 'theimage';

$(document.body).append('<img id="' + imageID + '">');
$.ajax({
    url: 'hotlink.php?url=' + imageURL,
    success: function(base64data) { $('#'+imageID).attr('src', 'data:image/png;base64,' + base64data);}
});
```
Example using jquery.get() shorthand function
```javascript
var imageURL = 'http://www.example.com/example.jpg';
var imageID = 'theimage';

$(document.body).append('<img id="' + imageID + '">');
$.get('hotlink.php?url=' + imageURL, function(base64data) { $('#'+imageID).attr('src', 'data:image/png;base64,' + base64data);});
```