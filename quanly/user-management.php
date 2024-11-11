<?php
include('../layouts/header.php');

// Kết nối cơ sở dữ liệu
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);
?>

<div class="flex flex-col gap-4">
    <h3 class="text-[23px]">Quản lý người dùng</h3>
    <div class="flex items-end"><a href="./add-user.php"><button class="rounded-md bg-green-700 p-2 text-white">Thêm mới</button></a></div>

    <div class="p-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tên người dùng
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Số điện thoại
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Địa chỉ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tuổi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Vai trò
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hành động
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($user = mysqli_fetch_assoc($result)) {
                            echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>";
                            echo "<td class='px-6 py-4'>" . htmlspecialchars($user['name']) . "</td>";
                            echo "<td class='px-6 py-4'>" . htmlspecialchars($user['phone']) . "</td>";
                            echo "<td class='px-6 py-4'>" . htmlspecialchars($user['address']) . "</td>";
                            echo "<td class='px-6 py-4'>" . htmlspecialchars($user['age']) . "</td>";
                            echo "<td class='px-6 py-4'>" . htmlspecialchars($user['role']) . "</td>";
                            echo "<td class='px-6 py-4 text-blue-600 underline'><a href='./edit-user.php?id=" . $user['id'] . "'>Edit</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='px-6 py-4 text-center'>Không có người dùng nào.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('../layouts/footer.php');
?>