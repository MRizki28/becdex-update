<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('profile', 'Profile'),
    array('lib/select2', 'lib/balloon'),
    array('lib/select2', 'city.edit')
);

$get = $core->data->real_escape_string($_COOKIE['idUser']);
if(!$user = mysqli_fetch_assoc($core->data->query("SELECT * FROM tb_users WHERE idUser = '$get'"))){
    $core->toast('warning', 'User not found!', 'pages/profile.view');
} ?>

<section class="center">
    <form class="cx-form cx-lg validate" action="<?php echo urlFlex ?>system/process/profile/edit" method="POST" enctype="multipart/form-data">
        <?php $core->formTitle('edit', 'Edit My Profile') ?>

        <div class="photo">
            <div class="desc">
                Profile Picture.
                <div class="left">
                    <span aria-label="Format" data-balloon-pos="up"><i class="micon">image</i>PNG, JPG & JPEG.</span><span aria-label="Minimal Size" data-balloon-pos="up"><i class="micon">photo_size_select_large</i>300 x 300 Pixel</span>
                </div>
            </div>
            
            <label for="theImg" class="profile"><img src="<?php echo urlFlex ?>assets/img/profile/<?php echo ($user['img']) ? $user['img'] : '00-no-image.png' ?>"></label><input type="file" accept="image/png, image/jpeg" name="profile" id="theImg" class="photo1"/><input id="temporary" disabled>
        </div>

        <div class="obj two">
            <label>Name</label>
            <input type="text" name="name" spellcheck="false" placeholder="Your full name"  autocomplete="off" value="<?php echo $user['name'] ?>" required/>
        </div>

        <div class="obj two">
            <label>NIK / ID Card</label>
            <i class="micon">chrome_reader_mode</i>
            <input type="text" name="idNo" class="with-icon" spellcheck="false" autocomplete="off" placeholder="Ex: DPT-001-09-100-25" value="<?php echo $user['idNo'] ?>"/>
        </div>

        <div class="obj three">
            <label>Language</label>
            <i class="micon">translate</i>
            <select class="with-icon getSelect2" name="lang" required>
                <option value="" selected disabled>Select Language</option>
                <option value="english" <?php echo ($user['lang'] == 'english') ? 'selected' : '' ?>>English</option>
                <option value="bahasa" <?php echo ($user['lang'] == 'bahasa') ? 'selected' : '' ?>>Bahasa</option>
            </select>
        </div>

        <div class="obj three">
            <label>Province</label>
            <select id="edit_province" class="getSelect2" name="province" required>
                <option value="" selected disabled>Select Province</option>
                <?php $sql = $core->data->query("SELECT * FROM `tb_provinces`");
                while($row = mysqli_fetch_assoc($sql)){
                    if($row['id'] == $user['province']){ ?>
                    <option value="<?php echo $row['id'] ?>" selected><?php echo $row['name'] ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                    <?php }
                } unset($sql, $row) ?>
            </select>
        </div>

        <input type="hidden" id="edit_city" name="id_city" value="<?php echo $user['city'] ?>"/>

        <div class="obj three">
            <label>City</label>
            <select class="getSelect2" name="city" required>
                <option value="" selected disabled>Select City</option>
            </select>
        </div>

        <div class="obj">
            <div class="cx-separate"><label>Address</label> <span class="count check-textarea cx-no-margin"></span></div>
            <textarea name="address" spellcheck="false" placeholder="Address" class="check" maxlength="250" check-target="check-textarea" required><?php echo $user['address'] ?></textarea>
        </div>

        <div class="obj two">
            <label>Email Address</label>
            <i class="micon">mail</i>
            <input type="email" name="email" spellcheck="false" placeholder="Ex: email@example.com" required autocomplete="off" value="<?php echo $user['email'] ?>" class="with-icon"/>
        </div>

        <div class="obj two">
            <label>Phone Number</label>
            <i class="micon">phone_iphone</i>
            <input type="text" name="phone" class="with-icon" spellcheck="false" required autocomplete="off" value="<?php echo $user['phone'] ?>" placeholder="Ex : 87871894990"/>
        </div>

        <div class="group">
            <span class="group-title"><i class="micon">password</i>Change Password</span>
            <span class="group-desc">Optional. Leave each form below blank if you don't want to change your password.</span>

            <div class="obj two group--desc">
                <span>Last Time Change Password</span><span><?php echo (!$user['fgtDate']) ? 'Has never been' : date('d F Y', strtotime($user['fgtDate'])) ?></span>
            </div>

            <div class="obj">
                <label>Old Password</label>
                <i class="micon">vpn_key</i>
                <input type="password" name="passOld" class="with-icon" placeholder="Your old password">
            </div>

            <div class="obj two">
                <div class="cx-separate"><label>New Password</label><span class="count check-pass cx-no-margin passToggle" aria-label="Show Password" data-balloon-pos="up" style="margin: 0"></span></div>
                <i class="micon">lock</i>
                <input type="password" name="passNew1" class="check with-icon" minlength="6" check-target="check-pass" placeholder="Your new password" readonly/>
            </div>

            <div class="obj two">
                <label>Re-type New Password</label>
                <i class="micon">autorenew</i>
                <input type="password" name="passNew2" class="with-icon" minlength="6" placeholder="Retype your password" readonly/>
                <div class="info iPass">
                    <div class="content" style="background: var(--red2)">
                        <span>Password are not the same!</span>
                        <i class="close micon">close</i>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="idUser" value="<?php echo $user['idUser'] ?>"/>
        <?php $core->modified($user['created'], $user['modified'], 'Edit%20Profile') ?>

        <button class="with-cancel" type="submit">Save</button>
        <a class="cancel" onclick="history.back()">Cancel</a>
    </form>

    <script>
        var brand = document.getElementById('theImg');
        brand.className = 'photo1';
        brand.onchange = function(){
            document.getElementById('temporary').value = this.value.substring(12);
        };

        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("label[for='theImg'] img").attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#theImg").change(function(){
            readURL(this);
        });

        $("input[name='passOld']").keyup(function(){
            if($(this).val() != '') {
                let password = 'yes';
                $("input[name='passNew1']").prop('required', true).prop('readonly', false);
                $("input[name='passNew2']").prop('required', true).prop('readonly', false);

                $("form input[type='password']").keyup(function(){
                    let pass1 = $("input[name='passNew1']").val();
                    let pass2 = $("input[name='passNew2']").val();

                    if (pass1.length > 7 && pass2.length > 7) {
                        if (pass1 != pass2) {
                            password = 'no';
                            $('.iPass').slideDown('fast');
                        } else {
                            password = 'yes';
                            $('.iPass').slideUp('fast');
                        }
                    }
                });

                $('form').on('submit', function(e){
                    e.stopPropagation();
                    if (password == 'yes'){
                        nameReq();
                    }
                });
            } else {
                $("input[name='passNew1']").prop('required', false).prop('readonly', true);
                $("input[name='passNew2']").prop('required', false).prop('readonly', true);
            }
        });

        $(document).ready(function(){
            $('textarea.check').trigger('keyup');
        });
    </script>

<?php $core->close();