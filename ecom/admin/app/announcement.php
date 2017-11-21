<script src="plugin/ckeditor/ckeditor.js"></script>
<div class="panel panel-default" >
    <div class="panel-heading">
        <?php echo $LANG_ANNOUNCEMENT_MODULE ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body"> 
        <div class="table-responsive">
            <div class="panel-body">
                <h4>English</h4>
                <textarea class="ckeditor" id="announcement_en"></textarea>
                <br>
                <h4>中文</h4>
                <textarea class="ckeditor" id="announcement_cn"></textarea>
                <br>
            </div>	

            <button  class="btn btn-primary" onclick="save_announcement();save_press_audit('btn_announcement_save_announcement','');"><?php echo $LANG_SUBMIT; ?></button>
            <button  class="btn btn-primary" onclick="window.location.href = '?loc=<?php echo $_GET['loc'] ?>';save_press_audit('btn_announcement_refresh','');"><?php echo $LANG_CANCEL; ?></button>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php print $LANG_ANNOUN_LIST; ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper table-responsive" st>
            <table class="table table-striped table-bordered table-hover dataTables" id="">
                <thead>
                    <tr class="pluginth">
                        <th style=""><span>No</span></th>
                        <th style="width:300px"><span>Content (EN)</span></th>						              
                        <th style="width:300px"><span>Content (CN)</span></th>					              
                        <th style=""><span>Edit</span></th>
                        <th style=""><span>Delete</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $stmt_select_announcement = $mysqli->prepare('select announcement_id, announcement_en, announcement_cn FROM announcement');

                    $stmt_select_announcement->execute();
                    $stmt_select_announcement->store_result();

                    $stmt_select_announcement->bind_result($announcement_id, $announcement_en, $announcement_cn);
                    while ($stmt_select_announcement->fetch()) {
                        ?>
                        <tr class="plugintr">
                            <td ><?php print $i++; ?></td>
                            <td ><?php print html_entity_decode($announcement_en); ?></td>
                            <td ><?php print html_entity_decode($announcement_cn); ?></td>
                            <td style="text-align: center"><a onclick="select_announcement('<?php print $announcement_id ?>');save_press_audit('btn_announcement_select_announcement','announcement_id:<?php print $announcement_id ?>');" style="cursor: pointer" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><?php echo $LANG_EDIT; ?></a></td>
                            <td style="text-align: center"><a onclick="delete_announcement('<?php print $announcement_id ?>');save_press_audit('btn_announcement_delete_announcement','announcement_id:<?php print $announcement_id ?>');" style="cursor: pointer" class="btn btn-primary"><?php print $LANG_DELETE;?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>

<script>
    $(function () {
        $('#example1').DataTable();
        CKEDITOR.config.height = 150;
        CKEDITOR.config.width = 'auto';
    });

    function save_announcement() {
        if (confirm("Are you sure you want to save?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=<?php echo $_GET['loc'] ?>',
                data: {
                    action: 'save',
                    announcement_en: CKEDITOR.instances['announcement_en'].getData(),
                    announcement_cn: CKEDITOR.instances['announcement_cn'].getData()
                },
                beforeSend: function () {
                    show_processing();
                },
                success: function (data) {
                    hide_processing();
                    if (data[0] == true) {
                        alert(data[1]);
                        window.location.reload();
                    } else {
                        alert(data[1]);
                    }
                }
            });

        }
    }

    function select_announcement(announcement_id) {

        $("#update_content").html("");
        $.ajax({
            type: 'POST',
            url: '?f=<?php echo $_GET['loc'] ?>',
            data: {
                action: 'select',
                announcement_id: announcement_id
            },
            beforeSend: function () {
                show_processing();
            },
            success: function (data) {
                hide_processing();
                $("#update_content").html(data);
            }
        });
    }

    function update_announcement() {
        if (confirm("Are you sure you want to update?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=<?php echo $_GET['loc'] ?>',
                data: {
                    action: 'update',
                    announcement_id: $("#announcement_id").val(),
                    announcement_en: CKEDITOR.instances['announcement_en_update'].getData(),
                    announcement_cn: CKEDITOR.instances['announcement_cn_update'].getData()
                },
                beforeSend: function () {
                    show_processing();
                },
                success: function (data) {
                    hide_processing();
                    if (data[0] == true) {
                        alert(data[1]);
                        window.location.reload();
                    } else {
                        alert(data[1]);
                    }
                }
            });
        }
    }

    function delete_announcement(announcement_id) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '?f=<?php echo $_GET['loc'] ?>',
                data: {
                    action: 'delete',
                    announcement_id: announcement_id
                },
                beforeSend: function () {
                    show_processing();
                },
                success: function (data) {
                    hide_processing();
                    if (data[0] == true) {
                        alert(data[1]);
                        window.location.reload();
                    } else {
                        alert(data[1]);
                    }
                }
            });
        }
    }
</script>


<!--announcement modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php print $LANG_ANNOUN_EDIT; ?></h4>
            </div>
            <div class="modal-body" id="update_content">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save_press_audit('btn_announcement_close_announcement','announcement_id:'+$('#announcement_id').val())">Close</button> 
                <input class="btn btn-primary" id="save_btn" name="save_btn" type="button" onclick="update_announcement();save_press_audit('btn_announcement_update_announcement','announcement_id:'+$('#announcement_id').val());" value="Save Changes" style="width:auto">
            </div>
        </div>
    </div>
</div>