<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd" onclick="addCertificate()"><i class="fa fa-plus" aria-hidden="true"></i> Add Certificate</button>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>File</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Certificate</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="<?= base_url('management/addCertificate') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id">
                    <input type="hidden" name="gambar_lama">
                    <div class="form-group">
                        <label for="">Category Certificate</label>
                        <select required name="category" class="form-control">
                            <option value="">- Choose Category -</option>
                            <option value="standard">Standard</option>
                            <option value="good">Good</option>
                            <option value="excellent">Excellent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Sertifikat">
                    </div>
                    <div class="form-group">
                        <label for="">File Certificate Potrait (Only JPG)</label>
                        <input type="file" accept=".jpg" required name="file_certificate" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Certificate</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="<?= base_url('management/updateCertificate') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id">
                    <input type="hidden" name="gambar_lama">
                    <div class="form-group">
                        <label for="">Category Certificate</label>
                        <select required name="category" class="form-control">
                            <option value="">- Choose Category -</option>
                            <option value="standard">Standard</option>
                            <option value="good">Good</option>
                            <option value="excellent">Excellent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Sertifikat">
                    </div>
                    <div class="form-group">
                        <label for="">File Certificate Potrait (Only JPG)</label>
                        <input type="file" accept=".jpg" required name="file_certificate" class="form-control">
                    </div>
                    <div class="preview-img"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<script>
    function addCertificate()
    {
        $('#addModal').modal('show');
    }

    $(function() {
        showAllCertificate();

        //function
        function showAllCertificate() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllCertificate',
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td><img width="300" src="<?= base_url() ?>assets/img/certificate/' + data[i].file + '"></td>' +
                            '<td class="">' + data[i].kategori + '</td>' +
                            '<td class="">' + data[i].keterangan + '</td>' +
                            '<td class="">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_certificate + '"><i class="far fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete ml-2" data="' + data[i].id_certificate + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                            '</td>' +
                            '</tr>';
                    }
                    MyTable.fnDestroy();
                    $('#show_data').html(html);
                    refresh();

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        }

        //edit
        $(document).on('click', '.item-edit', function() {
            $('.preview-img').empty();
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Certificate');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editCertificate',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('#myModal [name="id"]').val(data.id_certificate);
                    $('#myModal [name="category"]').val(data.kategori);
                    $('#myModal [name="file_certificate"]').removeAttr('required');
                    $('#myModal [name="gambar_lama"]').val(data.file);
                    $('#myModal [name="keterangan"]').val(data.keterangan);
                    $('.preview-img').append('<p>Previous Image: </p><img width="200" src="<?= base_url() ?>assets/img/certificate/'+data.file+'" alt="">');
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
                    title: 'Delete Certificate?',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>management/deleteCertificate',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Deleted!', {
                                    icon: 'success',
                                });
                                showAllCertificate();
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
    });

    var MyTable = $('#myTable').dataTable({});

    window.onload = function() {
        showAllCertificate();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>