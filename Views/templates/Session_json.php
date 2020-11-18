<meta name="csrf-token" content="<?= $token ?>">

<h3>Open Inspect Element > Network > Response</h3>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
	$.ajaxSetup({
	    headers : {
	        'PHPSESSID': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	var url = "<?= $url ?>/session/get_json";
	$.getJSON(url, function(result){
		
	});
</script>