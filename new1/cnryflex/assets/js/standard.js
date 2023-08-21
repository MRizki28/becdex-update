var slashes = location.protocol.concat("//"); 
var base = slashes.concat(window.location.hostname) + '/';
var host = slashes.concat(window.location.hostname) + '/cnryflex/';
//  Variabel - variabel 'URL' utama aplikasi.

function formatNumber(num){
//  Merubah angka biasa menjadi format ribuan.
    let numNew = ''; let numRev = parseInt(num).toFixed(0).toString().split('').reverse().join(''); for (var i = 0; i < numRev.length; i++) if (i % 3 == 0) numNew += numRev.substr(i, 3) + '.'; return numNew.split('', numNew.length - 1).reverse().join('');
}

function toast(color, message){
//  Menampilkan pesan sementara.
    $('#toast').stop().fadeOut('fast');
    $('#toast .report').addClass('cx-' + color);
    $('#toast .report i').html((color == 'success') ? 'done_all' : 'error_outline');
    $('#toast .report span').html(message);
    $('#toast').fadeIn('fast').delay(6000).fadeOut('fast');
}

function notification(){
//  Daftar & jumlah notifikasi.
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: host + 'system/process/notification/bell',
        success: function(data){
            $('.notification .filled').empty();
            $(".notification .empty").show();

            if(data.length != 0){
                $(".notification .empty").hide();
                $.each(data, function(i, val){
                    $('.notification .filled').prepend(`
                    <a class='item' pop-target='notif' id-notif='` + val.idNotif + `'>
                        <span class='title'>` + val.title + `</span>
                        <div class='desc'>` + val.desc + `</div>
                        <span class='time'>` + moment(val.created).startOf('hour').fromNow() + `</span>
                    </a>`);
                });
                $('.notification .filled').prepend(`<span class="status">Latest</span>`);
            }
        }
    });

    $.ajax({
        type: 'POST',
        url: host + 'system/process/notification/count',
        success: function(data){
            if(data.substr(0, 4) == '<!DO'){
                $('.notification .number').html('Offline');
            } else {
                $('.notification .number').html(data);
                (parseInt(data) == 0) ? 
                $("header .notification").removeClass('red') : $("header .notification").addClass('red');
            }
        }
    });
}

function notificationPopUp(param){
//  Menampilkan detail notifikasi.
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        data: {idNotif: param},
        url: host + 'system/process/notification/get',
        success: function(data){
            $("*[pop-wrapper='notif'] .title").html(data.title);
            $("*[pop-wrapper='notif'] .desc").html(data.date);
            $("*[pop-wrapper='notif'] .paragraph").html(data.desc);
            $("*[pop-wrapper='notif'] .cx-texts > a").remove();

            if(data.href.length != 0){
                $("*[pop-wrapper='notif'] .cx-texts").append("<a class='button' href='" + data.href + "'>See More <i class='micon'>arrow_forward</i></a>");
            }

            $("*[pop-wrapper='notif']").fadeIn('fast');
            notification();
        }
    });
}

$(document).on('click', '#toast', function(){
//  Hilangkan 'toast' saat klik sembarang.
    $(this).stop().fadeOut('fast');
});

