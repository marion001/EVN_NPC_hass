<?php
#Code By: Marion001
#Youtube: https://www.youtube.com/c/Marion001
#Fb: https://www.facebook.com/TWFyaW9uMDAx
#Page: https://www.facebook.com/Party.Marion002
error_reporting(0);
@date_default_timezone_set('Asia/Ho_Chi_Minh');
$MaKhachHang = "PA23VG*******";  // Thay Mã Khách Hàng Của Bạn Tại Đây PA***********
$SoPha = "1";
$MaDiemDo = "$MaKhachHang"."001";
$MaDVQuanLy = substr("$MaKhachHang", 0, 6);
$SetNgayThang = date("d-m-Y"); 
$SetThoiGian = date("H:i"); 
$TinhToanNgayThang = date_create("$SetNgayThang");
$NgayChotBatDau = date_format(date_modify(date_create("$SetNgayThang"), "-4 days"), "d-m-Y");
$LichCatDien = date_format(date_modify(date_create("$SetNgayThang"), "+15 days"), "d-m-Y");
$API_Get_DD_Info = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL2hvLXNvL0RET19JTkZPLw==")."$MaKhachHang";
$API_Get_Info_KH = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL2hvbWUv")."$MaKhachHang";
$API_Co_Mat_Dien = base64_decode("aHR0cHM6Ly9hcGlucGMuZWR1a2l0ZWFwcC5vbmxpbmUvbW9iaWxlYXBpL3Rob25nLXRpbi1jYXQtZGllbi9nZXQ=");

?>
