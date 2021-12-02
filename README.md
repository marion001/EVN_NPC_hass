# EVN_NPC_hass
Get Data EVN Miền Bắc

api lấy dữ liệu đồng hồ điện lực miền bắc

Đầu tiên các bạn cần cài web server (apache2 + php) bạn nào chưa có thì lên google hoặc youtube xem hướng dẫn cài trực tiếp vào pi hoặc androibox đang chạy hass của bạn

Các bạn tải thư mục EVN_NPC_hass về rồi upload thư mục đó lên web server của bạn,
tiếp đến bạn set phân quyền 777 cho thư mục EVN_NPC_hass bằng lệnh: "chmod 777 EVN_NPC_hass"
tiếp theo mở file EVN_NPC_CONFIG thay mã khách hàng của bạn vào dòng: $MaKhachHang = "PA***********";.



Cài xong các bạn chạy file trên trình duyệt 
  - ví dụ: http://IP_Web_Server_Cua_Ban/EVN_NPC_hass/EVN_NPC_JSON.php
  - demo: http://192.186.14.17/EVN_NPC_hass/EVN_NPC_JSON.php  nó sẽ hiện ra các thông tin của đồng hồ điện nhà b như dưới này là ok

      
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
  
  ![VD1](https://user-images.githubusercontent.com/27297851/136682598-45b43255-3526-4ad5-8715-5bbbba2c293d.png)

  
Cấu hình trên has demo: coppy nội dung dưới vào sensors.yaml, thay url/Link của bạn cho phù hợp

    - platform: rest  
      name: "EVN Miền Bắc"
      resource: "http://192.168.14.17/EVN_NPC_hass/EVN_NPC_JSON.php"
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
        - SL_Dien_Theo_ngay
        - LichCatDien
        - UocTinhTienDienThangNay
        - Tien_Dien_Thang_Nay
        - Tien_Dien_Thang_Truoc
        - Tien_Dien_Thang_Truoc_Nua


Demo ảnh Sensor:
![VD4](https://user-images.githubusercontent.com/27297851/136682914-c72dbadf-f853-4180-a581-8d710ab53044.png)


Cấu hình trong lovelace:
Demo UI:

    type: horizontal-stack
    cards:
     - type: markdown
       content: >
         <center><b><font color=Yellow>Thông Tin Đồng Hồ
         Điện</font></b></center>Tên KH:<font color=gree> {{
         state_attr('sensor.evn_mien_bac','TenKhachHang')}}</font> (<font
         color=gree> {{
         state_attr('sensor.evn_mien_bac','TrangThaiMatDien')}}</font> ) <br/>

         Mã KH:<font color=gree> {{
         state_attr('sensor.evn_mien_bac','MaKhachHang')}}</font><br/>

         Mã Công Tơ: <font color=gree> {{
         state_attr('sensor.evn_mien_bac','MaSoCongTo')}}</font><br/> Chỉ Số Cũ:
         <b><font color=CCFF66> {{
         state_attr('sensor.evn_mien_bac','ChiSoCu')}}</font></b>

         Chỉ Số Mới: <b><font color=00FFCC> {{
         state_attr('sensor.evn_mien_bac','ChiSoMoi')}}</font></b><br/>
         Lịch Cắt Điện: <font color=gree> {{
         state_attr('sensor.evn_mien_bac','LichCatDien').Ngay}}</font> <font
         color=gree> {{state_attr('sensor.evn_mien_bac','LichCatDien').Thoigian}}</font><br/>
         Lần Cập Nhật
         Cuối: <font color=gree> {{
         state_attr('sensor.evn_mien_bac','LanThayDoiCuoi')}}'</font> <hr/>


         <center><b><font color=Yellow>Sản Lượng Điện Ngày</font></b></center> Hôm
         Kia:  <font color='gree'> {{
         state_attr('sensor.evn_mien_bac','SL_Dien_Theo_ngay').HomKia.Ngay}}</font>
         - <font color=gree> {{
         state_attr('sensor.evn_mien_bac','SL_Dien_Theo_ngay').HomKia.SanLuongTieuThu}}</font><br/>
         Hôm Kìa:  <font color='gree'> {{
         state_attr('sensor.evn_mien_bac','SL_Dien_Theo_ngay').HomKiaf.Ngay}}</font>
         - <font color=gree> {{
         state_attr('sensor.evn_mien_bac','SL_Dien_Theo_ngay').HomKiaf.SanLuongTieuThu}}</font><br/>
         <font color=Yellow><b>- Ước Tính Tiền Điện Tháng Này:</b></font><br/> Ước
         Tính Đến Ngày: <font color='gree'> {{
         state_attr('sensor.evn_mien_bac','SL_Dien_Theo_ngay').HomKia.Ngay}}</font>,
         SL: <font color='gree'> {{
         state_attr('sensor.evn_mien_bac','UocTinhTienDienThangNay').ThoiDiemHienTai.Dien_Nang_Tieu_Thu}}</font><br/>
         Số Tiền Cần TT (+10% VAT): <font color='gree'> {{
         state_attr('sensor.evn_mien_bac','UocTinhTienDienThangNay').ThoiDiemHienTai.Tong_Tien_Can_TT}}</font>


         <hr/><center><b><font color=Yellow>Thông Tin Thanh Toán Tiền
         Điện</font></b></center> 


         Kỳ <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Ky}}</font>
         Tháng <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Thang}}-{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Nam}}</font>

         - Sản Lượng Điện: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.SanLuong}}</font>

         - Tổng Tiền (+10% VAT): <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.SoTien_ThanhToan}}</font> 

         - Trạng Thái Thanh Toán: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.TrangThai_ThanhToan}}</font>

         - Tỉ Lệ: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Nay').0.Ti_Le_ThayDoi}}</font>
         So Với Tháng Trước


         Tháng: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.Thang}}-{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.Nam}}</font>

         - Sản Lượng Điện: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.SanLuong}}</font>

         - Tổng Tiền (+10% VAT): <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.SoTien_ThanhToan}}</font>

         - Trạng Thái Thanh Toán: <font color=gree>{{
         state_attr('sensor.evn_mien_bac','Tien_Dien_Thang_Truoc').0.TrangThai_ThanhToan}}</font>
