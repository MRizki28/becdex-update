<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <?php if ($submission_detail['id_submission_status'] == '4'): ?>
            <div class="col-lg-6 text-right">
                <form action="<?= base_url() ?>submission/submitAllSubmission/<?= $id ?>" method="post">
                    <button class="btn btn-primary btn-info" type="submit" name="submit" value="submit_all">Submit All Submission</button>
                </form>
            </div>
        <?php else: ?>
            <?php $arr = ['1', '2']; ?>
            <?php if (!in_array($submission_detail['id_submission_status'], $arr)): ?>
            <div class="col-lg-6 text-right">
                <button class="btn btn-primary btn-success" type="button" disabled>Submissions have been sent</button>
            </div>
        <?php endif ?>
        <?php endif ?>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="">Submission Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">ID : </small><?= $submission_detail['id_submission'] ?></h6>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Started Date : </small><?= date('d M Y', strtotime($submission_detail['date_started'])) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="">Score</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Initial Score : </small><span id="initial-score">0</span><small class="text-muted fw-light">/100</small></h6>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Valid Score : </small><?= $submission_detail['valid_score'] ?><small class="text-muted fw-light">/100</small></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h6 class="">Progress</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Uploaded Indicator : </small><span id="progress-count">0</span><small class="text-muted fw-light"> /50</small></h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="">Location Survey</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Initial Score : </small>0</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-12 text-right payment">
            
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

<!-- Modal -->
<div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    <h5 class="alert-heading" id="indicator-name"></h5>
                    <p id="indicator-desc"></p>
                </div>
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <div class="mb-3">
                        <label for="">Extension File (Pdf, Csv, Excel, Rar, Zip, Tar, Dmg, Kgb)</label>
                        <input type="hidden" readonly class="form-control-plaintext" name="Id">
                        <input class="form-control" type="file" name="document" id="formFile" accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .rar, .zip, .tar, .dmg, .kgb">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSave" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel"></h5> &nbsp;&nbsp; <i class="fa fa-info-circle item-info" aria-hidden="true"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    <h5 class="alert-heading" id="indicator-name"></h5>
                    <p id="indicator-desc"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="modalView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <iframe src="" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Status -->
