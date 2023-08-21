<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_user', 'User'),
    array('lib/select2', 'lib/balloon'),
    array('lib/select2', 'user')
); ?>

<section class="center">
    <form class="cx-form cx-lg add validate" action="<?php echo urlFlex ?>system/process/user/add" method="POST" enctype="multipart/form-data">
        <?php $core->formTitle ('add', 'Add New User') ?>

        <div class="photo">
            <div class="desc">
                Profile Picture.
                <div class="left">
                    <span aria-label="Format" data-balloon-pos="up"><i class="micon">image</i>PNG, JPG & JPEG.</span><span aria-label="Minimal Size" data-balloon-pos="up"><i class="micon">photo_size_select_large</i>300 x 300 Pixel</span>
                </div>
            </div>

            <label for="theImg" class="profile"><img src="<?php echo urlFlex ?>assets/img/profile/00-no-image.png"></label><input type="file" accept="image/png, image/jpeg" name="profile" id="theImg" class="photo1"/><input id="temporary" disabled>
        </div>

        <div class="obj">
            <label>Name</label>
            <i class="micon">person</i>
            <input type="text" name="name" spellcheck="false" class="with-icon" placeholder="Your full name" autocomplete="off" required/>
        </div>

        <div class="obj two">
            <label>Role</label>
            <i class="micon">next_week</i>
            <select name="role" class="with-icon getSelect2" required>
                <option value="" selected disabled>Select role</option>
                <?php $sql = $core->data->query("SELECT * FROM tb_roles");
                while($data = mysqli_fetch_assoc($sql)){ ?>
                <option value="<?php echo $data['idRole'] ?>"><?php echo $data['name'] ?></option>
                <?php } unset($sql, $data) ?>
            </select>
        </div>

        <div class="obj two">
            <div class='cx-separate'><label>Email Address</label> <i class='micon' style='width: 16px; height: 16px; font-size: 16px' aria-label='Make sure email already used or was created' data-balloon-pos='down'>error</i></div>
            <i class="micon">mail</i>
            <input type="email" name="email" class="with-icon" spellcheck="false" placeholder="Ex: email@example.com" autocomplete="off" required/>

            <div class="info infoEmail">
                <div class="content" style="background: var(--red2)">
                    <span>Email address has been used!</span>
                    <i class="close micon">close</i>
                </div>
            </div>
        </div>

        <div class="obj three">
            <label>Language</label>
            <i class="micon">translate</i>
            <select class="with-icon getSelect2" name="lang" required>
                <option value="" selected disabled>Select Language</option>
                <option value="english">English</option>
                <option value="bahasa">Bahasa</option>
            </select>

            
        </div>

        <div class="obj three">
            <label>Province</label>
            <select id="add_province" class="getSelect2" name="province" required>
                <option value="" selected disabled>SELECT PROVINCE</option>
                <?php $sql = $core->data->query("SELECT * FROM `tb_provinces`");
                while($row = mysqli_fetch_assoc($sql)){ ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php } unset($sql, $row) ?>
            </select>
        </div>

        <div class="obj three">
            <label>City</label>
            <select class="getSelect2" name="city" required>
                <option value="" selected disabled>SELECT CITY</option>
            </select>
        </div>

        <div class="obj">
            <div class="cx-separate"><label>Address</label> <span class="count check-textarea cx-no-margin"></span></div>
            <textarea name="address" class="check" spellcheck="false" placeholder="Your Address" maxlength="250" required check-target="check-textarea"></textarea>
            
        </div>

        <div class="obj three">
            <label>NIK / ID Card</label>
            <i class="micon">chrome_reader_mode</i>
            <input type="text" name="idNo" class="with-icon" spellcheck="false" placeholder="Ex: DPT-001-09-100-25" autocomplete="off"/>
        </div>

        <div class="obj three">
            <label>Phone Number</label>
            <i class="micon">phone_iphone</i>
            <input type="number" name="phone" check="phone" class="with-icon" spellcheck="false" placeholder="Ex : 087871894992" minlength="12" autocomplete="off" required/>

            <div class="info infoPhone">
                <div class="content" style="background: var(--red2)">
                    <span>Phone number has been used!</span>
                    <i class="close micon">close</i>
                </div>
            </div>
        </div>

        <div class="obj three switch">
            <label>Status</label>
            <input type="radio" id="switch1" name="status" value="granted" checked>
            <label class="switch-label first" for="switch1">Granted</label>

            <input type="radio" id="switch2" name="status" value="blocked">
            <label class="switch-label" for="switch2">Blocked</label>
        </div>

        <div class="group">
            <div class="group-title">
                <div class="cx-separate">
                    <div><i class="micon" style="margin-right: 10px">security</i>Privileges</div>
                    <i class="micon" style="cursor: pointer" pop-target="privileges">info</i>
                </div>
            </div>

            <span class="group-desc">Select which pages this user has access to and their actions. This option can only be done by administrators.</span>

            <div class="obj" style="display: flex; align-content: flex-start; flex-wrap: wrap; justify-content: space-between">
                <?php $sql = $core->data->query("SELECT tb_menus.name, tb_menus.idMenu, tb_menus.title, tb_menus.control, tb_privileges.type FROM tb_menus LEFT JOIN tb_privileges ON tb_menus.name = tb_privileges.namePage AND tb_menus.name ORDER BY tb_menus.order");
                while($privil = mysqli_fetch_assoc($sql)){
                    if($privil['control'] == 'y'){ ?>
                    <div class="group-check">
                        <input type="checkbox" name="page[]" id="<?php echo $privil['idMenu'] ?>" value="<?php echo $privil['name'] ?>"><label class="checkbox" for="<?php echo $privil['idMenu'] ?>"><?php echo $privil['title'] ?></label>

                        <select name="type[]">
                            <option value="" selected disabled>Select Type</option><option value="all" <?php echo ($privil['type'] == 'all') ? 'selected' : '' ?>>All</option><option value="edit" <?php echo ($privil['type'] == 'edit') ? 'selected' : '' ?>>Edit</option><option value="read" <?php echo ($privil['type'] == 'read') ? 'selected' : '' ?>>Read</option>
                        </select><br/>
                    </div>
                <?php } else { ?>
                    <input type="hidden" name="page[]" value="<?php echo $privil['name'] ?>"/>
                    <input type="hidden" name="type[]" value="all"/>
                <?php }} ?>
            </div>

            <div pop-wrapper="privileges" class="privileges">
                <div class="center">
                    <div class="content cx-md">
                        <i class="micon" pop-close>close</i>
                        <div class="cx-texts">
                            <span class="title"><i class="micon">security</i>Type Privileges</span>
                            <span class="desc">Only administrators get this access</span>
                            <div class="paragraph">
                                <dl>
                                    <dt>All</dt>
                                    <dd>Users have the ability to view, add, modify and delete data.</dd>

                                    <dt>Edit</dt>
                                    <dd>The user only has the ability to view, add and modify data. Users do not have the ability to delete data.</dd>

                                    <dt>Read</dt>
                                    <dd>The user only has the ability to view the data. The user does not have the ability to modify the data.</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="group">
            <span class="group-title"><i class="micon" style="margin-right: 10px">password</i>Password</span>
            <span class="group-desc" style="width: 100%">set the first password, minimum 8 characters<br/>and make sure you remember it.</span>

            <div class="obj two">
                <div class="cx-separate"><label>New Password</label><span class="count checkPass passToggle" aria-label="Show Password" data-balloon-pos="up" style="margin: 0"></span></div>
                <i class="micon">lock</i><input type="password" name="pass1" class="with-icon check" minlength="8" check-target="checkPass" passToggle placeholder="Your new password" required/>
            </div>

            <div class="obj two">
                <label>Retype Password</label>
                <i class="micon">autorenew</i>
                <input type="password" name="pass2" class="with-icon" minlength="8" placeholder="Retype your password" required/>
                <div class="info infoPass">
                    <div class="content" style="background: var(--red2)">
                        <span>Passwords are not the same!</span>
                        <i class="close micon">close</i>
                    </div>
                </div>
            </div>
        </div>

        <button class="with-cancel" type="submit">Save</button>
        <a class="cancel" onclick="history.back()">Cancel</a>
    </form>

<?php $core->close();