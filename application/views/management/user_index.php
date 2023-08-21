<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <div class=" text-left">
            <a class="btn btn-primary btn-md " href="<?= base_url('management/userManagementHelp') ?>">Show all message <span class="badge-danger">&nbsp;&nbsp;<?= $total_message ?>&nbsp;&nbsp;</span></a>
        </div>
        </div>
       
       
        
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="text-right">
            <a class="btn btn-primary btn-md w-100" href="<?= base_url('management/userManagementNotVerif') ?>">Verification User Register <span class="badge-danger">&nbsp;&nbsp;<?= $user_belum_verif ?>&nbsp;&nbsp;</span></a>
        </div><br>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Field</th>
                            <th>PIC Name</th>
                            <th>PIC Email</th>
                            <th>PIC Phone</th>
                            <th>PIC Position</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Company Name</h5>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $(function() {
        showAllUser();

        //function
        function showAllUser() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllUser',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="">' + data[i].name + ' <br> <a target="_blank" href="<?= base_url() ?>assets/img/legal_documents/'+data[i].legal_documents+'">Legal Documents </a> <br><br> <a target="_blank" href="<?= base_url() ?>assets/img/organizational_chart/'+data[i].organizational_chart+'">Organizational Chart </a> <br> </td>' +
                            '<td class="">' + data[i].nicename + '</td>' +
                            '<td class="">' + data[i].email + '</td>' +
                            '<td class="">' + data[i].company_phone + '</td>' +
                            '<td class="">' + data[i].field_name + '</td>' +
                            '<td class="">' + data[i].pic_name + '</td>' +
                            '<td class="">' + data[i].pic_email + '</td>' +
                            '<td class="">' + data[i].pic_phone + '</td>' +
                            '<td class="">' + data[i].pic_position + '</td>' +
                            '</td>';
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
    });

    var MyTable = $('#myTable').dataTable({});

    window.onload = function() {
        showAllUser();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>