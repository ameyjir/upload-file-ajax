<?php
//Các Mimes quản lý định dạng file
$mimes = array(
	'video/mp4'
);
sleep(2);
if (isset($_FILES['myfile'])) {
	$fileName = $_FILES['myfile']['name'];
	$fileType = $_FILES['myfile']['type'];
	$fileError = $_FILES['myfile']['error'];
	$fileStatus = array(
		'status' => 0,
		'message' => ''	
	);
	if ($fileError== 1) { //Lỗi vượt dung lượng
		$fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
	} elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
		$fileStatus['message'] = 'Không cho phép định dạng này';
	} elseif(file_exists('uploads/'.md5($fileName).'.mp4') || is_uploaded_file('uploads/'.md5($fileName).'.mp4')) {
		$fileStatus['message'] = "File $fileName đã tồn tại";
	} else { //Không có lỗi nào
		move_uploaded_file($_FILES['myfile']['tmp_name'], 'uploads/'.md5($fileName).'.mp4');
		$fileStatus['status'] = 1;
		$fileStatus['message'] = "Bạn đã upload $fileName thành công";
	}	
	echo json_encode($fileStatus);
	exit();
}