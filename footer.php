<script>

// Load lazilly the DOM
document.addEventListener("DOMContentLoaded", function() {            
	
	const shareButton = document.getElementById("share-button");
	
	// if browser supports the Web Share API
	if (navigator.share) {
		shareButton.setAttribute("href", "javascript:void(0)");
		
		// add a click event on the share button that share the canonical url of the page or the current page link
		shareButton.addEventListener('click', async () => {
  			let url = document.location.href;
			const canonicalElement = document.querySelector('link[rel=canonical]');
			if (canonicalElement !== null) {
			    url = canonicalElement.href;
			}
  			navigator.share({url: url});
		});
	} else {
	    // change share button href
	    if (shareButton != null) {
	    	shareButton.setAttribute("rel", "nofollow");
	    	shareButton.setAttribute("target", "_blank");
	    	shareButton.href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
	    }
	}
}, false);
</script>
<?php include "inc/cookie-bar.php"; ?>
<?php wp_footer(); ?>
</body>
</html>
