<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_pageview', 'List of Pageviews'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section class="top">
    <div id="actions" privil="<?php echo $core->privileges('p_pageview', 'list') ?>">
        <a class="export" style="background: var(--green2)">
        <i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Pageviews</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 110px">ID View</th>
                <th scope='col' style="width: 60px">Location</th>
                <th scope='col' style="width: 60px">Referrer</th>
                <th scope='col' style="width: 60px">Web Browser</th>
                <th scope='col' style="width: 60px">OS</th>
                <th scope='col' style="width: 60px">Device</th>
                <th scope='col' style="width: 60px">Country</th>
                <th scope='col' style="width: 60px">city</th>
                <th scope='col' style="width: 60px">IP</th>
                <th scope='col' style="width: 60px">Longitude</th>
                <th scope='col' style="width: 60px">Latitude</th>
                <th scope='col' style="width: 180px">Access Time</th>
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
            order: [[ 12, 'desc' ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idView', className: 'thisId'},
                {data: 'location'},
                {data: 'referrer'},
                {data: 'browser'},
                {data: 'os', className: 'none'},
                {data: 'device', className: 'none'},
                {data: 'country'},
                {data: 'city'},
                {data: 'ip', className: 'none'},
                {data: 'longitude', className: 'none'},
                {data: 'latitude', className: 'none'},
                {data: 'created',
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                }
            ]
        });

        if(navigator.onLine){
            $.ajax({
                type: "POST",
                url: host + 'system/process/pageview/list',
                complete: function(data){
                    mainTable.clear();
                    mainTable.rows.add(data.responseJSON.data).draw();
                    localStorage.setItem("pageview/list", JSON.stringify(data));
                }
            });
        } else {
            mainTable.clear();
            var resources = JSON.parse(localStorage.getItem("pageview/list"));
            mainTable.rows.add(resources.responseJSON.data).draw();
        }

        $('.export').click(function(){
            $('.buttons-excel').click();
        });

        mainTable.search('<?php echo (isset($_GET['data'])) ? $_GET['data'] : '' ?>').draw();
    </script>

<?php $core->close();