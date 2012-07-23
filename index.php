<?php
require_once('config.php');
?>
<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php print CLIENT_ID;?>&redirect_uri=<?php print REDIRECT_URI;?>&response_type=code">
connect with Instagram
</a>