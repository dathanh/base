<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<input id="cake-message" type="hidden" value="<?= $message ?>">
<input id="cake-message-type" type="hidden" value="error">