<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Aksi</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Email</th>
                            <!-- <th>Phone Number</th> -->
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
<!-- /.container-fluid -->
<div id="terimaModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accept User</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="<?= base_url('management/acceptUser') ?>" method="post">
                    <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" id="name" type="text" readonly>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" id="email" type="email" readonly>
                </div>
                <div class="form-group">
                    <label for="">Field</label>
                    <input class="form-control" id="field" type="text" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Email</label>
                    <input class="form-control" id="pic_email" type="email" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Phone</label>
                    <input class="form-control" id="pic_phone" type="number" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Position</label>
                    <input class="form-control" id="pic_position" type="text" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Accept</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="tolakModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject User</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="<?= base_url('management/rejectUser') ?>" method="post">
                    <input type="hidden" name="id" id="id_edit">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" id="name_edit" type="text" readonly>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" id="email_edit" type="email" readonly>
                </div>
                <div class="form-group">
                    <label for="">Field</label>
                    <input class="form-control" id="field_edit" type="text" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Email</label>
                    <input class="form-control" id="pic_email_edit" type="email" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Phone</label>
                    <input class="form-control" id="pic_phone_edit" type="number" readonly>
                </div>
                <div class="form-group">
                    <label for="">PIC Position</label>
                    <input class="form-control" id="pic_position_edit" type="text" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<script>
    function accept(id_user, name, email, company_phone, field_name, pic_email, pic_phone, pic_position)
    {
        $('#terimaModal #id').val(id_user);
        $('#terimaModal #name').val(name);
        $('#terimaModal #email').val(email);
        $('#terimaModal #field').val(field_name);
        $('#terimaModal #pic_email').val(pic_email);
        $('#terimaModal #pic_phone').val(pic_phone);
        $('#terimaModal #pic_position').val(pic_position);
        $('#terimaModal').modal('show');
    }

    function reject(id_user, name, email, company_phone, field_name, pic_email, pic_phone, pic_position)
    {
        $('#tolakModal #id_edit').val(id_user);
        $('#tolakModal #name_edit').val(name);
        $('#tolakModal #email_edit').val(email);
        $('#tolakModal #field_edit').val(field_name);
        $('#tolakModal #pic_email_edit').val(pic_email);
        $('#tolakModal #pic_phone_edit').val(pic_phone);
        $('#tolakModal #pic_position_edit').val(pic_position);
        $('#tolakModal').modal('show');
    }

    $(function() {
        showAllUser();

        //function
        function showAllUser() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllUserNotVerif',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="">' + 
                            '<button class="btn btn-success item-edit ml-2" onclick="accept(`'+data[i].user_id+'`, `'+data[i].name+'`, `'+data[i].email+'`, `'+data[i].company_phone+'`, `'+data[i].field_name+'`, `'+data[i].pic_email+'`, `'+data[i].pic_phone+'`, `'+data[i].pic_position+'`)">Accept</button> <br><br>' +
                            '<button class="btn btn-danger item-delete ml-2" onclick="reject(`'+data[i].user_id+'`, `'+data[i].name+'`, `'+data[i].email+'`, `'+data[i].company_phone+'`, `'+data[i].field_name+'`, `'+data[i].pic_email+'`, `'+data[i].pic_phone+'`, `'+data[i].pic_position+'`)">Reject</button>' +
                            '</td>'+
                            '<td class="">' + data[i].name + '</td>' +
                            '<td class="">' + data[i].nicename + '</td>' +
                            '<td class="">' + data[i].email + '</td>' +
                            // '<td class="">' + data[i].company_phone + '</td>' +
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