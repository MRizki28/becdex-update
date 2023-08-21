<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> New Submission</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="show_data">
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <label for="">Submission ID :</label>
                    <input type="text" readonly class="form-control-plaintext" name="submission_id" value="">
                    <input class="form-control" type="file" name="document" id="formFile" accept="application/pdf">
                    <div class="invalid-feedback">
                        Please insert file.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnClose">Close</button>
                <button type="button" id="btnSave" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<script>
    $(function() {
        showAllSubmission();

        $('#modalAdd #btnClose').click(function(){
            location.reload();
        });
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
                                if(response.success == true){
                                    swal({
                                        title: 'New Submission Started!',
                                        icon: 'success',
                                    });
                                } else {
                                    swal({
                                        title: 'New Submission Failed, Try Again Tomorrow!',
                                        icon: 'success',
                                    });
                                }
                                showAllSubmission();
                            },
                            statusCode: {
                                500: function() {
                                  swal({
                                        title: 'New Submission Failed, Try Again Tomorrow!',
                                        icon: 'error',
                                    });
                                }
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
                url: '<?php echo base_url() ?>submission/showAllSubmissionById',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            if(data[i].transaction_status == 'pending'){
                                html += '<div class="card mb-2">' +
                                '<div class="card-header">Submission</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span><br><br><span class="text-danger">Batas waktu pembayaran:<br> '+data[i].transaction_time+'</span><br><span class="text-dark">Bank: '+data[i].bank.toUpperCase()+'<br> Nomor VA: '+data[i].va_number+'</span>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2">' +
                                '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                '<br><br></br><button type="button" onclick="konfirmasi(`'+data[i].id+'`,`'+data[i].id_submission+'`)" class="btn btn-success btn-sm w-100">Click to Confirm Payment<i class="fa fa-hand-paper ml-2" aria-hidden="true"></i></button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                '</div>';
                            } else if(data[i].transaction_status == 'done' && data[i].link != null) {
                                if(data[i].submission_status_id == '5'){
                                    html += '<div class="card mb-2">' +
                                        '<div class="card-header">Submission</div>' +
                                        '<div class="card-body">' +
                                        '<div class="row">' +
                                        '<div class="col-lg-10">' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                        '</div>' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                        '</div>' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span></p>' +
                                        '</div>' +
                                        '</div>' +
                                        '<div class="col-lg-2 ">' +
                                        '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                        '<a href="<?= base_url() ?>user/paymentDetail/' + data[i].id_submission + '" class="btn btn-warning btn-sm mt-2 w-100">See Payment<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>' +
                                        '<a href="<?= base_url() ?>user/survey/' + data[i].id_submission +'" class="btn btn-secondary btn-sm mt-2 w-100">See Survey &nbsp;&nbsp;&nbsp;<span class="badge badge-success">&nbsp;</span></a>' +
                                        '<a target="_blank" href="<?= base_url() ?>user/cetak_certificate/' + data[i].id_submission +'" class="btn btn-success btn-sm mt-2 w-100">See Certificate &nbsp;&nbsp;&nbsp;</a>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                        '</div>';
                                } else {
                                     html += '<div class="card mb-2">' +
                                        '<div class="card-header">Submission</div>' +
                                        '<div class="card-body">' +
                                        '<div class="row">' +
                                        '<div class="col-lg-10">' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                        '</div>' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                        '</div>' +
                                        '<div class="col-lg-12 mb-2">' +
                                        '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span></p>' +
                                        '</div>' +
                                        '</div>' +
                                        '<div class="col-lg-2 ">' +
                                        '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                        '<a href="<?= base_url() ?>user/paymentDetail/' + data[i].id_submission + '" class="btn btn-warning btn-sm mt-2 w-100">See Payment<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>' +
                                        '<a href="<?= base_url() ?>user/survey/' + data[i].id_submission +'" class="btn btn-secondary btn-sm mt-2 w-100">See Survey &nbsp;&nbsp;&nbsp;<span class="badge badge-success">&nbsp;</span></a>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                        '</div>';
                                }
                            } else if(data[i].transaction_status == 'done'){
                                if(data[i].submission_status_id == '4'){
                                    html += '<div class="card mb-2">' +
                                    '<div class="card-header">Submission</div>' +
                                    '<div class="card-body">' +
                                    '<div class="row">' +
                                    '<div class="col-lg-10">' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                    '</div>' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                    '</div>' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span></p>' +
                                    '</div>' +
                                    '<hr>' +
                                    '<div class="col-lg-12 mb-2">'+
                                    '<p class="card-text">Reason: '+data[i].reason+'</p>'+
                                    '</div>'+
                                    '</div>' +
                                    '<div class="col-lg-2 mt-4">' +
                                    '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                    '<a href="<?= base_url() ?>user/paymentDetail/' + data[i].id_submission + '" class="btn btn-warning btn-sm mt-2 w-100">See Payment<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>' +
                                    '<a href="<?= base_url() ?>user/survey/' + data[i].id_submission +'" class="btn btn-secondary btn-sm mt-2 w-100">See Survey &nbsp;&nbsp;&nbsp;<span class="badge badge-danger">&nbsp;</span></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                    '</div>';
                                } else {
                                    html += '<div class="card mb-2">' +
                                    '<div class="card-header">Submission</div>' +
                                    '<div class="card-body">' +
                                    '<div class="row">' +
                                    '<div class="col-lg-10">' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                    '</div>' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                    '</div>' +
                                    '<div class="col-lg-12 mb-2">' +
                                    '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span></p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-lg-2 ">' +
                                    '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                    '<a href="<?= base_url() ?>user/paymentDetail/' + data[i].id_submission + '" class="btn btn-warning btn-sm mt-2 w-100">See Payment<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>' +
                                    '<a href="<?= base_url() ?>user/survey/' + data[i].id_submission +'" class="btn btn-secondary btn-sm mt-2 w-100">See Survey &nbsp;&nbsp;&nbsp;<span class="badge badge-danger">&nbsp;</span></a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                    '</div>';
                                }
                            } else {
                                html += '<div class="card mb-2">' +
                                '<div class="card-header">Submission</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<span class="badge rounded-pill text-bg-' + data[i].color + '">' + data[i].submission_name + '</span>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Submission ID #' + data[i].id_submission + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<p class="card-text">Initial Score <span class="badge bg-info mr-2">' + data[i].initial_score + '</span>Valid Score <span class="badge bg-success">' + data[i].valid_score + '</span><br><br>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2">' +
                                '<a href="<?= base_url() ?>user/submissionDetail/' + data[i].id_submission + '" class="btn btn-primary btn-sm w-100">See Submission<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a><br>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted">' + data[i].date_started + '</div>' +
                                '</div>';
                            }
                        }
                    } else {
                        html += '<div class="row text-center">' +
                            '<div class="col-lg-12">' +
                            '<div class="card w-100">' +
                            '<div class="card-body">' +
                            '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/user-index.svg" class="w-25">' +
                            '<h5 class="card-title mt-3">No Submission</h5>' +
                            '<p class="card-text">Start a new submission to begin your BECdex submission!</p>' +
                            '<button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> New Submission</button>' +
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

    function konfirmasi(id, submission){
         swal({
            title: 'Konfirmasi pembayaran Submission '+submission+' ?',
            icon: 'info',
            buttons: true,
        })
        .then((willAdd) => {
            if (willAdd) {
                $.ajax({
                    type: "post",
                    url: '<?php echo base_url() ?>/payment/konfirmPayment',
                    data: {
                        id: id,
                        id_submission: submission,
                    },
                    dataType: "json",
                    success:function(response){
                        if(response.sukses){
                            swal({title: "Done", text: response.sukses, type: 
                            "success"}).then(function(){ 
                                $('#modalAdd #myForm').attr('action', '<?php echo base_url() ?>payment/addPayment');
                                $('#modalAdd [name="submission_id"]').val(submission);
                                $('#modalAdd').modal('show');
                               }
                            );
                        }
                    },
                    error:function(response){
                        if(response.gagal){
                            swal({title: "Failed", text: response.gagal, type: 
                            "error"}).then(function(){ 
                               location.reload();
                               }
                            );
                        }
                    }
                });
            } else {
                swal({
                    title: 'Cancelled',
                    icon: 'success',
                });
            }
        });
    }

    $('#btnSave').click(function() {
        var url = $('#myForm').attr('action');
        var data = $('#myForm').serialize();
        //validate form
        var documentUpload = $('input[name=document]');
        var result = '';
        if (documentUpload.val() == '') {
            documentUpload.addClass('is-invalid');
        } else {
            documentUpload.parent().removeClass('is-invalid');
            result += 1;
        }

        if (result == '1') {
            var formData = new FormData($('#myForm')[0]);
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalAdd').modal('hide');
                        $('#myForm')[0].reset();
                        if (response.type == 'add') {
                            var type = 'added';
                        } else if (response.type == 'edit') {
                            var type = 'edited';
                        }
                        swal({title: "Done", text: 'Upload Success', type: 
                        "success"}).then(function(){ 
                            location.reload()
                           }
                        );
                    } else {
                        swal('Failed', 'Error occured. Please try again!', 'error');
                    }
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });
        }
    });

    window.onload = function() {
        showAllSubmission();
    };
</script>