$(document).ready(function(){
    notification();

    $("i[clear-notification]").click(function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', host + 'system/process/notification/clear');
        xhr.send();

        xhr.onload = () => {
            if(xhr.responseText == 1) {
                notification();
            }
        }
    });

    if (sessionStorage.getItem("toastMessage")){
    //  Tampilkan 'toast' jika data tertentu pada 'Session Storage' tersedia.
        toast(sessionStorage.getItem('toastColor'), sessionStorage.getItem('toastMessage'));
        sessionStorage.clear();
    }

    $(document).scroll(function(){
    //  Jika halaman di 'scroll'.
        $("header, #sidebar").toggleClass('scrolled', $(this).scrollTop() > 50);
    });

    if ($('#actions').attr('privil') == 'read'){
        $('.add, .edit, .delete').hide();
    } else if ($('#actions').attr('privil') == 'edit'){
        $('.delete').hide();
    }

    /* Sidebar & Header ______________________ */
    $('.sidebar-list .parent').click(function(){
    //  'Dropdown menu' yang memiliki kelas 'parent'.
        let target = $(this).attr('ctarget');
        $('.sidebar-list ul[cget="' + target + '"]').slideToggle('fast');
    });

    $('.sidebar-list .child').each(function(){
    //  Memeriksa jika tiap 'menu' dengan kelas 'child'  
        if($(this).children().length == 0){
            $(".parent[ctarget='" + $(this).attr('cGet') + "']").hide();
        }

        $(".parent[ctarget='" + $(this).attr('cGet') + "']")
        .append("<i class='micon arrowDown'>arrow_drop_down</i>");
    });

    var cGet = $('.sidebar-list .child a.active').parents('.child').attr('cGet');
    $('.parent[ctarget="' + cGet + '"]').addClass('active');
    $('.child[cget="' + cGet + '"]').slideDown('fast');

    $('.menu-switch').click(function(){
		$('#sidebar').toggleClass('menu-open');
        if($('#sidebar').hasClass('menu-open')){
            $('section').css('filter', 'blur(4px)');
        } else {
            $('section').css('filter', 'none');
        }
    });

    /* Feedback ______________________________ */

    $("a[open-feedback]").click(function(){
        $('.cx-feedback').slideToggle('fast');
    });

    $(".cx-feedback .cancel").click(function(){
        $(".cx-feedback").slideUp('fast');
    });

    /* Notification __________________________ */
    $('.notification .bell, .notification .number').click(function(){
        $('.list').slideToggle('fast');
    });

    /* Form Validate _________________________ */
    $('.validate *[required]').each(function(){
        $(this).parent().find('label').prepend("<span>Required</span>");
    });

    $('.validate *[required]').on('keyup change', function(){
        if ($(this).val() == null || $(this).val().length == 0){
            $(this).parent().find('label span').css({
                'display': 'block',
                'border-color': 'var(--red1)',
                'background': 'var(--red2)'
            });
        } else {
            $(this).parent().find('label span').css({
                'border-color': '', 'background': ''
            });
            $(this).parent().find('label[validate] span').css({
                'display': 'none'
            });
        }
    });

    $(document).on('click', ".validate button[type='submit']", function(){
        const submitButton = $(this);
        $('.validate *[required]').each(function(){
            if ($(this).val() == null || $(this).val().length == 0){
                $(this).parent().find('label span').css({
                    'display': 'block',
                    'border-color': 'var(--red1)',
                    'background': 'var(--red2)'
                });
                $(".cx-loading").hide();
                submitButton.html('Please check again!');
            } else {
                $(this).parent().find('label span').css({
                    'border-color': '', 'background': ''
                });
                $(this).parent().find('label[validate] span').css({
                    'display': 'none'
                });
                $(".cx-loading").hide();
                submitButton.html('Save');
            }
        });
    });

    /* Popup _________________________________ */
    $(document).on('click', "*[pop-target]", function(){
        var target = $(this).attr('pop-target');
        $("*[pop-wrapper='" + target + "']").fadeIn('fast');
    });

    $("*[pop-wrapper] *[pop-close]").click(function(){
        $("*[pop-wrapper]").fadeOut('fast');
    });

    /* Plus Minus Buttons ____________________ */
    $(document).on('click', 'form .plus-minus .minus', function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });

    $(document).on('click', 'form .plus-minus .plus', function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

    /* Form Checks ___________________________ */
    $('input[type="number"]').on('keyup', function(){
    /*  Jika 'input' bertipe 'number' memiliki atribut 'min & max'
        maka pastikan angka yang diinput tidak lebih atau kurang
        dari atribut 'min & max'. */
        v = parseInt($(this).val());
        min = parseInt($(this).attr('min'));
        max = parseInt($(this).attr('max'));

        if (v < min){ $(this).val(min); }
        else if (v > max){ $(this).val(max); }
    });

    $('textarea.check').keyup(function(){
        var len = $(this).val().length;
        var max = $(this).attr('maxlength');
        var result = $(this).attr('check-target');
        if (len >= max){
            $(this).val($(this).val().substring(0, max));
            $('.' + result).css({
                'border-color': 'var(--red1)',
                'background': 'var(--red2)'
            });
        } else {
            $('.' + result).text(max - len).css({
                'border-color': 'var(--green1)',
                'background': 'var(--green2)'
            });
        }
    });

    $("input[type='password'].check").keyup(function(){
        var strong = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
        var enough = new RegExp("(?=.{8,}).*", "g");
        var result = $(this).attr('check-target');

        if (!enough.test($(this).val())) {
            $('.' + result).text("More Characters!").css({
                'border-color': 'var(--red1)',
                'background': 'var(--red2)'
            });
        } else if (strong.test($(this).val())) {
            $('.' + result).text("Strong!").css({
                'border-color': 'var(--green1)',
                'background': 'var(--green2)'
            });
        } else {
            $('.' + result).text("Weak!").css({
                'border-color': 'var(--red1)',
                'background': 'var(--red2)'
            });
        }
    });

    $(".passToggle").click(function(){($("input[passToggle]").attr('type') === 'password') ? $("input[passToggle]").attr('type', 'text') : $("input[passToggle]").attr('type', 'password');});
    //  Menampilkan kata sandi yang diinput.

    /* City & Province _______________________ */
    $("#add_province").on('change', function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', host + 'system/process/general/cities', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('province=' + this.value);

        xhr.onload = () => {
            let resp = JSON.parse(xhr.responseText);
            const selectCity = document.querySelector("select[name='city']");
            selectCity.innerHTML = '';

            resp.forEach((item, index, arr) => {
                selectCity.innerHTML += (`<option value='${item.id}'>${item.name}</option>`);
            });
        };
    });

    $("#edit_province").on('change', function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST', host + 'system/process/general/cities', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('province=' + this.value);

        xhr.onload = () => {
            let resp = JSON.parse(xhr.responseText);
            const selectCity = document.querySelector("select[name='city']");
            selectCity.innerHTML = '';

            resp.forEach((item, index, arr) => {
                if(document.getElementById("edit_city").value == item.id){
                    selectCity.innerHTML += (`<option value='${item.id}' selected>${item.name}</option>`);
                } else {
                    selectCity.innerHTML += (`<option value='${item.id}'>${item.name}</option>`);
                }
            });
        };
    });

    $("#edit_province").trigger('change');

    /* Others ________________________________ */
    $('#mainTable tbody').on('click', 'tr', function(){
        if ($(this).hasClass('selected')){
            $(this).removeClass('selected');
        } else {
            $('#mainTable tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $(".coming-soon").on('change click', function(){
    //  Menampilkan pesan 'Coming Soon' dibagian tertentu.
        toast('error', 'Coming soon.');
        return false;
    });

    $(document).on('click', '.info .close', function(){
        $(this).parents('.info').slideUp('fast');
        return false;
    });

    /* Offline _______________________________ */
    if(navigator.onLine){

    } else {
        $("section form button[type='submit'], section form .cancel").hide();
        $("section form .dates").css("margin", "0");
    }
});