<main id="main">

    <section id="about" class="about">

        <div class="container mt-5">
            <div class="row gx-0">
                <div class="col-3 p-3">
                    <div class="card">
                        <form method="post" action="<?= base_url() ?>home/catalog">
                            <div class="card-header bg-primary text-white">
                                Filter
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="exampleFormControlSelect1"><small><i class="fas fa-fw fa-globe text-primary"></i> Coastal States</small></label>
                                    <select class="form-control filter" id="dropdown-country">
                                        <option value="all">All States</option>
                                        <?php foreach ($countries as $data) {
                                            echo "<option value=" . $data->iso . ">" . $data->nicename . "</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="exampleFormControlSelect1"><small><i class="fa fa-check-circle text-success" aria-hidden="true"></i> BECdex Categories</small></label>
                                    <select class="form-control filter" id="dropdown-cat">
                                        <option value="all">All Categories</option>
                                        <?php foreach ($categories as $data) {
                                            echo "<option value=" . $data->id_becdex_cat . ">" . $data->becdex_cat_name . "</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 filter" id="field-filter">
                                    <label class="mb-2" for="exampleFormControlSelect1"><small><i class="fas fa-fw fa-building text-dark"></i> Sectors</small></label>
                                    <?php foreach ($company_field as $data) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $data->id_company_field ?>" checked id="defaultCheck1">
                                            <label class="form-check-label " for="defaultCheck1">
                                                <small><?= $data->field_name ?></small>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-9 p-3">
                    <div class="row mb-4">
                        <div class="col-12" id="result-length"></div>
                    </div>
                    <div class="row" id="show_data">
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End About Section -->

</main><!-- End #main -->


<script>
    function showAllUser() {
        $.ajax({
            url: '<?php echo base_url() ?>home/showAllCertifiedUser',
            async: false,
            dataType: 'json',
            success: function(data) {
                showData(data);
            },
            error: function() {
                alert('Error loading data');
            }
        });
    }


    $(".filter").change(function() {
        var country_id = $("#dropdown-country").val();
        var cat_id = $("#dropdown-cat").val();

        if (country_id == 'all' && cat_id == 'all') {
            showAllUser();
        } else {
            $.ajax({
                url: '<?php echo base_url() ?>home/showAllCertifiedUserByFilter/' + country_id + '/' + cat_id,
                async: false,
                dataType: 'json',
                success: function(data) {
                    showData(data);
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

    });


    function showData(data) {
        var html = '';
        var i;
        if (data) {
            var length = data.length;
            console.log(length);
            for (i = 0; i < data.length; i++) {
                html += '<div class="col-5 p-1 companies-single" data-filter="' + data[i].id_company_field + '">' +
                    '<div class="card">' +
                    '<div class="card-body" style="height: 180px;">' +
                    '<div class="row">'+
                    '<div class="col-sm-5">'+
                    '<img class="card-img-top" src="<?= base_url() ?>assets/img/profile/' + data[i].image + '" alt="">' +
                    '</div>'+
                    '<div class="col-sm-7">'+
                    '<a target="_blank" href="<?= base_url() ?>home/company_verified/'+data[i].user_id+'" title="'+data[i].name+'"><h5 class="card-title">' + data[i].name + '</h5></a>' +
                    '<small class="mb-2 text-muted"><img width="20" src="<?= base_url() ?>/assets/svg/detail-location.svg"> ' + data[i].nicename + '</small><br>' +
                    '<small class="mb-2 text-muted"><img width="20" src="<?= base_url() ?>/assets/svg/detail-sector.svg"> ' + data[i].field_name + '</small><br>' +
                    // '<small class="mb-2 text-muted"><i class="fa fa-check-circle text-' + data[i].becdex_cat_color + '" aria-hidden="true"></i> ' + data[i].becdex_cat_name + '</small>' +
                    '<small class="mb-2 text-muted"><i class="fa fa-check-circle text-primary" aria-hidden="true"></i> Verified</small>' ++
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            }
        } else {
            var length = '0';
            html += '<div class="col-lg-12 text-center border-transparent">' +
                '<div class="card w-100">' +
                '<div class="card-body">' +
                '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/empty.svg" class="w-25">' +
                '<p class="card-text mt-3">No data to show</p>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
        $('#result-length').html('Showing ' + length + ' Result(s)');
        $('#show_data').html(html);

        var cat_array = [];
        var category = $("input[type=checkbox]").toArray();
        var cards = document.getElementsByClassName("companies-single");
        for (var i = 0; i < category.length; i++) {
            if (category[i].checked == false) {
                cat_array.push(category[i].value);
            }
        }
        for (var i = 0; i < cat_array.length; i++) {
            $(".companies-single[data-filter=" + cat_array[i] + "]").hide();
        }
    }


    window.onload = function() {
        showAllUser();
    }
</script>