<div class="modal fade" id="modalStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row text-center">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <img class="card-img-top w-50" src="<?= base_url() ?>svgs/no-payment.svg">
                            <h5 class="card-title mt-3">No Payment is Accepted</h5>
                            <p class="card-text">Upload your payment for this submission to get verified!</p>
                            <a type="button" href="<?= base_url() ?>user/paymentDetail/<?= $id ?>" class="btn btn-primary text-white"><i class="fa fa-plus" aria-hidden="true"></i> New Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddPay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
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
    $('#modalAddPay #btnClose').click(function(){
            location.reload();
        });
    var id_submission = `<?= $submission_detail['id_submission'] ?>`;
    var snap_token = {token: null, submission_id: null, total_harga: null, client_key: null}
    $(function() {
        showAllAspect();
        showAllOutcome();
        showAllPrinciple();
        showAllIndicator(id_submission);
        showAllAnswer();
        showAllDocument();
        showAllProgress();

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var documentUpload = $('input[name=document]');
            var result = '';
            if (documentUpload.val() == '') {
                documentUpload.parent().addClass('was-validated');
            } else {
                documentUpload.parent().parent().removeClass('was-validated');
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
                            }
                            swal('Done', 'Successfully ' + type + '!', 'success');
                            showAllAspect();
                            showAllOutcome();
                            showAllPrinciple();
                            showAllIndicator(id_submission);
                            showAllAnswer();
                            showAllDocument();
                            showAllProgress()
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

        // button info
        $(document).on('click', '.item-info', function() {
            var id = $(this).attr('data');
            $('#modalInfo').modal('show');
            $('#modalInfo').find('.modal-title').text('Info Document');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>becdex/detailIndicator',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('#modalInfo #indicator-name').html(data.indicator_name);
                    $('#modalInfo #indicator-desc').html(data.indicator_desc);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //add
        $(document).on('click', '.item-add', function() {
            $("#myForm").trigger('reset');
            var id = $(this).attr('data');
            $('#modalAdd').modal('show');
            $('#modalAdd').find('.modal-title').text('Add Document');
            $('#myForm').attr('action', '<?php echo base_url() ?>document/addDocument/<?= $id ?>');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>becdex/detailIndicator',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=Id]').val(data.id_indicator);
                    $('#indicator-name').html(data.indicator_name);
                    $('#indicator-desc').html(data.indicator_desc);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //document view
        $(document).on('click', '.item-view', function() {
            var id = $(this).attr('data');
            $('#modalView').modal('show');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>document/viewDocument',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('iframe').attr("src", "<?= base_url() ?>document/submission/" + data.file);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //delete
        $(document).on('click', '.item-delete', function() {
            var id = $(this).attr('data');
            swal({
                    title: 'Delete Document?',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>document/deleteDocument',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Deleted!', {
                                    icon: 'success',
                                });
                                showAllAspect();
                                showAllOutcome();
                                showAllPrinciple();
                                showAllIndicator(id_submission);
                                showAllAnswer();
                                showAllDocument();
                                showAllProgress()
                            },
                            error: function() {
                                alert: ('error');
                            }
                        })
                    } else {
                        swal('Cancelled', {
                            icon: 'success',
                        });
                    }
                });


        });

        //answer yes
        $(document).on('click', '.item-yes', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>answer/answerYes',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    showAllAspect();
                    showAllOutcome();
                    showAllPrinciple();
                    showAllIndicator(id_submission);
                    showAllAnswer();
                    showAllDocument();
                    showAllProgress()
                },
                error: function() {
                    alert: ('error');
                }
            })
        });

        //answer no
        $(document).on('click', '.item-no', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>answer/answerNo',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    showAllAspect();
                    showAllOutcome();
                    showAllPrinciple();
                    showAllIndicator(id_submission);
                    showAllAnswer();
                    showAllDocument();
                    showAllProgress()
                },
                error: function() {
                    alert: ('error');
                }
            })
        });

        //submit all
        $(document).on('click', '.submit-all', function() {
            var status = "<?= $submission_detail['submission_status_id'] ?>";
            if (status == 1) {
                $('#modalStatus').modal('show');
            } else {
                swal({
                    title: 'Submit this Submission?',
                    icon: 'info',
                    buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>submission/submissionToChecking/<?= $id ?>',
                            dataType: 'json',
                            success: function(response) {
                                swal('Submitted!', {
                                    icon: 'success',
                                });
                                showAllAspect();
                                showAllOutcome();
                                showAllPrinciple();
                                showAllIndicator(id_submission);
                                showAllAnswer();
                                showAllDocument();
                                showAllProgress()
                            },
                            error: function() {
                                swal('Failed', {
                                    icon: 'error',
                                });
                            }
                        })
                    }
                })
            }
        });

        //function
        function showAllAspect() {
            $.ajax({
                url: '<?php echo base_url() ?>becdex/showAllAspect',
                async: false,
                dataType: 'json',
                success: function(aspect_data) {
                    var aspect = '';
                    var i;
                    for (i = 0; i < aspect_data.length; i++) {
                        aspect += '<div class="card mb-3">' +
                            '<div class="card-header bg-primary text-white"><p class="h5">Aspect: ' + aspect_data[i].aspect_name + '</p></div>' +
                            '<div class="card-body " id="aspect-' + aspect_data[i].id_aspect + '">' +
                            '</div>' +
                            '</div>';
                    }
                    $('#show_data').html(aspect);

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        function showAllOutcome() {
            $.ajax({
                url: '<?php echo base_url() ?>becdex/showAllOutcome',
                async: false,
                dataType: 'json',
                success: function(outcome_data) {
                    var outcome = [''];
                    var i;
                    for (i = 0; i < outcome_data.length; i++) {
                        outcome[i] = '<div class="card mb-3">' +
                            '<div class="card-header bg-info text-white">Outcome: ' + outcome_data[i].outcome_name + '</div>' +
                            '<div class="card-body " id="outcome-' + outcome_data[i].id_outcome + '">' +
                            '</div>' +
                            '</div>';
                        $('#aspect-' + outcome_data[i].aspect_id).append(outcome[i]);
                    }

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        function showAllPrinciple() {
            $.ajax({
                url: '<?php echo base_url() ?>becdex/showAllPrinciple',
                async: false,
                dataType: 'json',
                success: function(principle_data) {
                    var principle = [''];
                    var i;
                    for (i = 0; i < principle_data.length; i++) {
                        principle[i] = '<div class="card mb-3">' +
                            '<div class="card-header bg-light">Principle: ' + principle_data[i].principle_name + '</div>' +
                            '<div class="card-body" >' +
                            '<div class="accordion" id="principle-' + principle_data[i].id_principle + '">' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('#outcome-' + principle_data[i].outcome_id).append(principle[i]);
                    }

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        function showAllIndicator(id_submission) {
            $.ajax({
                url: '<?php echo base_url() ?>becdex/showAllIndicator/'+id_submission,
                async: false,
                dataType: 'json',
                success: function(indicator_data) {
                    var indicator = [''];
                    var i;
                    for (i = 0; i < indicator_data.length; i++) {
                        if(indicator_data[i].value == '1'){
                            indicator[i] =
                                '<div class="accordion-item">' +
                                '<h2 class="accordion-header">' +
                                '<button class="accordion-button" type="button" >' +
                                indicator_data[i].id_indicator + '. ' + indicator_data[i].indicator_name +
                                '<span id="subperind-' + indicator_data[i].id_indicator + '" class="badge text-bg-primary ml-2"></span></button>' +
                                '</h2>' +
                                '<div class="accordion-collapse collapse show" data-bs-parent="#accordionExample">' +
                                '<div class="accordion-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-12 mb-3 p-0" id="answer-' + indicator_data[i].id_indicator + '">' +
                                '</div>' +
                                '<div class="col-lg-12 mb-5 p-0" id="comment-' + indicator_data[i].id_indicator + '">' +
                                '</div>' +
                                '<div class="col-lg-12 mb-1 p-0">' +
                                '<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">' +
                                '&nbsp;<i class="fa fa-info-circle item-info" aria-hidden="true" data="' + indicator_data[i].id_indicator + '"></i> <button type="button" class="btn btn-sm btn-primary item-add button-' + indicator_data[i].id_indicator + '" data="' + indicator_data[i].id_indicator + '"><i class="fa fa-plus" aria-hidden="true"></i> Add Document</button>' +
                                '</div>' +
                                '<div class="col-12 px-0" id="indicator-' + indicator_data[i].id_indicator + '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('#principle-' + indicator_data[i].principle_id).append(indicator[i]);
                        } else {
                            indicator[i] =
                                '<div class="accordion-item">' +
                                '<h2 class="accordion-header">' +
                                '<button class="accordion-button" type="button" >' +
                                indicator_data[i].id_indicator + '. ' + indicator_data[i].indicator_name +
                                '<span id="subperind-' + indicator_data[i].id_indicator + '" class="badge text-bg-primary ml-2"></span></button>' +
                                '</h2>' +
                                '<div class="accordion-collapse collapse show" data-bs-parent="#accordionExample">' +
                                '<div class="accordion-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-12 mb-3 p-0" id="answer-' + indicator_data[i].id_indicator + '">' +
                                '</div>' +
                                '<div class="col-lg-12 mb-5 p-0" id="comment-' + indicator_data[i].id_indicator + '">' +
                                '</div>' +
                                '<div class="col-12 text-right" id="indicator-' + indicator_data[i].id_indicator + '">' +
                                '&nbsp;<i style="font-size: 20px;" class="fa fa-info-circle item-info" aria-hidden="true" data="' + indicator_data[i].id_indicator + '"></i>'
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('#principle-' + indicator_data[i].principle_id).append(indicator[i]);
                        }
                    }

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        function showAllDocument() {
            $.ajax({
                url: '<?php echo base_url() ?>document/showAllDocument/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(document_data) {
                    var document = [''];
                    var i;
                    for (i = 0; i < document_data.length; i++) {
                        document[i] = '<div class="card mb-1">' +
                            '<div class="card-body">' +
                            '<div class="row">' +
                            '<div class="col-6">' + document_data[i].file + '</div>' +
                            '<div class="col-6 text-right document-action">' +
                            '<button type="button" class="btn btn-sm btn-warning mr-2 item-view text-white" data="' + document_data[i].id_document + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-danger item-delete button-' + document_data[i].indicator_id + '" data="' + document_data[i].id_document + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('#indicator-' + document_data[i].indicator_id).append(document[i]);
                    }

                },
                error: function() {
                    alert('Error loading data');
                }

            });
        }

        function showAllAnswer() {
            $.ajax({
                url: '<?php echo base_url() ?>answer/showAllAnswer/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(answer_data) {
                    var answer = [''];
                    var i;
                    for (i = 0; i < answer_data.length; i++) {
                            switch (answer_data[i].value) {
                                case '0':
                                    var color_yes = 'secondary';
                                    var color_no = 'danger';
                                    break;
                                case '1':
                                    var color_yes = 'success';
                                    var color_no = 'secondary';
                                    break;

                                default:
                                    var color_yes = 'secondary';
                                    var color_no = 'secondary';
                                    break;
                            }

                            if(color_yes == 'secondary' && color_no == 'secondary'){
                                answer[i] =
                                    '<div class="col-lg-12">' +
                                    '<h6>Question #' + (i + 1) + '</h6>' +
                                    '<div class="row">' +
                                    '<div class="col-8">' +
                                    '<p>' + answer_data[i].text + '</p>' +
                                    '</div>' +
                                    '<div class="col-lg-4 text-right jawaban-yes-no">'+
                                    '<div class="tempat-submit-ulang-'+i+'">' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' btn btn-sm btn-' + color_yes + ' w-15 item-yes" data="' + answer_data[i].id_answer + '"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' ml-2 btn btn-sm btn-' + color_no + ' w-15 item-no" data="' + answer_data[i].id_answer + '"><i class="fa fa-times" aria-hidden="true"></i> No</button>' +
                                    '</div>'+
                                    // '<div class="col-lg-2 text-right tempat-submit-ulang-'+i+'">' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                    $('#answer-' + answer_data[i].indicator_id).append(answer[i]);
                            } else {
                                if(answer_data[i].valid_value == '1'){
                                    answer[i] =
                                    '<div class="col-lg-12">' +
                                    '<h6>Question #' + (i + 1) + '</h6>' +
                                    '<div class="row">' +
                                    '<div class="col-8">' +
                                    '<p>' + answer_data[i].text + ' <span class="bade badge-success text-white">Verified</span></p>' +
                                    '</div>' +
                                    '<div class="col-4 text-right">' +
                                    '<div class="tempat-submit-ulang-'+i+'">' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' btn btn-sm btn-' + color_yes + ' w-15 item-yes" data="' + answer_data[i].id_answer + '"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' ml-2 btn btn-sm btn-' + color_no + ' w-15 item-no" data="' + answer_data[i].id_answer + '"><i class="fa fa-times" aria-hidden="true"></i> No</button>' +
                                    '</div>' +
                                    // '<div class="col-lg-2 text-right tempat-submit-ulang-'+i+'">' +
                                    '</div>' +
                                    '</div>';
                                    $('#answer-' + answer_data[i].indicator_id).append(answer[i]);
                                } else if(answer_data[i].valid_value == '0') {
                                    answer[i] =
                                    '<div class="col-lg-12">' +
                                    '<h6>Question #' + (i + 1) + '</h6>' +
                                    '<div class="row">' +
                                    '<div class="col-8">' +
                                    '<p>' + answer_data[i].text + ' <span class="badge badge-danger text-white">Declined</span> ('+answer_data[i].comment+')</p>' +
                                    // '<p>'+answer_data[i].comment+'</p>'
                                    '</div>' +
                                    '<div class="col-4 text-right">' +
                                    '<div class="tempat-submit-ulang-'+i+'">' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' btn btn-sm btn-' + color_yes + ' w-15 item-yes" data="' + answer_data[i].id_answer + '"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' ml-2 btn btn-sm btn-' + color_no + ' w-15 item-no" data="' + answer_data[i].id_answer + '"><i class="fa fa-times" aria-hidden="true"></i> No</button>' +
                                    '</div>' +
                                    // '<div class="col-lg-2 text-right tempat-submit-ulang-'+i+'">' +
                                    '</div>' +
                                    '</div>';
                                    $('#answer-' + answer_data[i].indicator_id).append(answer[i]);
                                } else {
                                    answer[i] =
                                    '<div class="col-lg-12">' +
                                    '<h6>Question #' + (i + 1) + '</h6>' +
                                    '<div class="row">' +
                                    '<div class="col-8">' +
                                    '<p>' + answer_data[i].text + ' </p>' +
                                    // '<p>'+answer_data[i].comment+'</p>'
                                    '</div>' +
                                    '<div class="col-4 text-right">' +
                                    '<div class="tempat-submit-ulang-'+i+'">' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' btn btn-sm btn-' + color_yes + ' w-15 item-yes" data="' + answer_data[i].id_answer + '"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>' +
                                    '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' ml-2 btn btn-sm btn-' + color_no + ' w-15 item-no" data="' + answer_data[i].id_answer + '"><i class="fa fa-times" aria-hidden="true"></i> No</button>' +
                                    '</div>' +
                                    // '<div class="col-lg-2 text-right tempat-submit-ulang-'+i+'">' +
                                    '</div>' +
                                    '</div>';
                                    $('#answer-' + answer_data[i].indicator_id).append(answer[i]);
                                }
                            }
                    }

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        function showAllProgress() {
            //Document Progress
            $.ajax({
                url: '<?php echo base_url() ?>document/countAllDocument/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(progress_data) {
                    var number = progress_data.submission_id;
                    var percent = (number / 50) * 100;
                    $('#progress-count').html(number);
                    $('.progress-bar').css("width", percent + "%");
                },
                error: function() {
                    alert('Error loading data');
                }
            });

            //Initial Score
            $.ajax({
                url: '<?php echo base_url() ?>score/initialScore/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(initial_score) {
                    // okeee
                    if(initial_score.status == 'sukses'){
                        if(initial_score.expire_pembayaran != ''){
                            $('.payment').html(initial_score.expire_pembayaran);
                        } else {
                            $('.payment').html(initial_score.button_payment);
                            snap_token.token = initial_score.snapToken;
                            snap_token.submission_id = initial_score.submission_id;
                            snap_token.total_harga = initial_score.total_harga;
                        }
                    } else {
                        $('.payment').html(initial_score.button_payment);
                    }
                    $('#initial-score').html(initial_score.initial_score);
                },
                error: function() {
                    alert('Error loading data');
                }
            });

            //Submission Info
            $.ajax({
                url: '<?php echo base_url() ?>submission/showChosenSubmission/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(submission_data) {
                    if (submission_data.submission_status_id == 3) {
                        $(".btn-secondary").remove();
                        $(".item-add").remove();
                        $(".submit-all").remove();
                        $(".item-delete").remove();
                    }
                },
                error: function() {
                    alert('Error loading data');
                }
            });

            //Submission per Indicator
            $.ajax({
                url: '<?php echo base_url() ?>submission/submissionPerIndicatorStatus/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(per_indicator_data) {
                    var per_indicator = [''];
                    var i;
                    for (i = 0; i < per_indicator_data.length / 50; i++) {
                        // $('#subperind-' + per_indicator_data[i].indicator_id).append(per_indicator_data[i].name);
                        // if (per_indicator_data[i].comment != '') {
                        //     $('#comment-' + per_indicator_data[i].indicator_id).append('<div class="alert alert-warning" role="alert">' + per_indicator_data[i].comment + '</div>');
                        // }
                        // $('#subperind-' + per_indicator_data[i].indicator_id).addClass("text-bg-" + per_indicator_data[i].color);
                        if (per_indicator_data[i].status > 2) {
                            $(".button-" + per_indicator_data[i].indicator_id).remove();
                            $(".answer-button-" + per_indicator_data[i].indicator_id).removeClass('item-yes').removeClass('item-no');
                            $(".btn-secondary").remove();
                            $(".item-add").remove();
                            $(".submit-all").remove();
                        }
                    }
                    for(j = 0; j < per_indicator_data.length; j++){
                        if(per_indicator_data[j].submission_status_id > 2){
                            if(per_indicator_data[j].status == 1 || per_indicator_data[j].value == '' || per_indicator_data[j].value == 0){
                                var addButton = ' <button type="button" class="btn btn-sm btn-primary item-add button-' + per_indicator_data[j].indicator_id + '" data="' + per_indicator_data[j].indicator_id + '"><i class="fa fa-plus" aria-hidden="true"></i> Add Document</button>';
                                $('.tempat-submit-ulang-'+ j).append(addButton);
                            }   
                        }
                    }
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }
    });

    function snapToken()
    {
        // SnapToken acquired from previous step
        snap.pay(snap_token.token, {
          // Optional
          onSuccess: function(result){
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            let dataResult = JSON.stringify(result, null, 2);
            let dataObj = JSON.parse(dataResult);
            $.ajax({
                type: "post",
                url: '<?php echo base_url() ?>/score/finishMidtrans',
                data: {
                    submission_id: snap_token.submission_id,
                    total_harga: snap_token.total_harga,
                    order_id: dataObj.order_id,
                    payment_type: dataObj.payment_type,
                    transaction_time: dataObj.transaction_time,
                    transaction_status: dataObj.transaction_status,
                    va_number: dataObj.va_numbers[0].va_number,
                    bank: dataObj.va_numbers[0].bank,
                },
                dataType: "json",
                success:function(response){
                    if(response.sukses){
                        swal({title: "Done", text: response.sukses, type: 
                        "success"}).then(function(){ 
                           location.reload();
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
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
    }

    window.onload = function() {
        showAllAspect();
        showAllOutcome();
        showAllPrinciple();
        showAllIndicator(id_submission);
        showAllAnswer();
        showAllDocument();
        showAllProgress();
    };

    function konfirmasi(id, submission){
         swal({
            title: 'Konfirmasi pembayaran Submission '+submission+' ?',
            text : 'Setelah konfirmasi, selanjutnya masuk ke menu See Payment pada tombol See Payment' ,
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
                                $('#modalAddPay #myForm').attr('action', '<?php echo base_url() ?>payment/addPayment');
                                $('#modalAddPay [name="submission_id"]').val(submission);
                                $('#modalAddPay').modal('show');
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

    $('#modalAddPay #btnSave').click(function() {
        var url = $('#modalAddPay #myForm').attr('action');
        var data = $('#modalAddPay #myForm').serialize();
        //validate form
        var documentUpload = $('#modalAddPay input[name=document]');
        var result = '';
        if (documentUpload.val() == '') {
            documentUpload.addClass('is-invalid');
        } else {
            documentUpload.parent().removeClass('is-invalid');
            result += 1;
        }

        if (result == '1') {
            var formData = new FormData($('#modalAddPay #myForm')[0]);
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalAddPay').modal('hide');
                        $('#modalAddPay #myForm')[0].reset();
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

</script>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $client_key ?>"></script>
<script type="text/javascript">
  $(document).delegate("#pay-button", "click", function(e){
    snapToken();
  });
</script>