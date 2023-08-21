<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg-7">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <button type="button" class="btn btn-primary btnAdd" onclick="addUser()"><i class="fa fa-plus" aria-hidden="true"></i> Add User</button>
            <br><br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Password Default</th>
                        <th scope="col">Tanggal Terdaftar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php $no = 1; ?>
                   <?php foreach ($data as $key => $value): ?>
                       <tr>
                           <td><?= $no++; ?></td>
                           <td><?= $value->email; ?></td>
                           <td><?= $value->name; ?></td>
                           <td><?= $value->password_default ?></td>
                           <td><?= date('d-m-Y', $value->date_created); ?></td>
                           <td><button type="button" onclick="editUser(`<?= $value->id ?>`, `<?= $value->name ?>`, `<?= $value->email ?>`)" class="badge badge-success" style="border: none">edit</button>
                            <button type="button" onclick="deleteUser(`<?= $value->id ?>`,`<?= $value->name ?>`, `<?= $value->email ?>`)" class="badge badge-danger" style="border: none">delete</button></td>
                       </tr>
                   <?php endforeach ?>
                </tbody>
            </table>


        </div>
        <div class="col-lg-5">
            <h1 class="h3 mb-4 text-gray-800">Hak Akses Admin Certification Manager</h1>

            <button type="button" class="btn btn-primary btnAdd" onclick="addHakAkses()"><i class="fa fa-plus" aria-hidden="true"></i> Add Hak Akses</button>
            <br><br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php $no = 1; ?>
                   <?php foreach ($hak_akses_menu as $key => $value): ?>
                       <tr>
                           <td><?= $no++; ?></td>
                           <td><?= $value->menu ?></td>
                           <td>
                            <button type="button" onclick="deleteHakAkses(`<?= $value->user_access_menu_id ?>`,`<?= $value->menu ?>`)" class="badge badge-danger" style="border: none">delete</button></td>
                       </tr>
                   <?php endforeach ?>
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Add Admin Certification Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#newUserModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/store_admin_certification_manager'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                       <input type="text" class="form-control" required name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" required name="email" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#newUserModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Edit Admin Finance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#editUserModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/update_admin_certification_manager'); ?>" method="post">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                       <input required type="text" class="form-control" required name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input required type="email" class="form-control" required name="email" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#editUserModal').modal('hide');" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="hakAksesModal" tabindex="-1" role="dialog" aria-labelledby="hakAksesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hakAksesModalLabel">Add Hak Akses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#hakAksesModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/add_hak_akses_admin_certification_manager'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                       <label for="">Choose Menu</label>
                       <select name="menu" id="menu" class="form-control">
                           <option value="">-- Choose --</option>
                           <?php foreach ($menu as $key => $value): ?>
                               <option value="<?= $value->id ?>"><?= $value->menu ?></option>
                           <?php endforeach ?>
                       </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#hakAksesModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
    function addUser()
    {
        $('#newUserModal').modal('show');
    }   

    function addHakAkses()
    {
        $('#hakAksesModal').modal('show');
    }

    function editUser(id, name, email)
    {
        $('#editUserModal [name="id"]').val(id);
        $('#editUserModal [name="name"]').val(name);
        $('#editUserModal [name="email"]').val(email);
        $('#editUserModal').modal('show');
    }

    function deleteUser(id, name, email)
    {
        swal({
            title: 'Delete user '+name+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>menu/delete_admin_certification_manager',
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

    function deleteHakAkses(id, name)
    {
        swal({
            title: 'Delete hak akses menu '+name+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>menu/delete_hak_akses_admin_certification_manager',
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