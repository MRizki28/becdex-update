<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('protected');
$core->open(array('p_error', 'Error'));

$get = $core->data->real_escape_string($_GET['data']);
if(!$main = mysqli_fetch_assoc($core->data->query("SELECT * FROM `tb_errors` WHERE `idErr` = '$get'"))){
    $core->toast('warning', 'Data not found!', 'pages/error.list');
} ?>

<section class="center">
    <form class="add cx-form cx-sm validate" action="<?php echo urlFlex, 'system/process/error/edit' ?>" method="POST">
        <?php $core->formTitle('edit', 'Edit Error Message') ?>

        <div class="cx-texts obj">
            <span class="title <?php echo 'cx-'.$main['type'] ?>" style="color: #fff; padding: 6px 12px"><?php echo $main['type'] ?></span>
            <span class="desc"><?php echo $main['location'] ?></span>
            <span class="paragraph">Message : <?php echo $main['message'] ?></span>
        </div>

        <div class="group">
            <span class="group-title">User Cookies</span>
            <span class="group-desc" style="margin-bottom: 10px; width: 100%; color: var(--title); overflow: auto"><pre><?php print_r(json_decode($main['user'], true)); ?></pre></span>
        </div>

        <div class="obj switch">
            <label>Solved</label>
            <input type="radio" id="switch1" name="status" value="y" <?php echo ($main['status'] == 'y') ? 'checked' : '' ?>><label class="switch-label first" for="switch1">Solved</label>

            <input type="radio" id="switch2" name="status" value="n" <?php echo ($main['status'] == 'n') ? 'checked' : '' ?>><label class="switch-label" for="switch2">Not Yet</label>
        </div>

        <div class="obj">
            <div class='cx-separate'><label>Description</label><span class='count check-textarea cx-no-margin'></span></div>
            <textarea name="desc" class='check' check-target="check-textarea" maxlength="800" spellcheck="false" placeholder="Description or other information by developer"><?php echo $main['desc'] ?></textarea>
        </div>

        <input type="hidden" name="idErr" value="<?php echo $main['idErr'] ?>"/>
        <?php $core->modified($main['created'], $main['modified'], $main['idErr']) ?>

        <button type="submit" class="with-cancel">Save</button>
        <a href="javascript:void(0)" onclick="history.back()" class="cancel">Cancel</a>
    </form>

<?php $core->close();