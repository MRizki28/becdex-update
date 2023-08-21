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

            <button type="button" class="btn btn-primary btnAdd" onclick="newSubMenu()"><i class="fa fa-plus" aria-hidden="true"></i> Add Sub Menu</button>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
                            <button type="button" onclick="editSubMenu(`<?= $sm['id'] ?>`, `<?= $sm['menu_id'] ?>`, `<?= $sm['title'] ?>`, `<?= $sm['url'] ?>`, `<?= $sm['icon'] ?>`, `<?= $sm['is_active'] ?>`)" class="badge badge-success" style="border: none">edit</button>
                            <button type="button" onclick="deleteSubMenu(`<?= $sm['id'] ?>`,`<?= $sm['title'] ?>`)" class="badge badge-danger" style="border: none">delete</button>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#newSubMenuModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/addSubMenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Submenu Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <label for="">In Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <label for="">Sub Menu Icon <a target="_blank" href="https://fontawesome.com/v4/icons/">Link</a></label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <div class="form-check">
                            <input class="form-check-input-t" type="checkbox" value="1" name="is_active" id="is_active">
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#newSubMenuModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="editSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Edit Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#editSubMenuModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/updateSubMenu'); ?>" method="post">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Submenu Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <label for="">In Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <label for="">Sub Menu Icon <a target="_blank" href="https://fontawesome.com/v4/icons/">Link</a></label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <div class="form-check">
                            <input class="form-check-input-t" type="checkbox" value="1" name="is_active" id="is_active">
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editSubMenuModal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script>
    function newSubMenu()
    {
        $('#newSubMenuModal').modal('show');
    }

    function editSubMenu(id, menu_id, title, url, icon, is_active)
    {
        $('#editSubMenuModal [name="id"]').val(id);
        $('#editSubMenuModal [name="menu_id"]').val(menu_id);
        $('#editSubMenuModal [name="title"]').val(title);
        $('#editSubMenuModal [name="url"]').val(url);
        $('#editSubMenuModal [name="icon"]').val(icon);
        if(is_active == 1){
            $('#editSubMenuModal [name="is_active"]')[0].checked = true;
        } else {
            $('#editSubMenuModal [name="is_active"]')[0].checked = false;
        }
        $('#editSubMenuModal').modal('show');
    }

    function deleteSubMenu(id,title)
    {
        swal({
            title: 'Delete Sub Menu '+title+' ?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>menu/deleteSubMenu',
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