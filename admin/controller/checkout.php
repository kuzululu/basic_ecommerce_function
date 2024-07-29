<?php

if (isset($_POST["btnCheckUpdateStats"])) {
	$dataUpdate = new UpdateChkStatus($conn);

	if (!empty($_POST["update_checkId"])) {
		$id = $conn->escape_string(trim($_POST["update_checkId"]));
		$update_chk_stats = $conn->escape_string(trim($_POST["update_chk_stats"]));
		$result = $dataUpdate->update($id, $update_chk_stats);
		if ($result) {
			showAlertSuccess($result);
		}
	}
}

?>