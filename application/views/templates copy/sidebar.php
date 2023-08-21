        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->

            <?php
            $role_id = $this->session->userdata('role_id');
            $allowed_roles = [1, 6, 7];
            $dashboard_url = in_array($role_id, $allowed_roles) ? base_url('admin/index') : base_url('user/index');
            ?>

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $dashboard_url ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?= base_url('assets/home/assets/img/logo.png'); ?>" alt="" style="width: 47px;">
                </div>
                <div class="sidebar-brand-text mx-3" style="text-transform: none;">BECdex</div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- QUERY MENU -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                           WHERE `user_access_menu`.`role_id` = $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC
                        ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <!--             <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Profile Admin</span>
                </a>
            </li> -->

            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>

                <!-- SIAPKAN SUB-MENU SESUAI MENU -->
                <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
                <?php foreach ($subMenu as $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <?php $url_without_param = explode('/', $sm['url']); ?>
                        <?php if (!isset($url_without_param[1])) : ?>
                            <?php if (is_numeric($this->uri->segment(3)) || is_string($this->uri->segment(2))) : ?>
                                <a class="nav-link pb-0" href="<?= base_url($sm['url'] . '/index/' . $menuId); ?>">
                                <?php elseif ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) === NULL) : ?>
                                    <a class="nav-link pb-0" href="<?= base_url($sm['url'] . '/index/' . $menuId); ?>">
                                    <?php else : ?>
                                        <a class="nav-link pb-0" href="<?= base_url($sm['url'] . '/' . 'index' . '/' . $menuId); ?>">
                                        <?php endif ?>
                                    <?php else : ?>
                                        <a class="nav-link pb-0" href="<?= base_url($sm['url'] . '/' . $menuId); ?>">
                                        <?php endif ?>
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <span><?= $sm['title']; ?></span></a>
                        </li>
                    <?php endforeach; ?>

                    <hr class="sidebar-divider mt-3">

                <?php endforeach; ?>

                <?php if ($this->session->userdata('role_id') == 1) : ?>
                    <div class="sidebar-heading">
                        Manajemen Hak Akses
                    </div>
                    <li class="nav-item <?php echo ($this->uri->segment(2) == 'admin_audit') ? 'active' : '' ?>">
                        <a class="nav-link pb-0" href="<?= base_url('Menu/admin_audit') ?>">
                            <i class="fas fa-fw fa-key"></i>
                            <span>Admin Audit</span></a>
                    </li>
                    <li class="nav-item <?php echo ($this->uri->segment(2) == 'admin_finance') ? 'active' : '' ?>">
                        <a class="nav-link pb-0" href="<?= base_url('Menu/admin_finance') ?>">
                            <i class="fas fa-fw fa-key"></i>
                            <span>Admin Finance</span></a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End  of Sidebar -->