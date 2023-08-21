<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_log', 'List of Logs'),
    array('lib/balloon', 'lib/dataTables', 'lib/buttons.dataTables', 'lib/select2', 'lib/jquery-ui', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip', 'lib/select2', 'lib/jquery-ui')
); ?>

<section id="log" class="top">
    <div class="filter">
        <div class="obj">
            <label><i class="micon">face</i></label>
            <select name="users" class="users getSelect2">
                <option value="all">All Users</option>
                <?php $user = $core->data->query("SELECT * FROM tb_users");
                while($data = mysqli_fetch_assoc($user)){ ?>
                <option value="<?php echo $data['idUser'] ?>"><?php echo $data['name'] ?></option>
                <?php } unset($user, $data) ?>
            </select>
        </div>

        <div class="obj">
            <label><i class="micon">date_range</i></label>
            <input type="text" name="from" class="from" placeholder="Date From" spellcheck="false" readonly/>
            <input type="text" name="to" class="to" placeholder="Date To" spellcheck="false" readonly/>
            <button type="button" class="submit-date" aria-label="Set Specific Date" data-`ba`lloon-pos="down"><i class="micon">restore</i></button>
            <button type="button" class="reset-date" aria-label="Reset Date" data-balloon-pos="down"><i class="micon">auto_delete</i></button>
        </div>

        <a href="javascript:void" class="export" aria-label="Export to Excel (.xlsx)" data-balloon-pos="down"><i class="micon">table_view</i></a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Logs</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 100px">IP Address</th>
                <th scope='col' style="width: 140px">User</th>
                <th scope='col' style="width: 180px">Target</th>
                <th scope='col'>Description</th>
                <th scope='col' style="width: 180px">Action Time</th>
                <th scope='col'>Old Data</th>
            </tr>
        </thead>
    </table>

    <script>
        $.fn.dataTable.moment("MMMM Do YYYY, H:mm:ss");
        let mainTable = $("#mainTable").DataTable({
            responsive: { 
                details: {display: $.fn.dataTable.Responsive.display.childRowImmediate}
            },
            dom: 'Bfrtip',
            buttons: ['excel'],
            "language": {
                "search": "Search: ",
                "searchPlaceholder": "Insert keyword..."
            },
            data: [],
            order: [[ 5, "desc" ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'ip'},
                {data: 'name'},
                {data: 'target'},
                {data: 'desc', className: 'align-left wrapok'},
                {data: 'created', 
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                },
                {data: 'old', className: 'none',
                    render: function(data){
                        return (data == '') ? 'There is no old data.' : data;
                    }
                }
            ]
        });

        if(navigator.onLine){
            $.ajax({
                type: "GET",
                url: host + 'system/process/log?method=list&options=all&from=&to=',
                complete: function(data){
                    mainTable.clear();
                    mainTable.rows.add(data.responseJSON.data).draw();
                    localStorage.setItem("log/list", JSON.stringify(data));
                }
            });
        } else {
            mainTable.clear();
            $(".filter .obj").hide();
            var resources = JSON.parse(localStorage.getItem("log/list"));
            mainTable.rows.add(resources.responseJSON.data).draw();
        }

        mainTable.search('<?php echo (isset($_GET['data'])) ? $_GET['data'] : '' ?>').draw();

        $('.users').change(function(){
            if(navigator.onLine){
                $.ajax({
                    type: "GET",
                    url: host + "system/process/log?method=list&options=" + $(this).val() + '&from=&to=',
                    complete: function(data){
                        mainTable.clear();
                        mainTable.rows.add(data.responseJSON.data).draw();
                        localStorage.setItem("log/list", JSON.stringify(data));
                    }
                });
            } else {
                mainTable.clear();
                $(".filter .obj").hide();
                var resources = JSON.parse(localStorage.getItem("log/list"));
                mainTable.rows.add(resources.responseJSON.data).draw();
            }
        })

        $('.users').change();
        var dateToday = new Date();

        $(".filter .from").datepicker({
            dateFormat: 'dd M yy',
            changeMonth: true,
            changeYear: true,
            maxDate: dateToday,
            onClose: function(selectedDate) {
                $(".filter .to").datepicker("option", "minDate", selectedDate);
            }
        });

        $(".filter .to").datepicker({
            dateFormat: 'dd M yy',
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            maxDate: dateToday,
            onClose: function(selectedDate) {
                $(".filter .from").datepicker("option", "maxDate", selectedDate);
            }
        });

        $('.submit-date').click(function(){
            if($('.filter .from').val().length == 0 || $('.filter .to').val().length == 0){
                toast('warning', 'Date From and To cannot be empty!');
                return false;
            } else {
                mainTable.ajax.url(host + "system/process/log?method=list&options=" + $('.users').val() + '&from=' + $('.filter .from').val() + '&to=' + $('.filter .to').val()).load();
            }
        });

        $('.reset-date').click(function(){
            mainTable.ajax.url(host + "system/process/log?method=list&options=" + $('.users').val() + '&from=&to=').load();
            $('.filter .from').val('');
            $('.filter .to').val('');
        });

        $('.export').click(function(){
            $('.buttons-excel').click();
        });
    </script>

<?php $core->close();