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

                            <th>Nama</th>
                            <th>Email</th>
                            <th>Whatsapp Number</th>
                            <th>Jenis </th>
                            <th>Detail</th>
                            <th>Aksi</th>
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

<!-- End of Main Content -->
<script>
    $(function() {
        showAllHelp();

        //function
        function showAllHelp() {
    $.ajax({
        url: '<?php echo base_url() ?>management/showAllHelp',
        async: false,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var html = '';
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + data[i].nama + '</td>' +
                        '<td class="">' + data[i].email + '</td>' +
                        '<td class="">' + data[i].no_whatsapp + '</td>' +
                        '<td class="">' + data[i].jenis_masalah + '</td>' +
                        '<td style="width: 30%">' + data[i].detail + '</td>' +
                        '<td class="">' +
                        '<button class="btn btn-danger btn-sm item-delete" data="' + data[i].id + '">' +
                        '<i class="fa fa-trash"></i> Delete' +
                        '</button>' +
                        '</td>' +
                        '</tr>';
                }
            } else {
                html += '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
            }
            $('#show_data').html(html);
        },
        error: function() {
            alert('Error loading data');
        }
    });
}


        //delete
        $(document).on('click', '.item-delete', function() {
            var id = $(this).attr('data');
            swal({
                    title: 'Delete Message?',
                    icon: 'error',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'get',
                            async: false,
                            url: '<?php echo base_url() ?>Help_controller/hapus_data',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                swal('Deleted!', {
                                    icon: 'success',
                                });
                                showAllHelp();
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
</script>
