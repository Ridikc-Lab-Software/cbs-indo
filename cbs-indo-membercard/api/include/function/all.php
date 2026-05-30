<?php
function json_print($resp)
{
	if (isset($_GET['view'])) {
		error_reporting(0);
		echo pretty_print(json_encode($resp));
	} else {
		echo json_encode($resp);
	}
}

function upload_multiple_files($field_name, $path = "../../../../admin/upload/")
{
	$uploaded = [];

	if (!isset($_FILES[$field_name])) {
		return "";
	}

	$files = $_FILES[$field_name];
	if (!is_dir($path))
		mkdir($path, 0755, true);

	$count = is_array($files['name']) ? count($files['name']) : 1;

	for ($i = 0; $i < $count; $i++) {
		$tmp = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
		$name = is_array($files['name']) ? $files['name'][$i] : $files['name'];
		$error = is_array($files['error']) ? $files['error'][$i] : $files['error'];

		if ($error == UPLOAD_ERR_OK && is_uploaded_file($tmp)) {
			$time = time();
			$acak = rand(10000, 99999);
			$safe_name = $time . "-" . $acak . "-" . $name;
			$destination = $path . $safe_name;

			if (move_uploaded_file($tmp, $destination)) {
				$uploaded[] = $safe_name;
			}
		}
	}

	return implode(",", $uploaded);
}

function pretty_print($json_data)
{
	$space = 0;
	$flag = false;
	echo "<pre>";
	for ($counter = 0; $counter < strlen($json_data); $counter++) {
		if ($json_data[$counter] == '}' || $json_data[$counter] == ']') {
			$space--;
			echo "\n";
			echo str_repeat(' ', ($space * 2));
		}
		if (
			$json_data[$counter] == '"' && ($json_data[$counter - 1] == ',' ||
				$json_data[$counter - 2] == ',')
		) {
			echo "\n";
			echo str_repeat(' ', ($space * 2));
		}
		if ($json_data[$counter] == '"' && !$flag) {
			if ($json_data[$counter - 1] == ':' || $json_data[$counter - 2] == ':')
				echo '<span style="color:blue;font-weight:bold">';
			else
				echo '<span style="color:red;">';
		}
		echo $json_data[$counter];
		if ($json_data[$counter] == '"' && $flag)
			echo '</span>';
		if ($json_data[$counter] == '"')
			$flag = !$flag;
		if ($json_data[$counter] == '{' || $json_data[$counter] == '[') {
			$space++;
			echo "\n";
			echo str_repeat(' ', ($space * 2));
		}
	}
	echo "</pre>";
}
?>