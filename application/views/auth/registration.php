<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('assets/'); ?>css/style5.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.3/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Register</title>
</head>

<body>
	<section class="h-100 gradient-form"  style="background-image: url(<?php echo base_url('assets/images/b.svg'); ?>)" ;>
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-xl-10">
					<div class="card rounded-3 text-black " >
						<div class="row g-0">
							<div class="col-lg-6">
								<div class="card-body p-md-5 mx-md-4">
								<a href="<?= base_url('home'); ?>" >  <i class="fa-solid fa-arrow-left fs-4 " style="position: absolute; top: 0; left: 0; margin: 1.6rem;"></i></a>
									<div class="text-center" >
										<img src="<?= base_url('assets/images/logo.png'); ?>"data-aos="fade-right" data-aos-delay="600" style="width: 70px;" alt="logo">
										<h4 class="mt-1 mb-2 pb-1" data-aos="fade-right" data-aos-delay="600" >Blue Economy Company</h4>
									</div>
									<form method="post" action="<?= base_url('auth/registration'); ?>" data-aos="fade-right" data-aos-delay="600">
										<p class='text-center'>Registration Form</p>
										<div class="row">
											<div class="col-md-6">
												<div class="form-wrapper">
													<input type="text" required class="form-control mb-2 " id="name" name="name" placeholder="Company Name" >
													<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
												</div>
												<div class="form-wrapper">
													<input type="email" required class="form-control mb-2 " id="email" name="email" placeholder="Email Address" >
													<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
													<i class="zmdi zmdi-account"></i>
												</div>
												<div class="col-sm-12">
													<div id="error-nwl"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-wrapper">
													<select class="form-control mb-2" required name="country">
														<option value="">Country</option>
														<?php foreach ($country as $data) { ?>
															<option value="<?= $data->iso ?>"><?= $data->nicename ?></option>
														<?php } ?>
													</select>
													<i class="zmdi zmdi-lock" style='font-size: 17px'></i>
												</div>
												<div class="form-wrapper">
													<select class="form-control mb-2" required name="field">
														<option value="">Blue Economic Sectors</option>
														<?php foreach ($company_field as $data) { ?>
															<option value="<?= $data->id_company_field ?>"><?= $data->field_name ?></option>
														<?php } ?>
													</select>
													<i class="zmdi zmdi-lock"></i>
												</div>
												
											</div>
											<div class="col-md-12">
									
													<input type="password" class="form-control mb-2" onkeyup="checkPass(); return false;" id="password1" name="password1" placeholder="Password" required>
													<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
													<i class="zmdi zmdi-lock"></i>
											
													<input type="password" class="form-control mb-2" onkeyup="checkPass(); return false;" id="password2" name="password2" required placeholder="Repeat Password">
													<i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
												<input type="text" required class="form-control mb-2" id="pic_name" name="pic_name" placeholder="PIC Name" >
												<?= form_error('pic_name', '<small class="text-danger pl-3">', '</small>'); ?>

												<input type="email" required class="form-control mb-2 " id="pic_email" name="pic_email" placeholder="PIC Email" >
												<?= form_error('pic_email', '<small class="text-danger pl-3">', '</small>'); ?>
												<i class="zmdi zmdi-account"></i>

												<input type="number" required class="form-control mb-2" id="pic_phone" name="pic_phone" placeholder="PIC Phone" >
												<?= form_error('pic_phone', '<small class="text-danger pl-3">', '</small>'); ?>
												<i class="zmdi zmdi-account"></i>

												<input type="pic_position" required class="form-control mb-2 " id="pic_position" name="pic_position" placeholder="PIC Position">
												<?= form_error('pic_position', '<small class="text-danger pl-3">', '</small>'); ?>
												<i class="zmdi zmdi-account"></i>

												<div class="col-sm-12">
													<div id="error-nwl"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<p align="justify">
													<span class="text-danger">*</span> Companies must meet the Blue Economy Company Index (BECdex) <a href="<?= base_url('assets/certification-aggrement/certification-agreement-engglish.pdf')?>" target="_blank">Certification Agreement</a>
													and are willing to provide access or information needed by the Maritimepreneur International Certification Center (MICC) in certification activities.
												</p>

												<center>
													<input type="checkbox" name="check" required class='mb-3'> Accept
												</center>

											</div>
										</div>

									
										<button class="w-100 btn btn-primary mb-2" type="submit" id="submit">Register
											<i class="zmdi zmdi-arrow-right"></i>
										</button>
										
									</form>
									<div class="d-flex align-items-center justify-content-center pb-2">
											<p class="mb-0 me-3 p-2">Already have an account?</p>
											<a href="<?= base_url('auth'); ?>"><button type="button" class="btn btn-outline-primary">Log in</button></a>
										</div>

								</div>
							</div>
							<div class="col-lg-6 d-flex flex-column align-items-center justify-content-center gradient-custom-2 text-center">
								<img data-aos="fade-up" data-aos-delay="600" src="<?= base_url('assets\home\assets\img\bg-home-perahu.png'); ?>" alt="deskripsi-gambar-anda" class="w-50">
								<div class="text-white px-3 py-4 p-md-5 mx-md-4">
									<h4 class="mb-4" data-aos="fade-up" data-aos-delay="600">Become a blue economy company now!</h4>
									<p class="small mb-0" data-aos="fade-up" data-aos-delay="600">Blue Economy Company is a certified company in the maritime sectors, whose business meets 70% or more of 50 indicators of the Blue Economy Company Index (BECdex) to support the achievement of the Sustainable Development Goals (SDGs) in the coastal states.</p>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.3/aos.js" integrity="sha512-mDaCXfIXcUYe10u67E+F0EJkxGpQO5p89McKLAzBu+ZP8Dj3yk72U821aUf+O0xtGqEJodhyExKW/t0h1r9RIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>

    AOS.init();

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

</body>

</html>