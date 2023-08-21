<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" required class="form-control form-control-user" id="name" name="name" placeholder="Company Name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" required class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control form-control-user" onkeyup="checkPass(); return false;" id="password1" name="password1" placeholder="Password" required>
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Repeat Password</label>
                                    <input type="password" class="form-control form-control-user" onkeyup="checkPass(); return false;" id="password2" name="password2" required placeholder="Repeat Password">
                                </div>
                                <div class="col-sm-12">
                                    <div id="error-nwl"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Country</label>
                                    <select class="form-control" required name="country">
                                        <option value="">Choose</option>
                                        <?php foreach ($country as $data) { ?>
                                            <option value="<?= $data->iso ?>"><?= $data->nicename ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Blue Economic Sectors</label>
                                    <select class="form-control" required name="field">
                                        <option value="">Choose</option>
                                        <?php foreach ($company_field as $data) { ?>
                                            <option value="<?= $data->id_company_field ?>"><?= $data->field_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <input type="text" required class="form-control form-control-user" id="pic_name" name="pic_name" placeholder="PIC Name">
                                        <?= form_error('pic_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" required class="form-control form-control-user" id="pic_position" name="pic_position" placeholder="PIC Position">
                                        <?= form_error('pic_position', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" required class="form-control form-control-user" id="pic_email" name="pic_email" placeholder="PIC Email">
                                        <?= form_error('pic_email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" required class="form-control form-control-user" onclick="setCountry()" id="pic_phone" name="pic_phone" placeholder="PIC Phone">
                                        <?= form_error('pic_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        <span class="text-danger">*</span> Company is responsible for fulfilling Blue Economy Company Index (BECdex) <a href="https://localhost/bcdx/assets/download/63e9c3e84f88b_1676264424_Format_Surat_Pernajnjian_Sertifikasi_MICC.pdf">certification requirements</a>
and willing to provide access to locations or information needed by Maritimepreneur International
Certification Center (MICC) in carrying out certification activities.
                                    </p>
                                    <br>
                                    <center>
                                     <input type="checkbox" name="check" required> Accept
                                    </center>
                                    <br>
                                </div>
                            </div>

                            <button type="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function checkPass()
    {
        var pass1 = document.getElementById('password1');
        var pass2 = document.getElementById('password2');
        var message = document.getElementById('error-nwl');
        var submit = document.getElementById('submit');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        
        if(pass1.value.length > 7)
        {
            pass1.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "";
            submit.disabled = false;
        }
        else
        {
            pass1.style.backgroundColor = badColor;
            message.style.color = badColor;
            submit.disabled = true;
            message.innerHTML = " you have to enter at least 8 digit!"
            return;
        }
      
        if(pass1.value == pass2.value)
        {
            pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "";
            submit.disabled = false;
        }
        else
        {
            pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            submit.disabled = true;
            message.innerHTML = " These passwords don't match"
            return;
        }

        if (pass1.value.search(/[0-9]/) < 0) {
            pass1.style.backgroundColor = badColor;
            message.style.color = badColor;
            submit.disabled = true;
            message.innerHTML = " Your password must contain at least one number.";
            return;
        } else {
            submit.disabled = false;
        }
    }  
</script>