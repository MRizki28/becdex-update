<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
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

        //add
        $('.btnAdd').click(function() {
            swal({
                    title: 'Start New Submission?',
                    icon: 'info',
                    buttons: true,
                })
                .then((willAdd) => {
                    if (willAdd) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>submission/addSubmission',
                            dataType: 'json',
                            success: function(response) {
                                swal({
                                    title: 'New Submission Started!',
                                    icon: 'success',
                                });
                                showAllSubmission();
                            },
                            error: function() {
                                alert: ('error');
                            }
                        })
                    } else {
                        swal({
                            title: 'Cancelled',
                            icon: 'success',
                        });
                    }
                });
        });

        //function
        function showAllSubmission() {
            $.ajax({
                url: '<?php echo base_url() ?>submission/showAllReadySubmission',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            html += '<div class="card mb-2">' +
                                '<div class="card-header">Submission</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<p class="card-text">Company Name : <strong>' + data[i].name + '</strong></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2 ">' +
                                '<a href="<?= base_url() ?>management/submissionDetail/' + data[i].id_submission + '/3" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                '</div>';
                        }
                    } else {
                        html += '<div class="row text-center">' +
                            '<div class="col-lg-12">' +
                            '<div class="card w-100">' +
                            '<div class="card-body">' +
                            '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/user-index.svg" class="w-25">' +
                            '<p class="card-text">No Submission</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                    MyTable.fnDestroy();
                    $('#show_data').html(html);

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }
    });

    var MyTable = $('#myTable').dataTable({
        "order": [],
    });

    window.onload = function() {
        showAllSubmission();
    };
</script>