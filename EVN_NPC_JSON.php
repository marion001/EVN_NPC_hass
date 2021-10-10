<?php
#Code By: Marion001
#Youtube: https://www.youtube.com/c/Marion001
#Fb: https://www.facebook.com/TWFyaW9uMDAx
#Page: https://www.facebook.com/Party.Marion002
include('./simple_html_dom.php');
include('./EVN_NPC_CONFIG.php');
$curl1 = curl_init();
$curl2 = curl_init();
$curl3 = curl_init();
///////////////////////////////////////
curl_setopt_array($curl1, array(
  CURLOPT_URL => "$API_Get_Info_KH",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$info_KH = curl_exec($curl1);
if (curl_errno($curl1)) { $error_msg1 = curl_error($curl1);}
curl_close($curl1);
if (isset($error_msg1)) { echo "Lỗi Curl Get info Khách Hàng";}
$ThongTin_KH = json_decode($info_KH);
////////////////////////////////////////////
curl_setopt_array($curl2, array(
  CURLOPT_URL => "$API_Co_Mat_Dien/$MaDVQuanLy/$MaKhachHang",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$TTCD = curl_exec($curl2);
if (curl_errno($curl2)) { $error_msg2 = curl_error($curl2);}
curl_close($curl2);
if (isset($error_msg2)) { echo "Lỗi Curl Get Có Mất Điện";}
$Get_TTCD = json_decode($TTCD);
////////////////////////////////////
curl_setopt_array($curl3, array(
  CURLOPT_URL => "http://cskh.npc.com.vn/DichVuTrucTuyen/TraCuuSanLuongDienTheoNgay?MaKhachHangChiSoChot=$MaDiemDo&TuNgayChiSoChot=$NgayChotBatDau&DenNgayChiSoChot=$SetNgayThang",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Cookie: culture=Vi',
	'Content-Length: 0'
  ),
));
$response = curl_exec($curl3);
if (curl_errno($curl3)) { $error_msg3 = curl_error($curl3);}
curl_close($curl3);
if (isset($error_msg3)) { echo "Lỗi Curl Get Sản Lượng Điện Theo Ngày";}
curl_close($curl3);
////////////////////////////////////////////////
    $myfile = fopen("RVZO.html", "w+") or die("Lỗi Không Thể Tạo File! RVZO.html, hoặc cần được cấp quyền 777 hoặc 755");
    $txt = "$response";
    fwrite($myfile, $response);
    fclose($myfile);
$html = file_get_html('./RVZO.html'); 
// TÍnh TIền ĐIện
$SoDien = $html->find('td', 2)->plaintext - $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoMoi;
if ($SoDien >= 1) { // trên 1 số sẽ chạy tính tiền điện
// Từ 1 đến 50 số điện
if ($SoDien <= 50 && $SoDien >= 1) {   
			$tong = $SoDien * 1678;   
			$VAT = round(($tong*10)/100, 0);
			$TongTienCanTT = ((int)$tong + (int)$VAT); }
// Từ 51 đến 100 Số Điện
		else if ($SoDien <= 100 && $SoDien >= 51) {
            $TienBac1 = 50 * 1678;
			$SoDienThuaB1 = $SoDien - 50;
			if ($SoDienThuaB1 >= 1 && $SoDienThuaB1 <= 50) {   
				$SoTienBac2 =  $SoDienThuaB1 * 1734;}
				$tong = $TienBac1 + $SoTienBac2;  // json tổng tiền chưa thuể
				$VAT = round(($tong*10)/100, 0); // json 10% tiền vat
				$TongTienCanTT = ((int)$tong + (int)$VAT); }	 // json tổng tiền cần thanh toán
// Từ 101 số điến đến 200 số
		else if ($SoDien <= 200 && $SoDien >= 101) {
			$TienBac1 = 50 * 1678;
			$SoDienThuaB1 = $SoDien - 50;
			if ($SoDienThuaB1 >= 1 && $SoDienThuaB1 <= 150) {
				$SoDienThua2 = $SoDienThuaB1 - 50;
				$TienBac2 = 50 * 1734;}
			if ($SoDienThua2 >= 1 && $SoDienThua2 <= 100) {
				$TienBac3 = $SoDienThua2 * 2014; }
				$tong = $TienBac1 + $TienBac2 + $TienBac3;	
				$VAT = round(($tong*10)/100, 0);
				$TongTienCanTT = ((int)$tong + (int)$VAT);	} 
		// từ 201-300 số điện
		else if ($SoDien <= 300 && $SoDien >= 201) {
           	$TienBac1 = 50 * 1678;
			$SoDienThuaB1 = $SoDien - 50;
			if ($SoDienThuaB1 >= 1 && $SoDienThuaB1 <= 250) {
				$SoDienThua2 = $SoDienThuaB1 - 50;
				$TienBac2 = 50 * 1734; }
			if ($SoDienThua2 >= 1 && $SoDienThua2 <= 200) {
				$SoDienThua3 = $SoDienThua2 - 100;
				$TienBac3 = 100 * 2014; }
			if ($SoDienThua3 >= 1 && $SoDienThua3 <= 150) {
				$TienBac4 = $SoDienThua3 * 2536; }
				$tong = $TienBac1 + $TienBac2 + $TienBac3 + $TienBac4;	
				$VAT = round(($tong*10)/100, 0);
				$TongTienCanTT = ((int)$tong + (int)$VAT);	}		
		// từ 301-400 số điện
		else if ($SoDien <= 400 && $SoDien >= 301) {
			$TienBac1 = 50 * 1678;
			$SoDienThuaB1 = $SoDien - 50;
			if ($SoDienThuaB1 >= 1 && $SoDienThuaB1 <= 350) {
				$SoDienThua2 = $SoDienThuaB1 - 50;
				$TienBac2 = 50 * 1734; }
			if ($SoDienThua2 >= 1 && $SoDienThua2 <= 300) {
				$SoDienThua3 = $SoDienThua2 - 100;
				$TienBac3 = 100 * 2014; }
			if ($SoDienThua3 >= 1 && $SoDienThua3 <= 200) {
				$SoDienThua4 = $SoDienThua3 - 100;
				$TienBac4 = 100 * 2536; }
			if ($SoDienThua4 >= 1 && $SoDienThua4 <= 200) {
				$SoDienThua5 = $SoDienThua4 - 100;
				$TienBac5 = $SoDienThua4 * 2834; }
				$tong = $TienBac1 + $TienBac2 + $TienBac3 + $TienBac4 + $TienBac5;	
				$VAT = round(($tong*10)/100, 0);
				$TongTienCanTT = ((int)$tong + (int)$VAT);		}
			// từ 401 số điện trở lên
		else if ($SoDien >= 401) {
			$TienBac1 = 50 * 1678;
			$SoDienThuaB1 = $SoDien - 50;
			if ($SoDienThuaB1 >= 1) {
				$SoDienThua2 = $SoDienThuaB1 - 50;
				$TienBac2 = 50 * 1734;
				}
				if ($SoDienThua2 >= 1) {
				$SoDienThua3 = $SoDienThua2 - 100;
				$TienBac3 = 100 * 2014;
				}
			if ($SoDienThua3 >= 1) {
				$SoDienThua4 = $SoDienThua3 - 100;
				$TienBac4 = 100 * 2536;
				}
			if ($SoDienThua4 >= 1) {
				$SoDienThua5 = $SoDienThua4 - 100;
				$TienBac5 = 100 * 2834;
				}
			if ($SoDienThua5 >= 1) {
				$TienBac6 = $SoDienThua5 * 2927;
				}
				$tong = $TienBac1 + $TienBac2 + $TienBac3 + $TienBac4 + $TienBac5 + $TienBac6;	
				$VAT = round(($tong*10)/100, 0);
				$TongTienCanTT = ((int)$tong + (int)$VAT);	}	}	
// thông báo Lỗi, ít nhất phải có 1 số điện để tính tiền
	else {
		$tong = "Có Lỗi Xảy Ra ";
		$VAT = "Có Lỗi Xảy Ra ";
		$TongTienCanTT = "Có Lỗi Xảy Ra ";
    }
//Kết THúc Tính TIền ĐIện
// Tạo Json Thêm Vào Home Assistant
$VuTuyen = array(
	"name"=>"Get Data EVN Miền Bắc",
	"MaKhachHang"=>"$MaKhachHang",
	"TenKhachHang"=> $ThongTin_KH->data->customerInfo->name,
	"DiaChi"=> $ThongTin_KH->data->customerInfo->address,
	"SDT"=> $ThongTin_KH->data->customerInfo->phone,
	"NoiCapDien"=> $ThongTin_KH->data->customerInfo->electricityCompany->name,
	"DiaChiNoiCapDien"=> $ThongTin_KH->data->customerInfo->electricityCompany->address,
	"MaSoCongTo"=> $ThongTin_KH->data->customerInfo->soCongToList[0],
	"ChiSoCu"=> $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoCu."(kWh)",
	"ChiSoMoi"=> $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoMoi."(kWh)",
	"TrangThaiMatDien"=> "Hiện ". $Get_TTCD->alert,
	"LanThayDoiCuoi"=>"$SetThoiGian",
		"UocTinhTienDienThangNay" => array(
			"ThoiDiemHienTai" => array(
				"Tinh_Den_Ngay" => $html->find('td', 1)->plaintext,
				"Dien_Nang_Tieu_Thu" => trim($SoDien.'(kWh)'),
				"Tien_Chua_thue" => number_format(round($tong,0))."(VNĐ)",
				"Tien_Thue_VAT" => number_format($VAT)."(VNĐ)",
				"Tong_Tien_Can_TT" => number_format($TongTienCanTT)."(VNĐ)"
        )
		),
		"SL_Dien_Theo_ngay" => array(
			"HomKia" => array(
				"Ngay" => $html->find('td', 1)->plaintext,
				"ChiSoChot" => trim($html->find('td', 2)->plaintext.'(kWh)'),
				"SanLuongTieuThu" => trim($html->find('td', 4)->plaintext.'(kWh)')
        ),
			"HomKiaf" => array(
				"Ngay" => $html->find('td', 6)->plaintext,
				"ChiSoChot" => trim($html->find('td', 7)->plaintext.'(kWh)'),
				"SanLuongTieuThu" => trim($html->find('td', 9)->plaintext.'(kWh)')
        ),
			"HomKiafNua" => array(
				"Ngay" => $html->find('td', 11)->plaintext,
				"ChiSoChot" => trim($html->find('td', 12)->plaintext.'(kWh)'),
				"SanLuongTieuThu" => trim($html->find('td', 14)->plaintext.'(kWh)')
        )
		),
    "Tien_Dien_Thang_Nay" => array(
		array(
			"Ky" => $ThongTin_KH->data->customerInfo->invoice[0]->period,
			"Thang" => $ThongTin_KH->data->customerInfo->invoice[0]->month,
			"Nam" => $ThongTin_KH->data->customerInfo->invoice[0]->year,
			"SanLuong" => $ThongTin_KH->data->customerInfo->invoice[0]->usageAmount."(kWh)",
			"SoTien_ThanhToan" => number_format($ThongTin_KH->data->customerInfo->invoice[0]->paymentTotalAmount)."(VNĐ)",
			"TrangThai_ThanhToan" => $ThongTin_KH->data->customerInfo->invoice[0]->paid ? 'Đã thanh toán' : 'Chưa thanh toán',
			"Ti_Le_ThayDoi" => $ThongTin_KH->data->customerInfo->chiSoDienList[0]->sanLuongChangeRate."%"
			
        )),
    "Tien_Dien_Thang_Truoc" => array(
		array(
			"Ky" => $ThongTin_KH->data->customerInfo->invoice[1]->period,
			"Thang" => $ThongTin_KH->data->customerInfo->invoice[1]->month,
			"Nam" => $ThongTin_KH->data->customerInfo->invoice[1]->year,
			"SanLuong" => $ThongTin_KH->data->customerInfo->invoice[1]->usageAmount."(kWh)",
			"SoTien_ThanhToan" => number_format($ThongTin_KH->data->customerInfo->invoice[1]->paymentTotalAmount)."(VNĐ)",
			"TrangThai_ThanhToan" => $ThongTin_KH->data->customerInfo->invoice[1]->paid ? 'Đã thanh toán' : 'Chưa thanh toán'
        )),
	"Tien_Dien_Thang_Truoc_Nua" => array(
		array(
			"Ky" => $ThongTin_KH->data->customerInfo->invoice[2]->period,
			"Thang" => $ThongTin_KH->data->customerInfo->invoice[2]->month,
			"Nam" => $ThongTin_KH->data->customerInfo->invoice[2]->year,
			"SanLuong" => $ThongTin_KH->data->customerInfo->invoice[2]->usageAmount."(kWh)",
			"SoTien_ThanhToan" => number_format($ThongTin_KH->data->customerInfo->invoice[2]->paymentTotalAmount)."(VNĐ)",
			"TrangThai_ThanhToan" => $ThongTin_KH->data->customerInfo->invoice[2]->paid ? 'Đã thanh toán' : 'Chưa thanh toán'
        )));
echo json_encode($VuTuyen);


?>
