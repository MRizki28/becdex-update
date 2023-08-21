<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <button type="button" class="btn btn-primary btnAdd" onclick="newRole()"><i class="fa fa-plus" aria-hidden="true"></i> Add New Role</button>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $r['role']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">access</a>
                            <button type="button" onclick="editRole(`<?= $r['id'] ?>`, `<?= $r['role'] ?>`)" class="badge badge-success" style="border: none">edit</button>
                            <button type="button" onclick="deleteRole(`<?= $r['id'] ?>`,`<?= $r['role'] ?>`)" class="badge badge-danger" style="border: none">delete</button>
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
<div class="modal fade" id="newRoleModal" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" onclick="$('#newRoleModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addRole'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#newRoleModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="editRoleModal" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Edit Role</h5>
                <button type="button" class="close" onclick="$('#editRoleModal').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/updateRole'); ?>" method="post">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#editRoleModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
    function newRole()
    {
        $('#newRoleModal').modal('show');
    }

    function editRole(id, role)
    {
        $('#editRoleModal [name="id"]').val(id);
        $('#editRoleModal [name="role"]').val(role);
        $('#editRoleModal').modal('show');
    }

    function deleteRole(id,role)
    {
        swal({
            title: 'Delete Role '+role+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>admin/deleteRole',
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
                            swal({title: "Failed", text: 'This role already has a menu', type: 
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