<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th>Name</th>
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
                        <input type="text" name="aspect_name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
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
        showAllAspect();

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var aspectName = $('input[name=aspect_name]');
            var result = '';
            if (aspectName.val() == '') {
                aspectName.addClass('is-invalid');
            } else {
                aspectName.parent().removeClass('is-invalid');
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
                            showAllAspect();
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
            $('#myModal').find('.modal-title').text('Edit Aspect');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/updateAspect');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editAspect',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=aspect_name]').val(data.aspect_name);
                    $('input[name=Id]').val(data.id_aspect);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
                }
            });

        });

        //function
        function showAllAspect() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllAspect',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="text-center">' + data[i].id_aspect + '</td>' +
                            '<td class="">' + data[i].aspect_name + '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_aspect + '"><i class="far fa-edit" aria-hidden="true"></i> Edit</button>' +
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
        showAllAspect();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>