Demo Ảnh UI Lovelace 
![VD3](https://user-images.githubusercontent.com/27297851/136682868-072401d9-f88f-44fa-9bf4-97df7b79e6a5.png)


Demo Ảnh:
![VD2](https://user-images.githubusercontent.com/27297851/136682705-33a0e264-5f62-443a-85c0-3906f816dba7.png)

Tạo Automation Thông Báo Khi Có Lịch Cắt Điện:

    - id: '16343656465466555551964047'
      alias: Thông Báo Lịch Mất Điện tts và notify
      trigger:
        platform: time 
        at: '20:01:00'
      condition:
        condition: template
        value_template: >
          {% if state_attr('sensor.evn_mien_bac','LichCatDien').Ngay == 'Không Có Lịch Cắt Điện' %}
            false
          {% else %}
            true
          {% endif %}
      action:
      - service: notify.notify
        data:
          title: "Lịch Cắt Điện:"
          message: "Ngày {{state_attr('sensor.evn_mien_bac','LichCatDien').Ngay}} {{state_attr('sensor.evn_mien_bac','LichCatDien').Thoigian}}"
      - service: tts_viettel.say
        data_template:
          entity_id: media_player.phong_ngu_tuyen    
          message: "Thông Báo Lịch Cắt Điện: Ngày {{state_attr('sensor.evn_mien_bac','LichCatDien').Ngay}} {{state_attr('sensor.evn_mien_bac','LichCatDien').Thoigian}}"
          voice_type: 'nu_mien_bac_01'    
          speed: '0.9'
      - delay: '00:00:7'
      - service: tts_viettel.say
        data_template:
          entity_id: media_player.phong_ngu_tuyen    
          message: "Thông Báo Lại: Lịch Cắt Điện: Ngày {{state_attr('sensor.evn_mien_bac','LichCatDien').Ngay}} {{state_attr('sensor.evn_mien_bac','LichCatDien').Thoigian}}"
          voice_type: 'nu_mien_bac_01'    
          speed: '0.9'
