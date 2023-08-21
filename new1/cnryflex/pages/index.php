<?php session_start();
if(isset($_POST['purpose']) && $_POST['purpose'] == 'check'){
    echo ($_POST['captcha'] == $_SESSION['captcha']) ? 'yes' : 'no';
    exit(0);
}

require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('public');
$core->open(array('public', 'Login')) ?>

<section id="login" class="full">
    <img class="logo" src="<?php echo urlFlex, 'assets/img/cnryflex.png' ?>"/>

    <form class="cx-form validate" method="POST">
        <h1><i class="micon">meeting_room</i>Welcome.</h1>
        <div class="obj">
            <label>Email Address</label>
            <i class="micon">email</i>
            <input type="email" name="email" class="with-icon" spellcheck="false" autocomplete="off" placeholder="Your email address" required value='admin@becdex.com'/>
        </div>

        <div class="obj">
            <label>Password</label>
            <i class="micon">password</i>
            <input type="password" name="password" class="with-icon" required placeholder="Your password" value='maumasuk123'/>
            <div class="info iLogin">
                <div class="content">
                    <i class="alert micon">warning</i>
                    <span></span><i class="close micon">close</i>
                </div>
            </div>
        </div>

        <div class="captcha">
            <div class="title">
                Captcha <a aria-label="Retype the character on the left to verify that you are not a robot!" data-balloon-length="medium" data-balloon-pos="up" href="javascript:void(0)"><i class="micon">live_help</i></a>
            </div>

            <img class="image" src="<?php echo urlFlex ?>pages/image.php" onclick="resetCaptcha()"/>
            <input type="text" name="captcha" spellcheck="false" autocomplete="off" placeholder="Retype characters" required/>

            <div class="info iCaptcha">
                <div class="content">
                    <i class="alert micon">warning</i>
                    <span></span><i class="close micon">close</i>
                </div>
            </div>
        </div>

        <button type="submit" class="with-help">Submit</button>
        <a href="javascript:void(0)" class="help" pop-target="forgot" data-balloon-pos="down" aria-label="Forgot Password ?"><i class="micon">lock_open</i></a><div class="copy">&copy; <?php echo date("Y"), ' - ', $_COOKIE['company'] ?><br/>all right reserved</div>
    </form>

    <div pop-wrapper="forgot" class="forgot">
        <div class="center free">
            <div class="content cx-sm">
                <i class="micon" pop-close>close</i>
                <div class="cx-texts">
                    <span class="title"><i class="micon">lock_open</i>Forgot Password</span>
                    <span class="desc">Sorry for the inconvenience.</span>
                    <div class="paragraph">For assistance and changing passwords, please contact the administrator via email or the developer if you experience technical and other problems.</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function resetCaptcha(){
            var unique = $.now();
            $('.captcha .image').attr('src', host + 'pages/image.php?' + unique);
            $('.captcha input').val('').trigger('keyup');
        }

        login = () => {
            $.ajax({
                type: "POST",
                data: $("#login form").serialize(),
                url: host + "system/process/user/login",
                success: data => {
                    if(data == 1){
                        window.location.href = host + "pages/overview";
                    } else if (data == 'blocked') {
                        swal({title: 'Blocked.', text: "You can't login because your account is blocked. Contact the administrator for assistance.", icon: 'error'});
                        resetCaptcha();
                        return false;
                    } else {
                        $('.iLogin').slideUp('fast', function(){
                            $(this).slideDown('fast');
                            $('.iLogin .content').attr('class', 'content').css('background', 'var(--red2)')
                            .children('span').html("Your account was not found");
                            resetCaptcha();
                        });
                    }
                }
            });
        }

        $(document).ready(function(){
            let captcha = null;
            $("#login .captcha input").keyup(function(){
                $.ajax({
                    type: 'POST',
                    url: host + "pages/index",
                    data: {
                        purpose: 'check',
                        captcha: $(this).val()
                    },
                    success: data => {
                        captcha = data;
                        $('.iCaptcha').slideDown('fast', function(){
                            (data == 'yes') ? $('.iCaptcha .content').attr('class', 'content').addClass().css('background','var(--green2)').children('span').html("Captcha verification is successful!") : $('.iCaptcha .content').attr('class', 'content').addClass().css('background', 'var(--yellow2)').children('span').html("Invalid captcha characters!");
                        });
                    }
                });
            });

            $("#login form").keypress(function(e){
                if(e.keyCode == 13){
                    if (captcha == 'yes') login();
                    return false;
                }
            });

            $("#login form").on('submit', function(){
                if (captcha == 'yes') login();
                return false;
            });
        });
    </script>

<?php $core->close();