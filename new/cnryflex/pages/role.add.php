<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(array('p_role', 'Role')) ?>

<section class="center">
    <form class="add validate cx-form cx-xs" action="<?php echo urlFlex ?>system/process/role/add" method="POST">
        <?php $core->formTitle('add', 'Add New Role') ?>

        <div class="obj">
            <label>Name</label>
            <i class="micon">more_horiz</i>
            <input type="text" name="name" class="with-icon" maxlength="150" spellcheck="false" placeholder="Role name" required/>
        </div>

        <div class="obj">
            <div class="cx-separate"><label>Description</label> <span class="count check-textarea cx-no-margin"></span></div>
            <textarea name="desc" class="check" maxlength="250" spellcheck="false" placeholder="Role description" check-target="check-textarea"></textarea>
        </div>

        <button type="submit" class="with-cancel">Save</button>
        <a class="cancel" onclick="history.back()">Cancel</a>
    </form>

<?php $core->close();