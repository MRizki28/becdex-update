<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row mb-2">
        <div class="col-lg-10">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> for Submission: #<?= $id ?></h1>
        </div>
        <div class="col-lg-2 text-right">
            <button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> New Payment</button>
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
                <div class="mb-3 row">
                    <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                        <label for="staticEmail" class="col-sm-4 col-form-label">Submission ID :</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" name="submission_id" value="<?= $id ?>">
                        </div>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file" name="document" id="formFile" accept="application/pdf">
                    <div class="invalid-feedback">
                        Please insert file.
                    </div>
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


<script>
    $(function() {
        showAllPayment();

        //add New
        $('.btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#modalAdd').modal('show');
            $('#modalAdd').find('.modal-title').text('New Payment');
            $('#myForm').attr('action', '<?php echo base_url() ?>payment/addPayment');
        });

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
                            swal('Done', 'Successfully ' + type + '!', 'success');
                            showAllPayment();
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

        //view
        $(document).on('click', '.item-view', function() {
            var id = $(this).attr('data');
            $('#modalView').modal('show');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>payment/viewPayment',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('iframe').attr("src", "<?= base_url() ?>document/payment/" + data.file);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //function
        function showAllPayment() {
            $.ajax({
                url: '<?php echo base_url() ?>payment/showAllPaymentById/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {

                            html += '<div class="card mb-2">' +
                                '<div class="card-header">Payment</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<span class="badge rounded-pill text-bg-' + data[i].status_color + '">' + data[i].status_name + '</span>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Payment #' + (i + 1) + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2 text-right">' +
                                '<button class="btn btn-warning btn-sm item-view text-white" data="' + data[i].id_payment + '"><i class="fa fa-eye" aria-hidden="true"></i></a><br>' +
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
                            '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/no-payment.svg" class="w-25">' +
                            '<h5 class="card-title mt-3">No Payment</h5>' +
                            '<p class="card-text">Upload your payment for this submission to get verified!</p>' +
                            '<button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> New Payment</button>' +
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
        showAllPayment();
    };
</script>