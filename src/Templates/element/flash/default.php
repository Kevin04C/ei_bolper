<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="section" style="padding-bottom: 0;">
    <div class="container" >
        <div class="message-info" onclick="this.classList.add('hidden');">
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

