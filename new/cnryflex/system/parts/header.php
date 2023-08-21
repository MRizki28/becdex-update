<?php $menu["$set[0]"] = 'active' ?>
</head><body>

    <noscript>
        <style>
            body {
                position: absolute;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                font: 600 18px/1 "Poppins";
                color: #fff;
                background: red;
            }

            #sidebar, header, section {
                display: none
            }
        </style>
        Please enable Javascript to continue using this application!
    </noscript>

    <div id="sidebar">
    	<div class="top">
    		<div class="user">
                <span><?php echo htmlspecialchars($_COOKIE['user'])?></span>
                <br/><?php echo htmlspecialchars($_COOKIE['role']) ?>
            </div>

    		<i class="menu-switch trigger micon">apps</i>
    	</div>

    	<ul class="sidebar-list">
            <?php $visibility = ($_COOKIE['developerMode'] == $_COOKIE['access']) ? 'all' : 'protected'; $sql_parent = $this->data->query("SELECT tb_menus.* FROM tb_menus, tb_privileges WHERE tb_menus.type = 'parent' AND tb_menus.visibility <> '$visibility' AND tb_menus.name = tb_privileges.namePage AND tb_privileges.idUser = '{$_COOKIE['idUser']}' AND tb_menus.sidebar = 'y' ORDER BY tb_menus.order");
            while($parent = mysqli_fetch_assoc($sql_parent)){
                $sql_child = $this->data->query("SELECT tb_menus.* FROM tb_menus, tb_privileges WHERE child_of = '{$parent['name']}' AND tb_menus.name = tb_privileges.namePage AND tb_privileges.idUser = '{$_COOKIE['idUser']}' AND tb_menus.sidebar = 'y' ORDER BY tb_menus.order"); ?>

                <li class="<?php echo (!$sql_child->num_rows && !$parent['url']) ? 'hide' : '' ?>"><a class="<?php echo (isset($menu[$parent['name']])) ? $menu[$parent['name']] : '' ?> parent" ctarget="<?php echo $parent['name'] ?>" href="<?php echo (!empty($parent['url'])) ? urlFlex.$parent['url'] : 'javascript:void(0)' ?>"><i class='micon'><?php echo $parent['icon'] ?></i><?php echo $parent['title'] ?></a>

                    <?php if($sql_child->num_rows){ ?>
                        <ul class="child" cGet="<?php echo $parent['name'] ?>">
                        <?php while($child = mysqli_fetch_assoc($sql_child)){ ?>

                            <li><a class="<?php echo (isset($menu[$child['name']])) ? $menu[$child['name']] : '' ?>" href="<?php echo urlFlex.$child['url'] ?>"><?php echo $child['title'] ?></a></li>

                        <?php } echo '</ul>';
                    } ?>
                </li>
            <?php } ?>
        </ul>

        <span class="sidebar-title menu-switch">Menu.</span>
        <div class="bottom"><b>Attention!</b> all kinds of activities and<br>
        data changes will be recorded.</div>
    	<div class="line menu-switch"></div>
    </div>

    <header>
        <a class="logo" href="javascript:void(0)"><img src="<?php echo urlFlex ?>assets/img/logo.svg" alt='Cnryflex. Logo'/></a>
        <div class="content">
            <div class="left">
                <div class="title"><a href="javascript:void(0)" aria-label='Click to expand title' data-balloon-pos='down'><?php echo $set[1], '.</a> ';
                    if($_COOKIE['developerMode'] == $_COOKIE['access']){ ?>
                    <span class='dm'>Developer Mode</span>
                    <script>
                        document.querySelector("header .title .dm").addEventListener('click', function(){
                            let xhr = new XMLHttpRequest();
                            xhr.open('POST', host + 'system/process/developer/turnOff');
                            xhr.send();

                            xhr.onload = () => {
                                window.location.reload();
                            }
                        });
                    </script>
                <?php } ?></div>
            </div>

            <div class="right">
                <?php $sql = $this->data->query("SELECT tb_menus.url, tb_menus.title FROM tb_menus, tb_privileges WHERE tb_menus.searchbar = 'y' AND tb_menus.name = tb_privileges.namePage AND tb_privileges.idUser = '{$_COOKIE['idUser']}'");
                if($sql->num_rows){ ?>
                <div class="searchbar">
                    <form action="" method="POST">
                        <select name="page" required>
                            <?php while($data = mysqli_fetch_assoc($sql)){ ?>
                                <option value="<?php echo $data['url'] ?>"><?php echo $data['title'] ?></option>
                            <?php } unset($sql, $data); ?>
                        </select>
                        <input type="text" name="keyword" spellcheck="false" placeholder="The keyword" required/>
                        <button type="submit"><i class="micon">search</i></button>
                    </form>

                    <script>
                        $('.searchbar form').on('submit', function(e){
                            e.stopPropagation();
                            var page = $("select[name='page']").val();
                            var data = $("input[name='keyword']").val();
                            var dirc = host + page + '/' + data;
                            $(this).attr('action', dirc);
                            $(this).submit();
                        });
                    </script>
                </div>
                <?php } ?>

                <div class="notification">
                    <i class="bell micon" aria-label='Notification' data-balloon-pos='down'>notifications</i>
                    <span class="number"></span>
                    <div class="list">
                        <div class="filled"></div>
                        <div class="empty">
                            <i class="micon">upcoming</i>
                            <span class="title">No New Notifications</span>
                            <span class="desc">No new notifications at this time. Click the button below to view previous notifications.</span>
                        </div>
                        <div class='bottom'>
                            <a class="more" href="<?php echo urlFlex, 'pages/notif.list' ?>">See All Notifications</a>
                            <i class='micon' clear-notification>clear_all</i>
                        </div>
                    </div>
                </div>

                <a href="<?php echo urlFlex ?>pages/logout" class="logout"><i class="micon">power_settings_new</i>Logout</a><i class="menu-switch trigger micon">sort</i>

                <div id="toast">
                    <div class="center">
                        <div class='report'>
                            <i class='micon'></i><span></span>
                            <a href='javascript:void(0)'>Close</a>
                        </div>
                    </div>
                </div>

                <div pop-wrapper="notif">
                    <div class="center">
                        <div class="content cx-sm">
                            <i class="micon" pop-close>close</i>
                            <div class="cx-texts">
                                <span class="title"></span>
                                <span class="desc"></span>
                                <div class="paragraph"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).on('click', '.notification .filled a[pop-target="notif"]', function(){
                        notificationPopUp($(this).attr('id-notif'));
                    });
                </script>
            </div>
        </div>
    </header>

    <div pop-wrapper="version">
        <div class="center">
            <div class="content cx-xs" style="padding: 20px; border: none">
                <i class="micon" pop-close>close</i>
                <div class="cx-texts">
                    <span class="title">Release Notes</span>
                    <span class="desc">Version 1.0.0 (November 11, 2021)</span>
                    <span class="paragraph">
                        <ul style="margin: 0; padding-left: 20px; font: 300 11px/1.9 'Poppins'">
                            <li>Tables
                                <ul>
                                    <li>Thumbnail Preview</li>
                                    <li>Magnify on Thumbnail Preview</li>
                                </ul>
                            </li>
                            <li>Progressive Web Apps
                                <ul>
                                    <li>Manifest Icons</li>
                                    <li>Offline Page (Callback)</li>
                                    <li>Store Table Data in localStorage (For Offline Mode)</li>
                                </ul>
                            </li>
                            <li>Notifications</li>
                            <li>Send Notification/Message to Other User</li>
                            <li>Maintenance Switch in Setting Page</li>
                            <li>Feedback Form</li>
                            <li>Redesign Alert</li>
                            <li>Overview Layout</li>
                            <li>MySQL Privileges</li>
                        </ul>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="cx-feedback">
        <form class="validate cx-form" action="" method="POST">
            <div class="top">
                <span class="title">Send Feedback to Conary.</span>
                <span class="desc">Please complete the following form and help us improve our customer experience.</span>
            </div>

            <div class="obj">
                <label>URL</label>
                <i class="micon">link</i>
                <input type="text" name="url" class="with-icon" maxlength="150" spellcheck="false" placeholder="Current page URL" required readonly/>
            </div>

            <div class="obj">
                <label>Email</label>
                <i class="micon">email</i>
                <input type="email" name="email" class="with-icon" maxlength="150" spellcheck="false" placeholder="Your email" value="<?php echo $_COOKIE['email'] ?>" required readonly/>
            </div>

            <div class="obj">
                <label>
                    <div class="cx-separate">Issue <span class="check-fb-textarea cx-no-margin"></span></div>
                </label>
                <textarea name="message" class="check" check-target="check-fb-textarea" maxlength="300" spellcheck="false" placeholder="Describe the issue in detail" style="resize: none" required></textarea>
            </div>

            <div class="disclaimer">The data sent also includes your user ID and full name. We will respond to this message via your email listed in the form above. thanks</div>

            <input type="hidden" name="clientId" value="<?php echo $_COOKIE['clientId'] ?>"/>
            <input type="hidden" name="fullname" value="<?php echo $_COOKIE['user'] ?>"/>
            <input type="hidden" name="idUser" value="<?php echo $_COOKIE['idUser'] ?>"/>
            <input type="hidden" name="idRole" value="<?php echo $_COOKIE['idRole'] ?>"/>
            <input type="hidden" name="token" value="<?php echo hash('ripemd256', $_COOKIE['email'].crc32($_COOKIE['idUser'].$_COOKIE['idRole']).$_COOKIE['clientId']); ?>"/>

            <button type="submit" class="with-cancel">Submit</button>
            <a href="javascript:void(0)" class="cancel" close-feedback>Cancel</a>
        </form>
    </div>

    <script>
        $(".cx-feedback input[name='url']").val(window.location.href);
        $(".cx-feedback form").on('submit', function(e){
            e.stopPropagation();
            $.ajax({
                type: 'POST',
                url: "https://conary.id/feedback",
                data: {
                    idUser: $("input[name='idUser']").val(),
                    idRole: $("input[name='idRole']").val(),
                    name: $("input[name='fullname']").val(),
                    url: $("input[name='url']").val(),
                    email: $("input[name='email']").val(),
                    message: $("textarea[name='message']").val(),
                    clientId: $("input[name='clientId']").val(),
                    token: $("input[name='token']").val()  
                },
                success: function(data){
                    if(data == 'success'){
                        $(".cx-feedback").slideUp('fast');
                        $(".cx-feedback textarea").val('');
                        toast('success', 'Feedback has been successfully sent!');
                    } else {
                        toast('warning', 'Feedback failed to send!');
                    }
                }
            });
            return false;
        });
    </script>