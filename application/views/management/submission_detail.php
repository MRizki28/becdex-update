<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="row mb-2">
        <div class="col-lg-8">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <?php if ($cek_certificate > 0): ?>
            <div class="col-lg-4 text-white text-center">
                <h3 class="bg-dark">certificate has been sent !</h3>
            </div>
        <?php endif ?>
    </div>

    <?php if ($submission_detail['qr_code_alamat'] <> null): ?>
    <div class="row mb-2">
        <div class="col-lg-8">
            &nbsp;
        </div>
        <div class="col-lg-4 text-white text-center">
            <h3 class="bg-secondary">qrcode has been sent !</h3>
        </div>
    </div>
    <?php endif ?>

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
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Initial Score : </small><span><?= $submission_detail['initial_score'] ?></span><small class="text-muted fw-light">/100</small></h6>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Valid Score : </small><span id="valid-score">0</span><small class="text-muted fw-light">/100</small></h6>
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
                        <div class="col-12 mt-2">
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
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">Next Appointment : </small></h6>
                        </div>
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title p-0 mb-0 latest-loc"><button type="button" class="btn btn-transparent btn-sm mr-2 locsurvey p-0"><i class="fa fa-info-circle" aria-hidden="true"></i></button></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-12 text-right">
            <button type="button" class="btn btn-warning" onclick="repostSubmission(`<?= $submission_detail['id_submission'] ?>`,`<?= $submission_detail['initial_score'] ?>`)"> <i class="fa fa-history" aria-hidden="true"></i> Repost Submission </button>
            <button type="button" class="btn btn-primary addlocsurvey"><i class="fa fa-plus" aria-hidden="true"></i> Location Survey Schedule</button>
            <button type="button" onclick="generateCertificate(`<?= $submission_detail['id_submission'] ?>`,`<?= $submission_detail['initial_score'] ?>`)" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Generate Certificate</button>
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

<!-- Modal Decline -->
<div class="modal fade" id="modalDecline" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <input type="hidden" name="Id" value="0">
                    <div class="form-floating mb-3">
                        <input type="text" name="comment" class="form-control" id="floatingInput">
                        <label for="floatingInput">Comment</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal All Location Survey -->
<div class="modal fade" id="modalAllSurvey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Location Survey Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Location Survey Schedule</th>
                                <th>Keterangan</th>
                                <th class="text-center" style="width: 10%;">Link</th>
                            </tr>
                        </thead>
                        <tbody id="show_data_survey">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Location Survey -->
<div class="modal fade" id="modalRepostSubmission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Repost Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('submission/repostSubmission/'.$submission_detail['id_submission'].'/17') ?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="" class="repost-submission-id"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="repost-submission-initial_score"></label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="repost-submission-valid_score"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Reason <span class="text-danger">*</span></label>
                        <textarea name="reason" required id="reason" cols="30" rows="4" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" value="repost-submission" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Location Survey -->
<div class="modal fade" id="modalAddSurvey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Location Survey Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myFormLoc" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <div class="form-floating mb-3">
                        <input type="date" name="date" class="form-control" id="floatingInput">
                        <label for="floatingInput">Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" name="time" class="form-control" id="floatingInput">
                        <label for="floatingInput">Time</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="link" class="form-control" id="floatingInput">
                        <label for="floatingInput">Link</label>
                    </div>
                    <div class="form-floating-mb-3">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" cols="10" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSaveLoc" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate -->
<div class="modal fade" id="modalGenerate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form target="_blank" action="<?= base_url('management/cetak_certificate/'.$submission_detail['id_submission'].'/17') ?>" method="get">
                    <input type="hidden" name="id_user">
                <div class="mb-3 row text-center">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <img class="card-img-top w-50" src="<?= base_url() ?>svgs/no-payment.svg">
                            <p class="submission-id"></p>
                            <h5 class="card-title mt-3">Generate Certificate?</h5>
                            <p class="card-text">This submission score is : </p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Initial Score: <span class="score-submis"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Valid Score: <span class="score-valid"></span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Choose Category Certificate: <span class="text-danger">*</span></label>
                                        <select required name="category_certificate" class="form-control">
                                            <option value="">- Choose -</option>
                                            <?php foreach ($category_certificate as $key => $value): ?>
                                                <option value="<?= $value->id_certificate ?>"><?= ucwords($value->kategori).' | Keterangan: '.$value->keterangan ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Choose Becdex Category: <span class="text-danger">*</span></label>
                                        <select required name="category_becdex" class="form-control">
                                            <option value="">- Choose -</option>
                                            <?php foreach ($becdex_cat as $key => $value): ?>
                                                <option value="<?= $value->id_becdex_cat ?>">Max Score: <?= $value->max_score ?>, Category: <?= $value->becdex_cat_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Published date: <span class="text-danger">*</span></label>
                                        <input required type="date" class="form-control" name="published_date">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">MMIC: <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" name="mmic">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" name="send" class="btn btn-primary">Checklist Certification</button> 
                <button type="button" class="btn btn-info" onclick="addQrCode()"><i class="fa fa-plus" aria-hidden="true"></i> Upload QR Code Alamat</button>
                <button type="submit" name="preview" class="btn btn-success">Download</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate -->
