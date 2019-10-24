// @license magnet:?xt=urn:btih:0b31508aeb0634b347b8270c7bee4d411b5d4109&dn=agpl-3.0.txt

icecast_xsl_address = 'http://127.0.0.1:8000/status-json.xsl';

window.addEventListener('load', function(){
	
	nowplaying = document.getElementById('nowplaying');
	
	XHR = new XMLHttpRequest();
	XHR.open('GET', icecast_xsl_address, true);
	XHR.responseType = 'json';
	XHR.onload = function(){
		if ( XHR.status !== 200 )
			nowplaying.innerHTML = 'Error.';
		else
		{
			icestats = XHR.response.icestats;
			if ( icestats.source !== null )
			{
				nowplaying.innerHTML = icestats.source.title;
			}
		}
	};
	XHR.send();
	
});
