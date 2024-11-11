<?php
include('../layouts/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $role = $_POST['role'];

    $check_phone_query = "SELECT * FROM users WHERE phone = '$phone'";
    $check_phone_result = mysqli_query($connection, $check_phone_query);

    if (mysqli_num_rows($check_phone_result) > 0) {
        echo '<span class="my-6 py-2 w-[384px] inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Tài khoản đã được đăng ký</span>';
    } else {
        $password = md5('a');
        $insertSql = "INSERT INTO users (name, phone, password, address, age, role) VALUES ('$name', '$phone', '$password', '$address', '$age', '$role')";
        $insertQuery = mysqli_query($connection, $insertSql);
        header("Location: ./user-management.php");
        exit;
    }
}
?>

<div class="flex flex-col gap-4">
    <h3 class="text-[23px]">Thêm người dùng mới</h3>

    <form action="./add-user.php" method="POST">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên người dùng</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
            <textarea id="address" name="address" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Tuổi</label>
            <input type="number" id="age" name="age" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Vai trò</label>
            <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="user">Người dùng</option>
                <option value="admin">Quản trị viên</option>
                <option value="staff">Nhân viên</option>
                <option value="doctor">Bác sĩ</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Thêm người dùng</button>
        </div>
    </form>
</div>

<?php
include('../layouts/footer.php');
?>