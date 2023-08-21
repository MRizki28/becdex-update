<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('notification', 'List of Notifications'),
    array('lib/dataTables', 'lib/buttons.dataTables', 'lib/select2', 'tables'),
    array('lib/dataTables', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/select2', 'lib/ckeditor/ckeditor', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section id="notif" class="top">
    <div id="actions" privil="<?php echo $core->privileges('notification', 'list') ?>">
        <a class="view" style="background: var(--blue2)"><i class="micon">visibility</i>View</a>
        <?php if($_COOKIE['idRole'] == 'role-0000000000-00001'){ ?>
        <a class="send" style="background: var(--purple2)" pop-target="message"><i class="micon">textsms</i>Send Notification</a>
        <?php } ?>
        <a class="export" style="background: var(--green2)"><i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Notifications</caption>
        <thead>
            <tr>
                <th scope='col' style="width: 40px">Detail</th>
                <th scope='col' style="width: 60px">ID Notif</th>
                <th scope='col' style="width: 180px">Title</th>
                <th scope='col'>Description</th>
                <th scope='col' style="width: 80px">Status</th>
                <th scope='col' style="width: 180px">Last Modified</th>
            </tr>
        </thead>
    </table>

    <div pop-wrapper="message" class="in-section">
        <div class="center">
            <div class="content cx-no-border cx-no-padding cx-no-background for-form" style="max-height: unset">
                <form class="cx-form cx-md validate" action="" method="POST">
                    <?php $core->formTitle('notifications', 'Send Notification') ?>

                    <div class="obj" style="width: 200px">
                        <label>Recipient</label>
                        <i class="micon">group</i>
                        <select name="recipient" class="with-icon getSelect2" required>
                            <option value="" selected disabled>Select Recipient</option>
                            <option value="all">Send to all</option>
                            <optgroup label="role">
                            <?php $sql = $core->data->query("SELECT idRole, `name` FROM `tb_roles` ORDER BY `name`");
                            while($row = mysqli_fetch_assoc($sql)){ ?>
                                <option value="<?php echo $row['idRole'] ?>"><?php echo $row['name'] ?></option>
                            <?php } unset($sql, $row) ?>
                            </optgroup>

                            <optgroup label="user">
                            <?php $sql = $core->data->query("SELECT idUser, `name` FROM `tb_users` ORDER BY `name`");
                            while($row = mysqli_fetch_assoc($sql)){ ?>
                                <option value="<?php echo $row['idUser'] ?>"><?php echo $row['name'] ?></option>
                            <?php } unset($sql, $row) ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="obj" style="width: calc(100% - 212px)">
                        <label>Title</label>
                        <i class="micon">text_fields</i>
                        <input type="text" name="title" class="with-icon" spellcheck="false" placeholder="Title notification" required/>
                    </div>

                    <div class="obj">
                        <label>Content</label>
                        <textarea name="content" id="theEditor" spellcheck="false" placeholder="Article content" required></textarea>
                    </div>

                    <div class="obj">
                        <label>Link (Optional)</label>
                        <i class="micon">link</i>
                        <input type="text" name="url" class="with-icon" spellcheck="false" placeholder="Ex: https://google.co.id"/>
                    </div>

                    <button type="submit" class="with-cancel">Save</button>
                    <a class="cancel" href="javascript:void(0)" pop-close>Cancel</a>
                </form>
            </div>
        </div>
    </div>

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
            order: [[ 5, 'desc' ]],
            columnDefs: [{targets:[2, 3], class: 'wrapok'}],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idNotif', className: 'thisId'},
                {data: 'title'},
                {data: 'desc', className: 'align-left wrapok'},
                {data: 'status', className: 'thisStatus',
                    render: function(data){
                        return (data == 'n') ? 'Unread' : 'Read';
                    }
                },
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
                url: host + 'system/process/notification/list',
                complete: function(data){
                    mainTable.clear();
                    mainTable.rows.add(data.responseJSON.data).draw();
                    localStorage.setItem("notification/list", JSON.stringify(data));
                }
            });
        } else {
            mainTable.clear();
            $(".view").hide();
            var resources = JSON.parse(localStorage.getItem("notification/list"));
            mainTable.rows.add(resources.responseJSON.data).draw();
        }

        $('.export').click(function(){
            $('.buttons-excel').click();
        });

        mainTable.search('<?php echo (isset($_GET['data'])) ? $_GET['data'] : '' ?>').draw();

        $('#actions .view').click(function(){
            if ($('#mainTable tbody tr').hasClass('selected')){
                notificationPopUp($('.selected .thisId').html());
            } else {
                toast("warning", "Click one of the lines first!");
            }
        });

        CKEDITOR.replace('theEditor', {
            toolbarGroups: [
                {
                    name: 'document',
                    groups: ['document', 'mode', 'doctools']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker', 'editing']
                },
                {
                    name: 'forms',
                    groups: ['forms']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                },
                {
                    name: 'styles',
                    groups: ['styles']
                }, '/',
                {
                    name: 'links',
                    groups: ['links']
                },
                {
                    name: 'insert',
                    groups: ['insert']
                }, '/',
                {
                    name: 'colors',
                    groups: ['colors']
                },
                {
                    name: 'tools',
                    groups: ['tools']
                },
                {
                    name: 'others',
                    groups: ['others']
                },
                {
                    name: 'about',
                    groups: ['about']
                }
            ],

            removeButtons: 'Print,Replace,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Unlink,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Font,FontSize,TextColor,BGColor,ShowBlocks,Maximize,About,RemoveFormat,SelectAll,Find,Copy,Cut,Paste,PasteText,PasteFromWord,Format,JustifyBlock,Blockquote,Templates,Source',
            extraPlugins: 'wordcount, notification',
            height: '110px'
        });

        $("div[pop-wrapper='message']").on('submit', function(e){
            e.stopPropagation;
            $.ajax({
                type: 'POST',
                url: host + 'system/process/notification/message',
                data: {
                    recipient: $("div[pop-wrapper='message'] select").val(),
                    title: $("div[pop-wrapper='message'] input[name='title']").val(),
                    content: CKEDITOR.instances.theEditor.getData(),
                    url: $("div[pop-wrapper='message'] input[name='url']").val()
                },
                success: function(data){
                    if(data == 1){
                        CKEDITOR.instances.theEditor.setData('');
                        $("div[pop-wrapper='message'] input").val('');
                        toast('success', 'Notification has been sent!');
                        $("*[pop-wrapper]").fadeOut('fast');
                    } else {
                        toast('error', 'Notification failed to send, please try again later!');
                        $("*[pop-wrapper]").fadeOut('fast');
                    }
                }
            });
            return false;
        });
    </script>

<?php $core->close();