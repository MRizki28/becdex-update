<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <button type="button" class="btn btn-primary btnAdd" onclick="newDownload()"><i class="fa fa-plus" aria-hidden="true"></i> Add Download</button>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($download as $d) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $d['title']; ?></td>
                        <td><?= $d['file']; ?></td>
                        <td>
                            <button type="button" onclick="editDownload(`<?= $d['id'] ?>`, `<?= $d['title'] ?>`)" class="badge badge-success" style="border: none">edit</button>
                            <button type="button" onclick="deleteDownload(`<?= $d['id'] ?>`,`<?= $d['title'] ?>`)" class="badge badge-danger" style="border: none">delete</button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newDownload" tabindex="-1" role="dialog" aria-labelledby="newDownloadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDownloadLabel">Add Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#newDownload').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" action="<?= base_url('download/addDownload'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#newDownload').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="editDownload" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Edit Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#editDownload').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" action="<?= base_url('download/updateDownload'); ?>" method="post">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editDownload').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
    function newDownload()
    {
        $('#newDownload').modal('show');
    }

    function editDownload(id, title)
    {
        $('#editDownload [name="id"]').val(id);
        $('#editDownload [name="title"]').val(title);
        $('#editDownload').modal('show');
    }

    function deleteDownload(id,title)
    {
        swal({
            title: 'Delete Download '+title+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>download/deleteDownload',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status == 'sukses'){
                            swal({title: "Deleted", text: 'Succesfuly Deleted', type: 
                            "success"}).then(function(){ 
                               location.reload();
                               }
                            );
                        } else {
                            swal({title: "Failed", text: 'Something wrong', type: 
                            "error"}).then(function(){ 
                               location.reload();
                               }
                            );
                        }
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
    }
</script>