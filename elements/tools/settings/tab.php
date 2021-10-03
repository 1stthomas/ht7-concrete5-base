<?php
defined('C5_EXECUTE') or die('Access Denied.');

//echo "<pre>";
//print_r($items);
//echo "</pre>";
////return;
?>
<ul class="ht7-settings-list">
    <?php
    foreach ($items as $id => $item) {
        switch ($item['type']) {
            case 'number':
                ?>
                <li class="row">
                    <div class="styler"></div>
                    <div class="col-xs-12 col-sm-6">
                        <?php
                        View::element(
                                'tools/settings/label',
                                ['id' => $id, 'item' => $item],
                                $pkgHandle
                        );
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input
                            class="form-control"
                            data-value-initial="<?= $item['value']; ?>"
                            id="<?= $id; ?>"
                            max="<?= !empty($item['attributes']) && !empty($item['attributes']['max']) ? $item['attributes']['max'] : ''; ?>"
                            min="<?= !empty($item['attributes']) && !empty($item['attributes']['min']) ? $item['attributes']['min'] : ''; ?>"
                            name="<?= $id; ?>"
                            step="<?= !empty($item['attributes']) && !empty($item['attributes']['step']) ? $item['attributes']['step'] : ''; ?>"
                            type="number"
                            value="<?= $item['value']; ?>"
                            />
                    </div>
                </li>
                <?php
                break;
            case 'text':
                ?>
                <li class="row">
                    <div class="styler"></div>
                    <div class="col-xs-12 col-sm-6">
                        <?php
                        View::element(
                                'tools/settings/label',
                                ['id' => $id, 'item' => $item],
                                $pkgHandle
                        );
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input
                            class="form-control"
                            data-value-initial="<?= $item['value']; ?>"
                            id="<?= $id; ?>"
                            name="<?= $id; ?>"
                            type="text"
                            value="<?= $item['value']; ?>"
                            />
                    </div>
                </li>
                <?php
                break;
            case 'boolean':
            default:
                ?>
                <li class="row">
                    <div class="styler"></div>
                    <div class="col-xs-12 col-sm-6">
                        <?php
                        View::element(
                                'tools/settings/label',
                                ['id' => $id, 'item' => $item],
                                $pkgHandle
                        );
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input<?= !empty($item['value']) ? ' checked="checked"' : ''; ?> data-value-initial="<?= empty($item['value']) ? 0 : 1; ?>" id="<?= $id; ?>" name="<?= $id; ?>" type="checkbox" value="1" />
                    </div>
                </li>
                <?php
                break;
        }
    }
    ?>
</ul>
