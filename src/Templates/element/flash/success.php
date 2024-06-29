<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="" style="padding-top: 10px;">
    <div class="container" >
        <div class="message-info" onclick="ocultarMensajeFlash(this)">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $message ?>
        </div>
    </div>
</div>
<style>
    .message-info{
        padding: 10px;
        background-color: #85C1E9;
        border: 1px solid #3498DB;
        border-radius: 10px;
    }
</style>
<script>
    function ocultarMensajeFlash(me){
        me.style.display = 'none';
    }
</script>
