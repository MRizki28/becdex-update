<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_role', 'List of Roles'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section class="top">
    <div id="actions" privil="<?php echo $core->privileges('p_role', 'list') ?>">
        <a class="add" style="background: var(--blue2)" href="<?php echo urlFlex ?>pages/role.add">
        <i class="micon">add</i>Add</a>

        <a class="edit" style="background: var(--yellow2)">
        <i class="micon">edit</i>Edit</a>

        <a class="delete" style="background: var(--red2)">
        <i class="micon">delete</i>Delete</a>

        <a class="export" style="background: var(--green2)">
        <i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Roles</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 110px">ID Role</th>
                <th scope='col' style="width: 120px">Name</th>
                <th scope='col'>Description</th>
                <th scope='col' style="width: 60px">Users</th>
                <th scope='col' style="width: 180px">Last Modified</th>
            </tr>
        </thead>
    </table>

    <script>
        $.fn.dataTable.moment("MMMM Do YYYY, H:mm:ss");
        let mainTable = $("#mainTable").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['excel'],
            "language": {
                "search": "Search: ",
                "searchPlaceholder": "Insert keyword..."
            },
            data: [],
            order: [[ 2, 'desc' ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idRole', className: 'thisId protect'},
                {data: 'name'},
                {data: 'desc', className: 'align-left wrapok', 
                    render: function(data){
                        return (data) ? data : "<i class='micon'>more_horiz</i>";
                    }
                },
                {data: 'users'},
                {data: 'modified',
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                }
            ]
        });

        function tableContents(){
            if(navigator.onLine){
                $.ajax({
                    type: "POST",
                    url: host + 'system/process/role/list',
                    complete: function(data){
                        mainTable.clear();
                        mainTable.rows.add(data.responseJSON.data).draw();
                        localStorage.setItem("role/list", JSON.stringify(data));
                    }
                });
            } else {
                mainTable.clear();
                $(".add, .edit, .delete").hide();
                var resources = JSON.parse(localStorage.getItem("role/list"));
                mainTable.rows.add(resources.responseJSON.data).draw();
            }
        }

        tableContents();
        $('.export').click(function(){
            $('.buttons-excel').click();
        });

        mainTable.search('<?php echo (isset($_GET['data'])) ? $_GET['data'] : '' ?>').draw();

        $('#actions .edit').click(function(){
            if ($('#mainTable tbody tr').hasClass('selected')){
                window.location.href = host + "pages/role.edit/" + $('.selected .thisId').html();
                return false;
            }

            toast("warning", "Click one of the lines first!");
        });

        $(document).on('click', '#mainTable tbody tr', function(){
            if($('.selected .protect').length){
                if($('.selected .protect').html() == 'role-0000000000-00001'){
                    $('#actions .delete').css({
                        'opacity': '0.3',
                        'pointer-events': 'none'
                    });
                } else {
                    $('#actions .delete').css({
                        'opacity': '1',
                        'pointer-events': 'auto'
                    });
                }
            } else {
                $('#actions .delete').css({
                    'opacity': '1',
                    'pointer-events': 'auto'
                });
            }
        });

        $('#actions .delete').click(function(){
            if ($('#mainTable tbody tr').hasClass('selected')){

                if($('.selected .protect').html() == 'role-0000000000-00001'){
                    toast('warning', "Can't delete this role!");
                    return false;
                }

                swal({
                    title: "Are you sure ?",
                    text: "Deleting this data may have an impact on other related data, please check again!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            dataType: 'JSON',
                            data: {data: $('.selected .thisId').html()},
                            url: host + "system/process/role/delete",
                            success: function(data){
                                tableContents();
                                (data == 1) ? toast("success", "Data successfully deleted!") : 
                                toast("error", "Data failed to delete!");
                            }
                        });
                    }
                });
                return false;
            }

            toast("warning", "Click one of the lines first!");
        });
    </script>

<?php $core->close();