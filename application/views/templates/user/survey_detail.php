<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row mb-2">
        <div class="col-lg-10">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> for Submission: #<?= $id ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="show_data">
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
    $(function() {
        showAllSubmission();

        //function
        function showAllSubmission() {
            $.ajax({
                url: '<?php echo base_url() ?>user/showAllLocationSurveyBySubmission/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {

                            html += '<div class="card mb-2">' +
                                '<div class="card-header">Survey</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<span class="badge rounded-pill text-bg-success">Successful in getting survey</span>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Survey #' + (i + 1) + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                'Link: '+data[i].link+'<br>' +
                                'Times: '+data[i].time+'<br>' +
                                'Date: '+data[i].date+'<br>' +
                                'Note: '+data[i].keterangan+'<br>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted"></div>' +
                                '</div>';
                        }
                    } else {
                        html += '<div class="row text-center">' +
                            '<div class="col-lg-12">' +
                            '<div class="card w-100">' +
                            '<div class="card-body">' +
                            '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/no-payment.svg" class="w-25">' +
                            '<h5 class="card-title mt-3">Suvey Is Not Available Right Now</h5>' +
                            '<p class="card-text">Empty!</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                    $('#show_data').html(html);

                },
                error: function() {
                    alert('Wait scedule');
                }
            });
        }
    });

    window.onload = function() {
        showAllSubmission();
    };
</script>