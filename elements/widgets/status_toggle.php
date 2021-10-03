<?php
defined('C5_EXECUTE') or die('Access Denied.');
/*
 * copyright 2021 by https://proto.io/freebies/onoff/
 */
$checked = $status ? ' checked="checked"' : '';
$id = empty($id) ? '' : ' id="' . $id . '"';
$name = empty($name) ? '' : ' name="' . $name . '"';
?>
<div class="ht7-widget onoffswitch">
    <input <?= $checked . $id . $name; ?>
        class="onoffswitch-checkbox"
        tabindex="0"
        type="checkbox"
        />
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