<div class="modal fade" id="modalQrCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submission <?= $submission_detail['id_submission'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= base_url('management/uploadQrCodeAlamat/17') ?>" method="post">
                <input type="hidden" name="id_submission" value="<?= $submission_detail['id_submission'] ?>">
                <p>
                    Scan the link below to make a qrcode
                    <h6 class="bg-secondary text-white"><?php echo base_url('home/company_verified/'.$submission_detail['user_id']) ?></h6>
                </p>
                <p>
                    Upload QR Code Address (JPG)
                </p>
                <input type="file" accept=".jpg" name="qrcode_alamat" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var id_submission = `<?= $submission_detail['id_submission'] ?>`;

    function addQrCode()
    {
        $('#modalGenerate').modal('hide');
        $('#modalQrCode').modal('show');
    }

    function repostSubmission(id, initial_score)
    {
        $('#modalRepostSubmission .repost-submission-id').text('ID Submission: '+ id);
        $('#modalRepostSubmission .repost-submission-initial_score').text('Initial Score: '+initial_score);
        $.ajax({
            url: '<?php echo base_url() ?>score/validScore/'+id,
            async: false,
            dataType: 'json',
            success: function(data) {
                $('#modalRepostSubmission .repost-submission-valid_score').text('Valid Score: '+data);
            },
            error: function() {
                alert('Error loading data');
            }
        });
        $('#modalRepostSubmission').modal('show');
    }

    function generateCertificate(id, initial_score)
    {
        $('#modalGenerate .submission-id').text('ID Submission: '+ id);
        $('#modalGenerate .score-submis').text(initial_score);
         $.ajax({
            url: '<?php echo base_url() ?>score/validScore/'+id,
            async: false,
            dataType: 'json',
            success: function(data) {
                $('#modalGenerate .score-valid').text(data);
            },
            error: function() {
                alert('Error loading data');
            }
        });
        $('#modalGenerate').modal('show');
    }

    $(function() {
        showAllAspect();
        showAllOutcome();
        showAllPrinciple();
        showAllIndicator(id_submission);
        showAllAnswer();
        showAllDocument();
        showAllProgress();

        //generate
        $(document).on('click', '#generate', function() {
            var id = $(this).attr('data');
            $('#modalGenerate').modal('show');
            $.ajax({
                url: '<?php echo base_url() ?>management/showThisSubmission/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="">' + data[i].datetime + '</td>' +
                            '<td class="">' + data[i].keterangan + '</td>' +
                            '<td class="text-center"><a class="btn btn-primary btn-sm" target="_blank" href="//' + data[i].link + '" role="button">Link</a></td>' +
                            '</tr>';
                    }
                    MyTable.fnDestroy();
                    $('#show_data_survey').html(html);
                    refresh();

                },
                error: function() {
                    alert('Error loading data');
                }
            });
            $('#modalGenerate').on('click', '#btnGenerate', function() {
                window.location.href = '<?php echo base_url() ?>management/generateCertificate/<?= $id ?>';
            });

        });

        //add location survey
        $(document).on('click', '.addlocsurvey', function() {
            $('#modalAddSurvey').modal('show');
            $('#myFormLoc').attr('action', '<?php echo base_url() ?>management/addLocationSurvey/<?= $id ?>');
        });

        $('#btnSaveLoc').click(function() {
            var url = $('#myFormLoc').attr('action');
            var data = $('#myFormLoc').serialize();
            console.log(data);
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalAddSurvey').modal('hide');
                        $('#myFormLoc')[0].reset();
                        if (response.type == 'add') {
                            var type = 'added';
                        } else if (response.type == 'edit') {
                            var type = 'edited';
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
        });

        //all location survey
        $(document).on('click', '.locsurvey', function() {
            var id = $(this).attr('data');
            $('#modalAllSurvey').modal('show');
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllLocationSurveyBySubmission/<?= $id ?>'+'/17',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="">' + data[i].datetime + '</td>' +
                            '<td class="">' + data[i].keterangan + '</td>' +
                            '<td class="text-center"><a class="btn btn-primary btn-sm" target="_blank" href="//' + data[i].link + '" role="button">Link</a></td>' +
                            '</tr>';
                    }
                    MyTable.fnDestroy();
                    $('#show_data_survey').html(html);
                    refresh();

                },
                error: function() {
                    alert('Error loading data');
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

        //answer yes
        $(document).on('click', '.item-yes', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>answer/validAnswerYes',
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

        //save
        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalDecline').modal('hide');
                        $('#myForm')[0].reset();
                        if (response.type == 'add') {
                            var type = 'added';
                        } else if (response.type == 'edit') {
                            var type = 'edited';
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
        });

        //answer no
        $(document).on('click', '.item-no', function() {
            var id = $(this).attr('data');
            var ind = $(this).attr('data_ind');
            $('#modalDecline').modal('show');
            $('#modalDecline').find('.modal-title').text('Decline Indicator Submission');
            $('#myForm').attr('action', '<?php echo base_url() ?>answer/validAnswerNo');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>submission/showperIndicator/<?= $submission_detail['id_submission'] ?>',
                data: {
                    id: id,
                    ind: ind
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=comment]').val(data.comment);
                    $('input[name=Id]').val(id);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });
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
                        indicator[i] =
                            '<div class="accordion-item">' +
                            '<h2 class="accordion-header">' +
                            '<button class="accordion-button" type="button" data-bs-toggle="collapse">' +
                            indicator_data[i].id_indicator + '. ' + indicator_data[i].indicator_name +
                            '<span id="subperind-' + indicator_data[i].id_indicator + '" class="badge text-bg-primary ml-2"></span></button>' +
                            '</h2>' +
                            '<div class="accordion-collapse collapse show" data-bs-parent="#accordionExample">' +
                            '<div class="accordion-body">' +
                            '<div class="row">' +
                            '<div class="col-lg-12 mb-5 p-0" id="answer-' + indicator_data[i].id_indicator + '">' +
                            '</div>' +
                            '<div class="col-lg-12 mb-1 p-0">' +
                            '<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">' +
                            '</div>' +
                            '<div class="col-12 px-0" id="indicator-' + indicator_data[i].id_indicator + '">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('#principle-' + indicator_data[i].principle_id).append(indicator[i]);
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
                        if (answer_data[i].value == 1 || answer_data[i].value == '') {
                            switch (answer_data[i].valid_value) {
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
                            answer[i] =
                                '<div class="col-lg-12">' +
                                '<h6>Question #' + (i + 1) + '</h6>' +
                                '<div class="row">' +
                                '<div class="col-8">' +
                                '<p>' + answer_data[i].text + '</p>' +
                                '</div>' +
                                '<div class="col-4 text-right">' +
                                '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' btn btn-sm btn-' + color_yes + ' w-15 item-yes" data="' + answer_data[i].id_answer + '"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>' +
                                '<button type="button" class="answer-button-' + answer_data[i].indicator_id + ' ml-2 btn btn-sm btn-' + color_no + ' w-15 item-no" data="' + answer_data[i].id_answer + '" data_ind="' + answer_data[i].indicator_id + '"><i class="fa fa-times" aria-hidden="true"></i> No</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('#answer-' + answer_data[i].indicator_id).append(answer[i]);
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

            //Valid Score
            $.ajax({
                url: '<?php echo base_url() ?>score/validScore/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(valid_score) {
                    $('#valid-score').html(valid_score);
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
                    $('#initial-score').html(initial_score);
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
                    for (i = 0; i < per_indicator_data.length; i++) {
                        $('#subperind-' + per_indicator_data[i].indicator_id).append(per_indicator_data[i].name);
                        $('#subperind-' + per_indicator_data[i].indicator_id).addClass("text-bg-" + per_indicator_data[i].color);
                    }
                },
                error: function() {
                    alert('Error loading data');
                }
            });

            //Location Survey
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllLocationSurveyBySubmission/<?= $id ?>'+'/17',
                async: false,
                dataType: 'json',
                success: function(latest_loc) {
                    $('.latest-loc').append(latest_loc[0].datetime);
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }
    });

    var MyTable = $('#myTable').dataTable({});

    window.onload = function() {
        showAllAspect();
        showAllOutcome();
        showAllPrinciple();
        showAllIndicator(id_submission);
        showAllAnswer();
        showAllDocument();
        showAllProgress()
    };

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>