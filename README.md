# shoutcast-php
Retrieve track artist, title and artwork from a Shoutcast server.

##Config

Before you use shoutcast-php you will need to fill in your <code>config.json</code> file with the correct information.

The shoutcast URL will need to include the port as well, such as <code>http://example.com:8000</code>. Most Shoutcast servers use stream ID 1 as the default so <code>shoutcast_stream</code> is set to that as default.

You will need to register with the [last.fm API](http://last.fm/api) before you begin using shoutcast-php. Once you have done that you can fill in your <code>last_fm_api_key</code> and <code>last_fm_api_secret</code>.

```json
{
	"settings": {
		"shoutcast_url": "",  
		"shoutcast_stream": 1,  
		"last_fm_api_key": "",  
		"last_fm_api_secret": ""  
	}  
}
```

## Usage

After you have done that all you need to do is copy these files to your web server as they are and then access <code>shoutcast.php</code> as you need to do so.

I would recommend using an AJAX call to fetch the output from <code>shoutcast.php</code> once every 5 seconds or so, and then parsing that as you wish.

If everything is working you should see something similar to the following:

```json
{"artist":"Mass Effect","track":"A Rude Awakening","artwork":"https:\/\/lastfm-img2.akamaized.net\/i\/u\/97f596f9dace42b98269627eb35750c1.png"}
```
