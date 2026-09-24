<?php
$flashMessages = Flash::consume();
?>
<script>window.__flashMessages = <?php echo json_encode($flashMessages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;</script>
