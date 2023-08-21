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
                            <th>No</th>
                            <th>Indicator</th>
                            <th class="text-center">Score</th>
                            <th class="text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataIndicator as $data) { ?>
                            <tr>
                                <td><?= $data->id_indicator ?></td>
                                <td><?= $data->indicator_name ?></td>
                                <td class="text-center score" id="score<?= $data->id_indicator ?>"></td>
                                <td class="text-center detail" id="detail<?= $data->id_indicator ?>"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $(function() {
        showAllDocument();

        //function
        function showAllDocument() {
            $.ajax({
                url: '<?php echo base_url() ?>management/showAllDocumentByUser/<?= $id ?>',
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = [''];
                    var i;
                    for (i = 0; i < 50; i++) {

                        html[i] +=
                            '<a class="btn btn-sm btn-info text-white"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</a>' +
                            '<a href="<?= base_url() ?>management/documentByUser/' + data[i].user_id + '" class="btn btn-sm btn-primary text-white" style="margin-left:10px"><i class="fa fa-file" aria-hidden="true"></i> Submission</a>' +
                            '<button class="btn btn-sm btn-warning item-edit" style="margin-left:10px" data="' + data[i].id + '"><i class="far fa-edit" aria-hidden="true"></i> Edit Details</button>' +
                            '<button class="btn btn-sm btn-danger item-delete" style="margin-left:10px" data="' + data[i].id + '"><i class="fa fa-trash" aria-hidden="true"></i> Delete Account</button>';
                        $('#detail' + data[i].principal_id).append(html);
                    }
                    MyTable.fnDestroy();

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
        order: [
            [0, 'asc']
        ],
    });

    window.onload = function() {
        showAllDocument();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable({
            "pageLength": 50,
            order: [
                [0, 'asc']
            ],
        });
    }
</script>