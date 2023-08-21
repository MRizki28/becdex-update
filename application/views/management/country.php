<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add Country</button>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th>Name</th>
                            <th style="width: 15%;">ISO</th>
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

<!-- Modal -->
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
                        <input type="text" name="iso" class="form-control" id="floatingInput">
                        <label for="floatingInput">ISO</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nicename" class="form-control" id="floatingInput">
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
        showAllCountry();

        //add New
        $('.btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add Country');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/addCountry');
        });

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var countryName = $('input[name=country_name]');
            var result = '';
            if (countryName.val() == '') {
                countryName.addClass('is-invalid');
            } else {
                countryName.parent().removeClass('is-invalid');
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
                            showAllCountry();
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
            $('#myModal').find('.modal-title').text('Edit Country');
            $('#myForm').attr('action', '<?php echo base_url() ?>management/updateCountry');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>management/editCountry',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=iso]').val(data.iso);
                    $('input[name=nicename]').val(data.nicename);
                    $('input[name=Id]').val(data.id_country);
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
                    title: 'Delete Country?',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>management/deleteCountry',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Deleted!', {
                                    icon: 'success',
                                });
                                showAllCountry();
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
        function showAllCountry() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllCountry',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td>' + data[i].id_country + '</td>' +
                            '<td class="">' + data[i].nicename + '</td>' +
                            '<td class="">' + data[i].iso + '</td>' +
                            '<td class="">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_country + '"><i class="far fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete ml-2" data="' + data[i].id_country + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
    });

    var MyTable = $('#myTable').dataTable({});

    window.onload = function() {
        showAllCountry();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>