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


Cấu hình trong lovelace:
Demo UI:

    type: horizontal-stack
    cards:
      - type: markdown
        content: >
          <center><b><font color=Yellow>Thông Tin Đồng Hồ Điện</font></b><br/><br/>

          Tên KH:<font color=gree> {{
          state_attr('sensor.evn_mien_bac','TenKhachHang')}}</font> (<font
          color=gree> {{
          state_attr('sensor.evn_mien_bac','TrangThaiMatDien')}}</font> ) <br/>

          Mã KH:<font color=gree> {{
          state_attr('sensor.evn_mien_bac','MaKhachHang')}}</font>

          Mã Công Tơ <font color=gree> {{
          state_attr('sensor.evn_mien_bac','MaSoCongTo')}}</font><br/>

          Chỉ Số Cũ: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','ChiSoCu')}}</font> 

          Chỉ Số Mới: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','ChiSoMoi')}}</font>

          </center>

          <hr/><center><b><font color=Yellow>Sản Lượng Điện Thiêu Thụ Trong 3
          Ngày</font></b></center>

          Hôm Qua: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomQua').0.Ngay_Thang}}</font><br/>


          - Sản Lượng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomQua').0.San_Luong}}</font> |
          Tổng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomQua').0.Tong_So_Dien}}</font>
          </br>


          Hôm Kia: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKia').0.Ngay_Thang}}</font>

          - Sản Lượng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKia').0.San_Luong}}</font> |
          Tổng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKia').0.Tong_So_Dien}}</font>
          </br>


          Hôm Kìa: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKiaf').0.Ngay_Thang}}</font>

          - Sản Lượng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKiaf').0.San_Luong}}</font>
          | Tổng: <font color=gree> {{
          state_attr('sensor.evn_mien_bac','SanLuong_HomKiaf').0.Tong_So_Dien}}</font>
          </br>


          <hr/>

          <center><b><font color=Yellow>Thông Tin Thanh Toán Tiền
          Điện</font></b></center>


          Kỳ <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Ky}}</font>Tháng
          <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Thang}}-{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Nam}}</font>

          - Sản Lượng Điện: <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.SanLuong}}</font>

          - Tổng Tiền (+10% VAT): <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.SoTien_ThanhToan}}</font> 

          - Tỉ Lệ: <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Ti_Le_ThayDoi}}</font> So với tháng trước


          Tháng: <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.Thang}}-{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.Nam}}</font>

          - Sản Lượng Điện: <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.SanLuong}}</font>

          - Tổng Tiền (+10% VAT): <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.SoTien_ThanhToan}}</font>


          Tháng <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc_Nua').0.Thang}}-{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc_Nua').0.Nam}}</font>

          - Sản Lượng Điện: <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc_Nua').0.SanLuong}}</font>

          - Tổng Tiền (+10% VAT): <font color=gree>{{
          state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc_Nua').0.SoTien_ThanhToan}}</font>
