<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <a href="#">

            </a>
            <div id="page">
                <iframe src="<?php echo base_url('management/certificateTemplate/') . $id; ?>" style="width: 100%; height: 724px"></iframe>
            </div>
            <a href="<?= base_url() ?>management/certificateTemplate/<?= $id ?>" download='file'>down</a>
            <button id="submit">Export to PDF</button>

        </div>

    </div>


</div>
<script>
    window.onload = function() {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function(element, renderer) {
                return true;
            }
        };

        $('#submit').click(function() {
            doc.fromHTML($('#page').html(), 15, 15, {
                'width': 170,
                'elementHandlers': specialElementHandlers
            });
            doc.save('sample-file.pdf');
        });
    }
</script>

<!-- End of Main Content -->