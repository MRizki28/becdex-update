<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('protected');
$core->open(
    array('p_error', 'List of Errors'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section id="error" class="top">
    <div id="actions" privil="<?php echo $core->privileges('p_error', 'list') ?>">
        <a class="edit" style="background: var(--yellow2)">
        <i class="micon">edit</i>Edit</a>

        <a class="export" style="background: var(--green2)">
        <i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Errors</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 80px">ID Error</th>
                <th scope='col' style="width: 60px">Type</th>
                <th scope='col'>Location</th>
                <th scope='col'>User</th>
                <th scope='col'>Message</th>
                <th scope='col' style="width: 60px">Status</th>
                <th scope='col' style="width: 180px">Description</th>
                <th scope='col' style="width: 180px">Created</th>
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
            order: [[ 1, "desc" ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idErr', className: 'thisId'},
                {data: 'type'},
                {data: 'location', className: 'none'},
                {data: 'user', className: 'none'},
                {data: 'message', className: 'wrapok'},
                {data: 'status',
                    render: function(data){
                        return (data == 'y') ? 'Solved' : 'Not Yet';
                    }
                },
                {data: 'desc', 
                    render: function(data){
                        return (data) ? data : "<i class='micon'>more_horiz</i>";
                    }
                },
                {data: 'created',
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
                    url: host + 'system/process/error/list',
                    complete: function(data){
                        mainTable.clear();
                        mainTable.rows.add(data.responseJSON.data).draw();
                        localStorage.setItem("error/list", JSON.stringify(data));
                    }
                });
            } else {
                mainTable.clear();
                $(".add, .edit, .delete").hide();
                var resources = JSON.parse(localStorage.getItem("error/list"));
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
                window.location.href = host + "pages/error.edit/" + $('.selected .thisId').html();
                return false;
            }

            toast("warning", "Click one of the lines first!");
        });
    </script>

<?php $core->close();