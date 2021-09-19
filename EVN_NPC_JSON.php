<?php
#Code By: Marion001
#Youtube: https://www.youtube.com/c/Marion001
#Fb: https://www.facebook.com/TWFyaW9uMDAx
#Page: https://www.facebook.com/Party.Marion002
include('./EVN_NPC_CONFIG.php');
$curl = curl_init();
$curl1 = curl_init();
$curl2 = curl_init();
$curl3 = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "$API_Get_DD_Info",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$DD_inf = curl_exec($curl);
curl_close($curl);
$DD_info = json_decode($DD_inf);
$MaDiemDo = $DD_info->data[0]->MA_DDO;
$MaDVQuanLy = $DD_info->data[0]->MA_DVIQLY;
$SoPha = $DD_info->data[0]->SO_PHA;
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
curl_close($curl1);
$ThongTin_KH = json_decode($info_KH);
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
curl_close($curl2);
$Get_TTCD = json_decode($TTCD);
curl_setopt_array($curl3, array(
  CURLOPT_URL => "$API_San_Luong_Ngay/$MaDiemDo/$SoPha/$NGay_Bat_Dau/$NGay_Ket_Thuc",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',));
$SL_Dien_Ngay = curl_exec($curl3);
curl_close($curl3);
$Get_SL_Ngay = json_decode($SL_Dien_Ngay);
$Ten_Khach_Hang = $ThongTin_KH->data->customerInfo->name;
$DiaChi_KH = $ThongTin_KH->data->customerInfo->address;
$SDT_KH = $ThongTin_KH->data->customerInfo->phone;
$Cty_Cap_Dien = $ThongTin_KH->data->customerInfo->electricityCompany->name;
$DiaChi_Cty_Cap_Dien = $ThongTin_KH->data->customerInfo->electricityCompany->address;
$Ma_So_Cong_To = $ThongTin_KH->data->customerInfo->soCongToList[0]; 
$Chi_So_Cu = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoCu."(kWh)";
$Chi_So_Moi = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->chiSoMoi."(kWh)";
$Trang_Thai_Dien = "Hiện ". $Get_TTCD->alert;
$SetThoiGian;
$Ky_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->period; 
$Thang_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->month; 
$Nam_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->year;  
$SanLuongKWH_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->usageAmount."(kWh)"; 
$Tong_Tien_ThangNay = number_format($ThongTin_KH->data->customerInfo->invoice[0]->paymentTotalAmount)."(VNĐ)"; 
/*
$Trang_Thai_TT_ThangNay = $ThongTin_KH->data->customerInfo->invoice[0]->paid;  
if ($Trang_Thai_TT_ThangNay == false) {
    echo "Chưa Thanh Toán";
} else {echo "Đã Thanh Toán";}
*/
$Ti_Le_ThayDoi_ThangNay = $ThongTin_KH->data->customerInfo->chiSoDienList[0]->sanLuongChangeRate."%"; 
$Ky_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->period;
$Thang_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->month; 
$Nam_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->year;  
$SanLuongKWH_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->usageAmount."(kWh)"; 
$Tong_Tien_ThangTruoc = number_format($ThongTin_KH->data->customerInfo->invoice[1]->paymentTotalAmount)."(VNĐ)"; 
$Trang_Thai_TT_ThangTruoc = $ThongTin_KH->data->customerInfo->invoice[1]->paid; 
$Ky_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->period;
$Thang_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->month; 
$Nam_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->year;  
$SanLuongKWH_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->usageAmount."(kWh)"; 
$Tong_Tien_ThangTruocNua = number_format($ThongTin_KH->data->customerInfo->invoice[2]->paymentTotalAmount)."(VNĐ)"; 
$Trang_Thai_TT_ThangTruocNua = $ThongTin_KH->data->customerInfo->invoice[2]->paid; 
$SL_Ngay_HomQua = $Get_SL_Ngay->data[2]->ngayTieuThu;
$SL_SoDien_HomQua = $Get_SL_Ngay->data[2]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomQua = $Get_SL_Ngay->data[2]->binhThuong."(kWh)";
$SL_Ngay_HomKia = $Get_SL_Ngay->data[1]->ngayTieuThu;
$SL_SoDien_HomKia = $Get_SL_Ngay->data[1]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomKia = $Get_SL_Ngay->data[1]->binhThuong."(kWh)";
$SL_Ngay_HomKiaf = $Get_SL_Ngay->data[0]->ngayTieuThu;
$SL_SoDien_HomKiaf = $Get_SL_Ngay->data[0]->sanLuongBinhThuong."(kWh)";
$SL_Tong_So_Dien_HomKiaf = $Get_SL_Ngay->data[0]->binhThuong."(kWh)";
$VuTuyen = array("name"=>"Get Data EVN Miền Bắc","MaKhachHang"=>"$MaKhachHang","TenKhachHang"=>"$Ten_Khach_Hang","DiaChi"=>"$DiaChi_KH","SDT"=>"$SDT_KH","NoiCapDien"=>"$Cty_Cap_Dien",
"DiaChiNoiCapDien"=>"$DiaChi_Cty_Cap_Dien","MaSoCongTo"=>"$Ma_So_Cong_To","ChiSoCu"=>"$Chi_So_Cu","ChiSoMoi"=>"$Chi_So_Moi","TrangThaiMatDien"=>"$Trang_Thai_Dien","LanThayDoiCuoi"=>"$SetThoiGian",
    "SanLuong_HomQua" => array(
        array(
            "Ngay_Thang" => "$SL_Ngay_HomQua",
			"San_Luong" => "$SL_SoDien_HomQua",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomQua"
        ) ),
    "SanLuong_HomKia" => array(
		array(
			"Ngay_Thang" => "$SL_Ngay_HomKia",
			"San_Luong" => "$SL_SoDien_HomKia",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomKia"
        ), ),
    "SanLuong_HomKiaf" => array(
		array(
			"Ngay_Thang" => "$SL_Ngay_HomKiaf",
			"San_Luong" => "$SL_SoDien_HomKiaf",
			"Tong_So_Dien" => "$SL_Tong_So_Dien_HomKiaf"
        ) ),
    "Tien_Dien_Thang_Nay" => array(
		array(
			"Ky" => "$Ky_ThangNay",
			"Thang" => "$Thang_ThangNay",
			"Nam" => "$Nam_ThangNay",
			"SanLuong" => "$SanLuongKWH_ThangNay",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangNay",
//			"TrangThai_ThanhToan" => "$Trang_Thai_TT_ThangNay",
			"Ti_Le_ThayDoi" => "$Ti_Le_ThayDoi_ThangNay"
			
        )),
    "Tien_Dien_Thang_Truoc" => array(
		array(
			"Ky" => "$Ky_ThangTruoc",
			"Thang" => "$Thang_ThangTruoc",
			"Nam" => "$Nam_ThangTruoc",
			"SanLuong" => "$SanLuongKWH_ThangTruoc",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangTruoc"
			
        )),
	"Tien_Dien_Thang_Truoc_Nua" => array(
		array(
			"Ky" => "$Ky_ThangTruocNua",
			"Thang" => "$Thang_ThangTruocNua",
			"Nam" => "$Nam_ThangTruocNua",
			"SanLuong" => "$SanLuongKWH_ThangTruocNua",
			"SoTien_ThanhToan" => "$Tong_Tien_ThangTruocNua"
			
        )));
echo json_encode($VuTuyen);


?>