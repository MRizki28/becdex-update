<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(array('p_role', 'Role'));

$get = $core->data->real_escape_string($_GET['data']);
if(!$main = mysqli_fetch_assoc($core->data->query("SELECT * FROM `tb_roles` WHERE idRole = '$get'"))){
    $core->toast('warning', 'Data not found!', 'pages/role.list');
} ?>

<section class="center">
    <form class="edit validate cx-sm cx-form" action="<?php echo urlFlex ?>system/process/role/edit" method="POST">
        <?php $core->formTitle('edit', 'Edit Role') ?>

        <div class="obj">
            <label>Name</label>
            <i class="micon">more_horiz</i>
            <input type="text" name="name" class="with-icon" maxlength="150" spellcheck="false" placeholder="Role name" required value="<?php echo $main['name'] ?>"/>
        </div>

        <div class="obj">
            <div class="cx-separate"><label>Description</label> <span class="count check-textarea cx-no-margin"></span></div>
            <textarea name="desc" maxlength="250" spellcheck="false" placeholder="Role description" class="check" check-target="check-textarea"><?php echo $main['desc'] ?></textarea>
        </div>

        <input type="hidden" name="idRole" value="<?php echo $main['idRole'] ?>"/>
        <?php $core->modified($main['created'], $main['modified'], $main['idRole']); ?>

        <button type="submit" class="with-cancel">Save</button>
        <a onclick="history.back()" class="cancel">Cancel</a>
    </form>

    <script>
        $(document).ready(function(){
            $('textarea.check').trigger('keyup');
        });
    </script>

<?php $core->close();