<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>RegistrationForm_v1 by Colorlib</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- STYLE CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style4.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style3.css'); ?>">
</head>

<body>
	<div class="wrapper" style="background-image: url(<?php echo base_url('assets/images/background100.jpg'); ?>)" ;>
		<div class="inner">
			<div class="image-holder">
				<img src="<?= base_url('assets/images/registration-form-1.jpg'); ?>" alt="">
			</div>
			<form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
				<h3>Registration Form</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-wrapper">
							<input type="text" required class="form-control " id="name" name="name" placeholder="Company Name" value="<?= set_value('name'); ?>">
							<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-wrapper">
							<input type="email" required class="form-control " id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
							<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
							<i class="zmdi zmdi-account"></i>
						</div>
						<div class="form-wrapper">
							<input type="password" class="form-control" onkeyup="checkPass(); return false;" id="password1" name="password1" placeholder="Password" required>
							<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
							<i class="zmdi zmdi-lock"></i>
						</div>

						<div class="col-sm-12">
							<div id="error-nwl"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-wrapper">
							<select class="form-control" required name="country">
								<option value="">Country</option>
								<?php foreach ($country as $data) { ?>
									<option value="<?= $data->iso ?>"><?= $data->nicename ?></option>
								<?php } ?>
							</select>
							<i class="zmdi zmdi-lock" style='font-size: 17px'></i>
						</div>
						<div class="form-wrapper">
							<select class="form-control" required name="field">
								<option value="">Blue Economic Sectors</option>
								<?php foreach ($company_field as $data) { ?>
									<option value="<?= $data->id_company_field ?>"><?= $data->field_name ?></option>
								<?php } ?>
							</select>
							<i class="zmdi zmdi-lock"></i>
						</div>
						<div class="form-wrapper">
							<input type="password" class="form-control" onkeyup="checkPass(); return false;" id="password2" name="password2" required placeholder="Repeat Password">
							<i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
						</div>
					</div>
					<div class="form-wrapper">
						<div class="form-control">
							<input type="text" required class="form-control " id="pic_name" name="pic_name" placeholder="PIC Name">
							<?= form_error('pic_name', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-wrapper">
						<div class="form-control">
							<input type="text" required class="form-control " id="pic_position" name="pic_position" placeholder="PIC Position">
							<?= form_error('pic_position', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-wrapper">
						<div class="form-control">
							<input type="email" required class="form-control " id="pic_email" name="pic_email" placeholder="PIC Email">
							<?= form_error('pic_email', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-wrapper">
						<div class="form-control">
							<input type="number" required class="form-control" onclick="setCountry()" id="pic_phone" name="pic_phone" placeholder="PIC Phone">
							<?= form_error('pic_phone', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						
						<center>
							<input type="checkbox" name="check" required> Accept
						</center>

					</div>
				</div>

				<button class="w-100" id="submit">Register
					<i class="zmdi zmdi-arrow-right"></i>
				</button>
			</form>
		</div>
	</div>

	<script>
		// // Dapatkan elemen .wrapper
		// const wrapper = document.querySelector('.wrapper');

		// // Tambahkan event listener untuk menjalankan fungsi setelah halaman dimuat
		// window.addEventListener('load', () => {
		// 	// Tambahkan kelas .loaded ke elemen .wrapper
		// 	wrapper.classList.add('loaded');
		// });

		// Ambil elemen loader
		const loader = document.querySelector('.loader');

		// Tampilkan loader
		loader.style.display = 'block';

		// Proses loading

		// Sembunyikan loader
		loader.style.display = 'none';
	</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>