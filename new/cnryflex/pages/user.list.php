<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_user', 'List of Users'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section class='top'>
    <div id='actions' privil='<?php echo $core->privileges('p_user', 'list') ?>'>
        <a class='add' style='background: var(--blue2)' href='<?php echo urlFlex ?>pages/user.add'>
        <i class='micon'>add</i>Add</a>

        <a class='edit' style='background: var(--yellow2)'>
        <i class='micon'>edit</i>Edit</a>

        <a class='delete' style='background: var(--red2)'>
        <i class='micon'>delete</i>Delete</a>

        <a class='export' style='background: var(--green2)'>
        <i class='micon'>table_view</i>Export</a>
    </div>

    <table id='mainTable' class='cell-border stripe responsive nowrap' style='width: 100%'>
        <caption>List of Users</caption>
        <thead>
            <tr>
                <th scope='col' style='width: 40px'>Detail</th>
                <th scope='col' style='width: 120px'>Name</th>
                <th scope='col' style='width: 120px'>Role</th>
                <th scope='col'>Email</th>
                <th scope='col' style='width: 60px'>Phone</th>
                <th scope='col' style='width: 60px'>Language</th>
                <th scope='col' style='width: 60px'>Status</th>
                <th scope='col' style='width: 180px'>Last Modified</th>
                <th scope='col'>ID User</th>
                <th scope='col'>ID Card / NIK</th>
                <th scope='col'>Address</th>
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
            order: [[ 1, "asc" ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'name'},
                {data: 'role'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'lang'},
                {data: 'status'},
                {data: 'modified',
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                },
                {data: 'idUser', className: 'none thisId protect'},
                {data: 'idNo', className: 'none',
                    render: function(data){
                        return (data) ? data : 'No data';
                    }
                },
                {data: 'address', className: 'none'}
            ]
        });

        function tableContents(){
            if(navigator.onLine){
                $.ajax({
                    type: "POST",
                    url: host + 'system/process/user/list',
                    complete: function(data){
                        mainTable.clear();
                        mainTable.rows.add(data.responseJSON.data).draw();
                        localStorage.setItem("user/list", JSON.stringify(data));
                    }
                });
            } else {
                mainTable.clear();
                $(".add, .edit, .delete").hide();
                var resources = JSON.parse(localStorage.getItem("user/list"));
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
                window.location = host + "pages/user.edit/" + $('.selected .thisId').html();
                return false;
            }

            toast("warning", "Click one of the lines first!");
        });

        $(document).on('click', '#mainTable tbody tr', function(){
            if($('.selected .protect').length){
                if($('.selected .protect').html() == 'user-0000000000-00001'){
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

                if($('.selected .protect').html() == 'user-0000000000-00001'){
                    toast('warning', "Can't delete this user!");
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
                            data: {data: $('.selected .thisId').html()},
                            url: host + "system/process/user/delete",
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