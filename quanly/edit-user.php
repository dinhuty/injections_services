<?php
include('../layouts/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = mysqli_query($connection, $sql);
    $user = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $role = $_POST['role'];

        $updateSql = "UPDATE users SET name='$name', phone='$phone', address='$address', age='$age', role='$role' WHERE id='$id'";
        $updateQuery = mysqli_query($connection, $updateSql);

        header("Location: ./user-management.php");
        exit;
    }

    if (isset($_POST['delete'])) {
        $deleteSql = "DELETE FROM users WHERE id='$id'";
        $deleteQuery = mysqli_query($connection, $deleteSql);

        header("Location: ./user-management.php");
        exit;
    }
}

?>

<div class="flex flex-col gap-4">
    <h3 class="text-[23px]">Chỉnh sửa thông tin</h3>

    <form action="edit-user.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên người dùng</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
            <textarea id="address" name="address" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"><?php echo htmlspecialchars($user['address']); ?></textarea>
        </div>

        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Tuổi</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Vai trò</label>
            <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>Người dùng</option>
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Quản trị viên</option>
                <option value="staff" <?php echo $user['role'] == 'staff' ? 'selected' : ''; ?>>Nhân viên</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" name="update" class="px-4 py-2 bg-blue-600 text-white rounded-md">Cập nhật</button>
            <button type="submit" name="delete" class="px-4 py-2 bg-red-600 text-white rounded-md">Xóa</button>
        </div>
    </form>
</div>

<?php
include('../layouts/footer.php');
?>