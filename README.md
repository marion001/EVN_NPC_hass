# EVN_NPC_hass
Get Data EVN Miền Bắc

api lấy dữ liệu đồng hồ điện lực miền bắc

Các bạn tải 2 file: EVN_NPC_JSON.php và file EVN_NPC_CONFIG.php về, tải xong mở file EVN_NPC_CONFIG.php thay mã khách hàng của bạn vào dòng: $MaKhachHang = "PA***********";.

tiếp đến các bạn up lên host hoặc (cài apache và cài php, cài thêm cả các php common extensions trên server của bạn).

Cài xong các bạn chạy file trên trình duyệt
  - VD: http://192.186.14.17/EVN_NPC_JSON.php  nó sẽ hiện ra các thông tin của đồng hồ điện nhà b như dưới này là ok

      
  "name": "Get Data EVN Miền Bắc",
  "MaKhachHang": "PA",
  "TenKhachHang": "Vũ xxxxxx",
  "DiaChi": "xxxxxxxxxxxxxxxxxxxx",
  "SDT": "0xxxxxxxxxxxxx",
  "NoiCapDien": "ĐIỆN LỰC xxxxxxxxxxxxxxx",
  "DiaChiNoiCapDien": "Thị trấn xxxxxxxxxxxxxxxxxxxxxxx",
  "MaSoCongTo": "20xxxxxx",
  "ChiSoCu": "1225(kWh)",
  "ChiSoMoi": "1461(kWh)",
  "TrangThaiMatDien": "Hiện Đang có điện",
  "LanThayDoiCuoi": "18:10",
  "SanLuong_HomQua": [
  .............................
  .............................
  
Cấu hình trên has demo: coppy nội dung dưới vào sensors.yaml, thay url/Link của bạn cho phù hợp

    - platform: rest  
      name: "EVN Miền Bắc"
      resource: "http://192.168.14.17/EVN_NPC_JSON.php"
      value_template: '{{ value_json.name }}'
      timeout: 60
      scan_interval:
        minutes: 360 #6 tiếng scan 1 lần
      force_update: true
      json_attributes:
        - name
        - MaKhachHang
        - TenKhachHang
        - DiaChi
        - SDT
        - NoiCapDien
        - DiaChiNoiCapDien
        - MaSoCongTo
        - ChiSoCu
        - ChiSoMoi
        - TrangThaiMatDien
        - LanThayDoiCuoi
        - SanLuong_HomQua
        - SanLuong_HomKia
        - SanLuong_HomKiaf
        - Tien_Dien_Thang_Nay
        - Tien_Dien_Thang_Truoc
        - Tien_Dien_Thang_Truoc_Nua
