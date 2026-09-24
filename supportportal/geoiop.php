<script type="application/javascript">
	function geoip(json){
		
		// Get country code based on IP
		var country_code = json.country_code;
		
		// Set dynamic values in an object
		var price_obj = {
			prices: {
				GB: '£9.99',
				US: '$12.99',
				CA: '$12.99',
				SA: 'R 119',
				AU: '$14.99',
				NZ: '$14.99',
				NL: '11.99€',
				FR: '11.99€',
				IN: '119 ₹',
				JP: 'JP¥800',
			}
		},
		get_price = price_obj[ 'prices' ][ country_code ];
		
		// Check if we have a price for the visitor's country, if not we'll set a default of $12.99
		if(get_price == null) {
			display_price = '$12.99';
		} else {
			// Else the price does exist is the array
			display_price = get_price;
		}
		
		// Get the element we want to update by class
		var price_elem = document.getElementsByClassName('update_price');
		
		// Update each element on the page that uses this class
		for (var i = 0; i < price_elem.length; i++) {
		  var str = price_elem[i].innerHTML;
		  price_elem[i].innerHTML = display_price;
		}

	}
	</script>
	<script async src="https://get.geojs.io/v1/ip/geo.js"></script>