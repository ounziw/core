<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

$uniqid = uniqid('id_');
$fieldset->set_config('field_template', '{field}');
?>

<div class="page line ui-widget" id="<?= $uniqid ?>">
    <?= $fieldset->build_hidden_fields(); ?>
    <div class="unit col c1" style="z-index:99;"></div>
    <div class="unit col c8" style="z-index:99;">
        <div class="line" style="margin-bottom:1em;">
            <table class="fieldset standalone">
                <tr class="title">
                    <th><?= $fieldset->field('media')->label ?></th>
                    <td><?= $fieldset->field('media')->build() ?></td>
                </tr>
                <tr>
                    <th><?= $fieldset->field('media_title')->label ?></th>
                    <td><?= $fieldset->field('media_title')->build() ?></td>
                </tr>
                <tr>
                    <th><?= $fieldset->field('media_file')->label ?></th>
                    <td class="table-field"><?= $fieldset->field('media_file')->build() ?><span> &nbsp; <label><input type="checkbox" data-id="same_title" checked /> <?= __('Generate from title') ?></label></span></td>
                </tr>
                <tr>
                    <th><?= $fieldset->field('media_folder_id')->label ?></th>
                    <td><?= $fieldset->field('media_folder_id')->build() ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
require(
    ['jquery-nos-media-add-form'],
    function($) {
        $(function() {
            $('#<?= $uniqid ?>').nosMediaAddForm();
        });
    });
</script>