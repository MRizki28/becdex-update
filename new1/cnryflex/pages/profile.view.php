<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('profile', 'My Profile'),
    array('lib/balloon')
);

$get = $core->data->real_escape_string($_COOKIE['idUser']);
if(!$user = mysqli_fetch_assoc($core->data->query("SELECT * FROM tb_users WHERE idUser = '$get'"))){
    $core->toast('warning', 'Data not found!', 'pages/overview');
} ?>

<section id="profile" class="center">
    <div class="block">
        <span class="permission"><?php echo htmlspecialchars($_COOKIE['role']) ?></span><span class="work"><?php echo htmlspecialchars($user['idNo']) ?></span><img src="<?php echo urlFlex ?>assets/img/profile/<?php echo ($user['img']) ? $user['img'] : '00-no-image.png' ?>" alt='Image Profile'><span class="name"><?php echo htmlspecialchars($user['name']) ?></span>

        <span class="addr"><?php echo htmlspecialchars($user['address']) ?></span>

        <div class="contact">
            <a href="mailto:<?php echo $user['email'] ?>" aria-label="<?php echo htmlspecialchars($user['email']) ?>" data-balloon-pos="bottom"><i class="micon">email</i></a>
            <a href="tel:<?php echo $user['phone'] ?>" aria-label="<?php echo htmlspecialchars($user['phone']) ?>" data-balloon-pos="bottom"><i class="micon">phone</i></a>
        </div>

        <a class="edit" href="<?php echo urlFlex ?>pages/profile.edit">Edit Profile</a>
        <a class="logout" href="<?php echo urlFlex ?>pages/logout">Logout</a>
    </div>

<?php $core->close();