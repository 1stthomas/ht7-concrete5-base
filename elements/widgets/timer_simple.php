<?php
defined('C5_EXECUTE') or die('Access Denied.');

$prefix = $prefix === null ? 1 : $prefix;
?>
<div class="ht7-widget-simple-timer" id="ht7-widget-simple-timer-<?= $prefix; ?>">
    <div class="timer-container">
        <div class="timer-outer">
            <div class="bg"></div>
            <div class="time"><?= $default; ?></div>
        </div>
    </div>
<!--    <svg viewBox="0 0 200 200" width="200" height="200">
    <circle class="optcircle" cx="100" cy="100" r="90" fill="white" stroke="hsl(390,85%,60%)" stroke-width="10"></circle>
    <text class="optnumber" x="70" y="130" fill="hsl(390,85%,60%)" font-size="100">0</text>
    </svg>-->
    <script>
        $(function() {
            ht7.widgets.simple.timer.init(<?= $seconds; ?>, '#ht7-widget-simple-timer-<?= $prefix; ?>'<?= $callback ? ', ' . $callback : ''; ?>);
        });
    </script>
</div>
