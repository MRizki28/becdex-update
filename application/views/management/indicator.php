<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered " style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 3%;">No.</th>
                            <th style="width: 20%;">Name</th>
                            <th style="">Description</th>
                            <th class="text-center" style="width: 10%;">Aspect</th>
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
                        <input type="text" name="indicator_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="principle_id" aria-label="Floating label select example">
                            <?php foreach ($dataPrinciple as $data) { ?>
                                <option value="<?= $data->id_principle ?>"><?= $data->principle_name ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Aspect</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="indicator_desc" id="floatingTextarea2" style="height: 100px" wrap="soft"></textarea>
                        <label for="floatingTextarea2">Description</label>
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
    $(function() {
        showAllIndicator();

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var indicatorName = $('input[name=indicator_name]');
            var result = '';
            if (indicatorName.val() == '') {
                indicatorName.addClass('is-invalid');
            } else {
                indicatorName.parent().removeClass('is-invalid');
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
                            showAllIndicator();
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
            $('#myModal').find('.modal-title').text('Edit Indicator');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/updateIndicator');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editIndicator',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                  $('input[name=indicator_name]').val(data.indicator_name);
                    $('select[name=principle_id]').val(data.principle_id);
                    $('input[name=Id]').val(data.id_indicator);
                    $('textarea[name=indicator_desc]').val(data.indicator_desc.replace(/<br\s*\/?>/gi, ""));
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //function
        function showAllIndicator() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllIndicator',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="text-center">' + data[i].id_indicator + '</td>' +
                            '<td class="">' + data[i].indicator_name + '</td>' +
                         '<td class="">' + data[i].indicator_desc.replace(/\r\n/g, "<br>") + '</td>' +
                            '<td class="">' + data[i].principle_name + '</td>' +
                            '<td class="text-center">' +
                            '<a href="<?= base_url() ?>/management/question/' + data[i].id_indicator + '" class="btn btn-info mb-2 w-100"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br>' +
                            '<button class="btn btn-warning item-edit w-100" data="' + data[i].id_indicator + '"><i class="far fa-edit" aria-hidden="true"></i></button>' +
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

    var MyTable = $('#myTable').dataTable({
        "pageLength": 50,
    });

    window.onload = function() {
        showAllIndicator();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({
            "pageLength": 50,
        });
    }
</script>