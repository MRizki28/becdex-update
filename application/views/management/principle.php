<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd" onclick="addPrinciple()"><i class="fa fa-plus" aria-hidden="true"></i> Add Principle</button>
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
                            <th class="text-center">Principle</th>
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
                <h5 class="modal-title">Add Principle</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('management/insertPrinciple') ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="principle_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="outcome_id" aria-label="Floating label select example">
                            <?php foreach ($dataOutcome as $data) { ?>
                                <option value="<?= $data->id_outcome ?>"><?= $data->outcome_name ?></option>
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
                        <input type="text" name="principle_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="outcome_id" aria-label="Floating label select example">
                            <?php foreach ($dataOutcome as $data) { ?>
                                <option value="<?= $data->id_outcome ?>"><?= $data->outcome_name ?></option>
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

    function addPrinciple()
    {
        $('#addModal').modal('show');
    }

    $(function() {
        showAllPrinciple();

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var principleName = $('input[name=principle_name]');
            var result = '';
            if (principleName.val() == '') {
                principleName.addClass('is-invalid');
            } else {
                principleName.parent().removeClass('is-invalid');
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
                            showAllPrinciple();
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
            $('#myModal').find('.modal-title').text('Edit Principle');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/updatePrinciple');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editPrinciple',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=principle_name]').val(data.principle_name);
                    $('select[name=outcome_id]').val(data.outcome_id);
                    $('input[name=Id]').val(data.id_principle);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //function
        function showAllPrinciple() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllPrinciple',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="text-center">' + data[i].id_principle + '</td>' +
                            '<td class="">' + data[i].principle_name + '</td>' +
                            '<td class="">' + data[i].outcome_name + '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_principle + '"><i class="far fa-edit" aria-hidden="true"></i> Edit</button>' +
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
        showAllPrinciple();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>