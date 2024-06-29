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
        <div class="message-error" onclick="this.classList.add('hidden');">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $message ?>
        </div>
    </div>
</div>
<style>
    .message-error{
        padding: 10px;
        background-color: #F1948A;
        border: 1px solid #E74C3C ;
        border-radius: 10px;
    }
</style>
<script>
    function ocultarMensajeFlash(me){
        me.style.display = 'none';
    }
</script>
