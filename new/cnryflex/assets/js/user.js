$(document).ready(function(){
    let cEmail = 'yes'; 
    let cPhone = 'yes'; 
    let cPass  = 'yes';

    $('form.add input[type="email"]').keyup(function(){
        $.ajax({
			type: "POST",
			data: {
                table: 'tb_users',
                field: 'email',
                value: $(this).val()
            },
            url: host + "system/process/user/check",
			success: function(data){
                cEmail = (data == 'no') ? 'no' : 'yes';
                (data == 'no') ? $('.infoEmail').slideDown('fast') : $('.infoEmail').slideUp('fast');
			}
        });
    });

    $('form.add input[name="phone"]').keyup(function(){
        $.ajax({
            type: "POST",
            data: {
                table: 'tb_users',
                field: 'phone',
                value: $(this).val()
            },
            url: host + "system/process/user/check",
            success: function(data){
                cPhone = (data == 'no') ? 'no' : 'yes';
                (data == 'no') ? $('.infoPhone').slideDown('fast') : $('.infoPhone').slideUp('fast');
            }
        });
    });

    $("form input[type='password']").keyup(function(){
        $.ajax({
            type: "POST",
            data: {
                pass1: $("input[name='pass1']").val(),
                pass2: $("input[name='pass2']").val()
            },
            url: host + "system/process/user/pass",
            success: function(data){
                cPass = (data == 'no') ? 'no' : 'yes';
                (data == 'no') ? $('.infoPass').slideDown('fast') : $('.infoPass').slideUp('fast');
            }
        });
    });

    $('form').on('submit', function(e){
        e.stopPropagation();
        if(cEmail != 'yes' && cPhone != 'yes' && cPass != 'yes') return false;
    });

    $(".group-check input[type='checkbox']").each(function(){
        if(!$(this).prop('checked')){
            $(this).parent().find('select').val('');
        }
    });

    $(".group-check input[type='checkbox']").change(function(){
        if(!$(this).prop('checked')){
            $(this).parent().find('select').val('');
        } else {
            $(this).parent().find('select').val('all');
        }
    });

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

    $("select[name='role']").on('change', function(){
        if($(this).val() == 'role-0000000000-00001'){
            swal({title: 'Warning.', text: "The Administrator role has multiple access rights, please be careful if you want to assign this role to users.", icon: 'warning'});
        }
    });
});