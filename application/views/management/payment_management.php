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

        //accept
        $(document).on('click', '.item-accept', function() {
            var id = $(this).attr('data');
            swal({
                    title: 'Accept Payment?',
                    icon: 'info',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>payment/acceptPayment',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Payment Accepted!', {
                                    icon: 'success',
                                });
                                showAllPayment();
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

        //function
        function showAllPayment() {
            $.ajax({
                url: '<?php echo base_url() ?>payment/showAllReadyPayment',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            var split = data[i]['file'].split('.');

                            if(split[1] == 'pdf'){
                                html += '<div class="card mb-2">' +
                                '<div class="card-header">Payment</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Payment for Submission ID #' + data[i].id_submission + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<p class="card-text">Company Name : <strong>' + data[i].name + '</strong></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2 text-right">' +
                                '<button class="btn btn-success btn-sm item-accept text-white mr-2" data="' + data[i].id_payment + '"><i class="fa fa-check" aria-hidden="true"></i></button>' +
                                '<button class="btn btn-warning btn-sm item-view text-white" data="' + data[i].id_payment + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted">' + data[i].upload_date + '</div>' +
                                '</div>';
                            } else {
                                 html += '<div class="card mb-2">' +
                                '<div class="card-header">Payment</div>' +
                                '<div class="card-body">' +
                                '<div class="row">' +
                                '<div class="col-lg-10">' +
                                '<div class="col-lg-12 mb-2">' +
                                '<h5 class="card-title">Payment for Submission ID #' + data[i].id_submission + '</h5>' +
                                '</div>' +
                                '<div class="col-lg-12 mb-2">' +
                                '<p class="card-text">Company Name : <strong>' + data[i].name + '</strong></p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-lg-2 text-right">' +
                                '<a href="<?= base_url('document/payment/') ?>'+data[i]['file']+'" title="File"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card-footer text-muted">' + data[i].upload_date + '</div>' +
                                '</div>';
                            }
                        }
                    } else {
                        html += '<div class="row text-center">' +
                            '<div class="col-lg-12">' +
                            '<div class="card w-100">' +
                            '<div class="card-body">' +
                            '<img class="card-img-top w-25" src="<?= base_url() ?>svgs/user-index.svg" class="w-25">' +
                            '<p class="card-text">No Payment</p>' +
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