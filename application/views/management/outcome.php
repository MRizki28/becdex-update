<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd" onclick="addOutcome()"><i class="fa fa-plus" aria-hidden="true"></i> Add Outcome</button>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 3%;">No.</th>
                            <th style="width: 60%;">Name</th>
                            <th class="text-center">Aspect</th>
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
                <h5 class="modal-title">Add Outcome</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('management/insertOutcome') ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="outcome_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="aspect_id" aria-label="Floating label select example">
                            <?php foreach ($dataOutcome as $data) { ?>
                                <option value="<?= $data->id_aspect ?>"><?= $data->aspect_name ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Aspect</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
            </div>
            <div class="modal-body">
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <input type="hidden" name="Id" value="0">
                    <div class="form-floating mb-3">
                        <input type="text" name="outcome_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="aspect_id" aria-label="Floating label select example">
                            <?php foreach ($dataOutcome as $data) { ?>
                                <option value="<?= $data->id_aspect ?>"><?= $data->aspect_name ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Aspect</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<script>
    function addOutcome()
    {
        $('#addModal').modal('show');
    }

    $(function() {
        showAllOutcome();

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var outcomeName = $('input[name=outcome_name]');
            var result = '';
            if (outcomeName.val() == '') {
                outcomeName.addClass('is-invalid');
            } else {
                outcomeName.parent().removeClass('is-invalid');
                result += 1;
            }

            if (result == '1') {
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#myModal').modal('hide');
                            $('#myForm')[0].reset();
                            if (response.type == 'add') {
                                var type = 'added';
                            } else if (response.type == 'edit') {
                                var type = 'edited';
                            }
                            swal('Done', 'Successfully ' + type + '!', 'success');
                            showAllOutcome();
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

        //edit
        $(document).on('click', '.item-edit', function() {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Outcome');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/updateOutcome');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editOutcome',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=outcome_name]').val(data.outcome_name);
                    $('select[name=aspect_id]').val(data.aspect_id);
                    $('input[name=Id]').val(data.id_outcome);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //function
        function showAllOutcome() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllOutcome',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="text-center">' + data[i].id_outcome + '</td>' +
                            '<td class="">' + data[i].outcome_name + '</td>' +
                            '<td class="">' + data[i].aspect_name + '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_outcome + '"><i class="far fa-edit" aria-hidden="true"></i> Edit</button>' +
                            '</td>' +
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
        showAllOutcome();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>