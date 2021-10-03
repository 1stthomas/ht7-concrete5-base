<?php
defined('C5_EXECUTE') or die('Access Denied.');

/* @var $item Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\AttributeModel */
$id = $item->getName();
$defs = $item->getDefinitions();
?>
<li class="row">
    <?php
    switch ($defs['type']) {
//    switch ($item['type']) {
        case 'number':
        case 'text':
        case 'boolean':
            ?>
            <div class="styler"></div>
            <div class="col-xs-12 col-sm-6">
                <?php
                View::element(
                        $nsLabelAttribute,
//                        'tools/settings/label',
                        ['id' => $id, 'item' => $item->getLabelModel()],
                        $pkgHandleLabel
                );
                ?>
            </div>
        <?php
    }
    switch ($defs['type']) {
        case 'number':
            $max = '';
            $min = '';
            $step = '';

            if (!empty($defs['attributes'])) {
                $max = empty($defs['attributes']['max']) ? '' : ' max="' . $defs['attributes']['max'] . '"';
                $min = empty($defs['attributes']['min']) ? '' : ' min="' . $defs['attributes']['min'] . '"';
                $step = empty($defs['attributes']['step']) ? '' : ' step="' . $defs['attributes']['step'] . '"';
            }
            ?>
            <div class="col-xs-12 col-sm-6">
                <input
                    class="form-control"
                    data-value-initial="<?= $item->getValueOld(); ?>"
                    id="<?= $id; ?>"<?= $max . $min; ?>
                    name="<?= $id; ?>"<?= $step; ?>
                    type="number"
                    value="<?= $item->getValueOld(); ?>"
                    />
            </div>
            <?php
            break;
        case 'text':
            ?>
            <div class="col-xs-12 col-sm-6">
                <input
                    class="form-control"
                    data-value-initial="<?= $item->getValueOld(); ?>"
                    id="<?= $id; ?>"
                    name="<?= $id; ?>"
                    type="text"
                    value="<?= $item->getValueOld(); ?>"
                    />
            </div>
            <?php
            break;
        case 'boolean':
        default:
            ?>
            <div class="col-xs-12 col-sm-6">
                <input<?= !empty($item->getValueOld()) ? ' checked="checked"' : ''; ?>
                    data-value-initial="<?= empty($item->getValueOld()) ? 0 : 1; ?>"
                    id="<?= $id; ?>"
                    name="<?= $id; ?>"
                    type="checkbox"
                    value="1"
                    />
            </div>
            <?php
            break;
    }
    ?>
</li>

