<?php
setcookie("klientLogin", "", time()-3600);
echo <<<_END
<script type="text/javascript">
window.location.href = '../index.php';
</script>
_END;
?>
