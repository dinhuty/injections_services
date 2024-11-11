<?php
include('header.php');
include('required.php');

?>

<div class="min-h-screen flex flex-col gap-5">
<?php
include('welcome.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $row['id'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['street-address'];
  $age = $_POST['age'];
  $service_id = $_POST['service'];

  $service_sql = "SELECT * FROM services WHERE id = $service_id";
  $service_result = mysqli_query($connection, $service_sql);
  $service_row = mysqli_fetch_array($service_result);
  
  if ($service_row) {
      $service_name = $service_row['name'];
      $service_price = $service_row['price'];
  }

  $staff_sql = "SELECT id FROM users WHERE role = 'staff' LIMIT 1"; 
  $staff_result = mysqli_query($connection, $staff_sql);
  
  if ($staff_row = mysqli_fetch_array($staff_result)) {
      $staff_id = $staff_row['id'];
  } else {
      echo "<p>Lỗi: Không tìm thấy nhân viên với role 'staff'.</p>";
      exit;
  }

  $total = $service_price;
  $payment_status = 'Chưa thanh toán';
  

  $insert_bill_sql = "INSERT INTO bills (staff_id, total, payment_status) VALUES ('$staff_id', '$total', '$payment_status')";
  if (mysqli_query($connection, $insert_bill_sql)) {

      $bill_id = mysqli_insert_id($connection);
      
      $insert_injection_sql = "INSERT INTO registrations (user_id, service_id, status, bill_id) VALUES ('$user_id', '$service_id', 'Chưa tiêm', '$bill_id')";
      if (mysqli_query($connection, $insert_injection_sql)) {
        echo '<span class=" my-6 py-2 w-[384px] inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Đăng ký tiêm thành công</span>';
      } else {
          echo "<p>Lỗi khi tạo phiếu tiêm: " . mysqli_error($connection) . "</p>";
      }
  } else {
      echo "<p>Lỗi khi tạo hóa đơn: " . mysqli_error($connection) . "</p>";
  }
}
?>   
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
 
 <div class="border-b border-gray-900/10 pb-12">
   <div class="flex flex-col gap-2 pb-4">
     <h2 class="text-base/7 font-semibold text-gray-900">Thông tin cá nhân</h2>
     <p class="mt-1 text-sm/6 text-gray-600">Nhập thông tin cá nhân của bạn.</p>
   </div>

   <div class="flex flex-col gap-4">
     <div class="sm:col-span-3">
       <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Tên</label>
       <div class="mt-2">
         <input type="text" value="<?php echo isset($row['name']) ? htmlspecialchars($row['name']) : ''; ?>" name="name" id="first-name" autocomplete="given-name" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
       </div>
     </div>
     <div class="sm:col-span-4">
       <label for="phone" class="block text-sm/6 font-medium text-gray-900">Số điện thoại</label>
       <div class="mt-2">
         <input id="phone" name="phone"  value="<?php echo isset($row['phone']) ? htmlspecialchars($row['phone']) : ''; ?>" type="phone" autocomplete="phone" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
       </div>
     </div>

     <div class="">
     <h3 class="font-20px font-bold pb-4" >Địa chỉ cá nhân</h3>
     <div class="col-span-full">
       <div class="mt-2">
         <input type="text" name="street-address" value="<?php echo isset($row['address']) ? htmlspecialchars($row['address']) : ''; ?>" id="street-address" autocomplete="street-address" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
       </div>
     </div>
     <div class="pt-4">
        <label for="age" class="block text-sm font-medium text-gray-900">Tuổi</label>
        <div class="mt-2">
            <input id="age" name="age" type="number" min="1" value="<?php echo isset($row['age']) ? htmlspecialchars($row['age']) : ''; ?>" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
        </div>
    </div>

     <div class="sm:col-span-3 pt-10">
     <?php
     $service_id = isset($_GET["service"]) ? $_GET["service"] : null; 

     $sql = "SELECT * FROM services ORDER BY id ASC LIMIT 10";
     $result = mysqli_query($connection, $sql);
  ?>
     <h3 class="text-blue-600 font-[20px] font-bold">Chọn dịch vụ đăng ký tiêm</h3>
     <div class="mt-2">
         <select id="service" name="service" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
             <!-- Tạo option mặc định nếu chưa chọn dịch vụ -->
             <option value="">Chọn dịch vụ...</option>
     
             <?php
             // Lặp qua tất cả các dịch vụ và tạo các option cho dropdown
             while ($row = mysqli_fetch_array($result)) {
                 $id = $row['id'];
                 $name = $row['name'];
                 $price = $row['price'];
                 $description = $row['description'];
     
                 // Kiểm tra xem dịch vụ này có phải là dịch vụ được chọn không
                 $selected = ($id == $service_id) ? 'selected' : '';
     
                 // Tạo option cho mỗi dịch vụ
                 echo "<option value=\"$id\" $selected>$name - $price VNĐ</option>";
             }
             ?>
         </select>
     </div>
     </div>   
   </div>
 </div>
<div class="mt-6 flex items-center justify-end gap-x-6">
 <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
 <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Xác nhận đăng ký</button>
</div>
</form>
</div>