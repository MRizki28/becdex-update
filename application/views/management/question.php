<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-lg-6 text-right">
            <button type="button" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> Add Question</button>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="">Indicator</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title pricing-card-title"><small class="text-muted fw-light">ID : </small><?= $myIndicator['indicator_name'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered " style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 3%;">No.</th>
                            <th style="width: 60%;">Text</th>
                            <th class="text-center">Indicator</th>
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
                        <select class="form-select" id="floatingSelect" name="indicator_id" aria-label="Floating label select example">
                            <?php foreach ($dataIndicator as $data) { ?>
                                <option value="<?= $data->id_indicator ?>"><?= $data->indicator_name ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Indicator</label>
                    </div>
                     <div class="form-floating mb-3">
                        <textarea class="form-control" name="text" id="floatingInput" style="height: 100px" wrap="soft"></textarea>
                        <label for="floatingInput">Text</label>
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
        showAllQuestion();

        //add New
        $('.btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add Question');
            $('select[name=indicator_id]').val(<?= $id ?>);
            $('#myForm').attr('action', '<?php echo base_url() ?>question/addQuestion');
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
            //save
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
                            showAllQuestion();
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
            $('#myModal').find('.modal-title').text('Edit Question');
            $('#myForm').attr('action', '<?php echo base_url() ?>question/updateQuestion');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>question/editQuestion',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                 success: function(data) {
                    console.log(data);
                    $('input[name=indicator_id]').val(data.indicator_id);
                    $('textarea[name=text]').val(data.text.replace(/<br\s*\/?>/gi, ""));

                    $('input[name=Id]').val(data.id_question);
                    $('select[name=indicator_id]').val(data.indicator_id);
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
                    title: 'Delete Question?',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>question/deleteQuestion',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Deleted!', {
                                    icon: 'success',
                                });
                                showAllQuestion();
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
        function showAllQuestion() {
            $.ajax({
                url: '<?php echo base_url() ?>question/showAllQuestionByIndicator/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td class="">' + data[i].text.replace(/\r\n/g, "<br>") + '</td>' +
                            '<td class="">' + data[i].indicator_name + '</td>' +
                            '<td class="">' +
                            '<button class="btn btn-warning item-edit ml-2" data="' + data[i].id_question + '"><i class="far fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete ml-2" data="' + data[i].id_question + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
        showAllQuestion();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({});
    }
</script>