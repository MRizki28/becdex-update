<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <button type="button" class="btn btn-primary btnAdd" onclick="newMenu()"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</button>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <button type="button" onclick="editMenu(`<?= $m['id'] ?>`, `<?= $m['menu'] ?>`)" class="badge badge-success" style="border: none">edit</button>
                            <button type="button" onclick="deleteMenu(`<?= $m['id'] ?>`,`<?= $m['menu'] ?>`)" class="badge badge-danger" style="border: none">delete</button>
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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#newMenuModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/addMenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#newMenuModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#editMenuModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/updateMenu'); ?>" method="post">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#editMenuModal').modal('hide');" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
    function newMenu()
    {
        $('#newMenuModal').modal('show');
    }

    function editMenu(id, menu)
    {
        $('#editMenuModal [name="id"]').val(id);
        $('#editMenuModal [name="menu"]').val(menu);
        $('#editMenuModal').modal('show');
    }

    function deleteMenu(id,menu)
    {
        swal({
            title: 'Delete Menu '+menu+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>menu/deleteMenu',
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
                            swal({title: "Failed", text: 'This menu already has a submenu', type: 
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