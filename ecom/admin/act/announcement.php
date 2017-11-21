<?php
$action = filter_input(INPUT_POST, "action");
$announcement_en = filter_input(INPUT_POST, "announcement_en");
$announcement_cn = filter_input(INPUT_POST, "announcement_cn");
$announcement_id = filter_input(INPUT_POST, "announcement_id");

//insert announcement
if ($action == 'save') {

    $stmt_announ_save = $mysqli->prepare("INSERT INTO announcement (announcement_en, announcement_cn) VALUES (?,?)");
    $stmt_announ_save->bind_param("ss", $announcement_en, $announcement_cn);

    if ($stmt_announ_save->execute()) {
        //audit trail
        $insert_id = $stmt_announ_save->insert_id;
        $stmt_audit_trail = $mysqli->prepare("INSERT INTO announcement_audit (announcement_audit_announcement_id, announcement_audit_admin, announcement_audit_action) VALUES (?,?,?)");
        $stmt_audit_trail->bind_param("iis", $insert_id, $admin->getadmin_id(), $action);
        $stmt_audit_trail->execute();

        $output[0] = true;
        $output[1] = $LANG_SAVE_SUCCESSFUL;
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
    print json_encode($output);
} else if ($action == 'select') {

    $stmt_announ_select = $mysqli->prepare("SELECT announcement_en, announcement_cn FROM announcement WHERE announcement_id=?");
    $stmt_announ_select->bind_param('i', $announcement_id);
    $stmt_announ_select->execute();
    $stmt_announ_select->store_result();
    $stmt_announ_select->bind_result($announcement_en, $announcement_cn);
    $stmt_announ_select->fetch();
    ?>

    <script>
        $(function () {
            CKEDITOR.replace("announcement_en_update");
            CKEDITOR.replace("announcement_cn_update");
            CKEDITOR.replace("announcement_th_update");
        });
    </script>
    <input type="hidden" name="announcement_id" id="announcement_id" value="<?php echo $announcement_id ?>" />
    <h4>English</h4>
    <textarea class="ckeditor" id="announcement_en_update"><?php print html_entity_decode($announcement_en) ?></textarea>
    <br>
    <h4>中文</h4>
    <textarea class="ckeditor" id="announcement_cn_update"><?php print html_entity_decode($announcement_cn) ?></textarea>
    <br>

    <?php
} else if ($action == 'update') {
    $stmt_announ_update = $mysqli->prepare("UPDATE announcement SET announcement_en=?, announcement_cn=? WHERE announcement_id=?");
    $stmt_announ_update->bind_param("ssi", $announcement_en, $announcement_cn, $announcement_id);

    if ($stmt_announ_update->execute()) {
        //audit trail
        $stmt_audit_trail = $mysqli->prepare("INSERT INTO announcement_audit (announcement_audit_announcement_id, announcement_audit_admin, announcement_audit_action) VALUES (?,?,?)");
        $stmt_audit_trail->bind_param("iis", $announcement_id, $admin->getadmin_id(), $action);
        $stmt_audit_trail->execute();
        $output[0] = true;
        $output[1] = $LANG_SAVE_SUCCESSFUL;
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
    print json_encode($output);
} else if ($action == 'delete') {
    $stmt_announ_delete = $mysqli->prepare("DELETE FROM announcement WHERE announcement_id=?");
    $stmt_announ_delete->bind_param("i", $announcement_id);

    if ($stmt_announ_delete->execute()) {
        //audit trail
        $stmt_audit_trail = $mysqli->prepare("INSERT INTO announcement_audit (announcement_audit_announcement_id, announcement_audit_admin, announcement_audit_action) VALUES (?,?,?)");
        $stmt_audit_trail->bind_param("iis", $announcement_id, $admin->getadmin_id(), $action);
        $stmt_audit_trail->execute();

        $output[0] = true;
        $output[1] = $LANG_SAVE_SUCCESSFUL;
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
    print json_encode($output);
}
?>