<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('message', 'List of Messages'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section id="message" class="top">
    <div id="actions" privil="<?php echo $core->privileges('message', 'list') ?>">
        <a class="export" style="background: var(--green2)">
        <i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Messages</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 110px">ID Message</th>
                <th scope='col'>Name</th>
                <th scope='col' style="width: 110px">Email</th>
                <th scope='col' style="width: 80px">Phone</th>
                <th scope='col' style="width: 180px">Content</th>
                <th scope='col' style="width: 180px">Last Modified</th>
            </tr>
        </thead>
    </table>

    <script>
        $.fn.dataTable.moment("MMMM Do YYYY, H:mm:ss");
        let mainTable = $("#mainTable").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            pageLength: 20,
            buttons: ['excel'],
            "language": {
                "search": "Search: ",
                "searchPlaceholder": "Insert keyword..."
            },
            data: [],
            order: [[ 1, 'desc' ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idMess', className: 'thisId'},
                {data: 'name'},
                {data: 'email',
                    render: function(data){
                        return "<a style='text-decoration: underline' href='mailto:" + data + "'>" + data + "</a>";
                    }
                },
                {data: 'phone'},
                {data: 'content', className: 'none'},
                {data: 'modified',
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                }
            ]
        });

        if(navigator.onLine){
            $.ajax({
                type: "POST",
                url: host + 'system/process/message/list',
                complete: function(data){
                    mainTable.clear();
                    mainTable.rows.add(data.responseJSON.data).draw();
                    localStorage.setItem("message/list", JSON.stringify(data));
                }
            });
        } else {
            mainTable.clear();
            var resources = JSON.parse(localStorage.getItem("message/list"));
            mainTable.rows.add(resources.responseJSON.data).draw();
        }

        $('.export').click(function(){
            $('.buttons-excel').click();
        });

        mainTable.search('<?php echo (isset($_GET['data'])) ? $_GET['data'] : '' ?>').draw();
    </script>

<?php $core->close();