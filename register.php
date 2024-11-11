<?php
include('header.php');
?>
<div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign up</h2>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $age = (int)$_POST['age'];

        $hashed_password = md5($password);

        $check_phone_query = "SELECT * FROM users WHERE phone = '$phone'";
        $check_phone_result = mysqli_query($connection, $check_phone_query);

        if (mysqli_num_rows($check_phone_result) > 0) {
            echo '<span class="my-6 py-2 w-[384px] inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Tài khoản đã được đăng ký</span>';
        } else {
            $query = "INSERT INTO users (name, phone, password, address, age, role) VALUES ('$name', '$phone', '$hashed_password', '$address', $age, 'user')";

            if (mysqli_query($connection, $query)) {
                echo '<span class=" my-6 py-2 w-[384px] inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Đăng ký thành công</span>';
            } else {
                echo "Lỗi: " . mysqli_error($connection);
            }
        }
    }
    ?>
    <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900">Tên</label>
                <div class="mt-2">
                    <input id="name" require name="name" type="text" required class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                </div>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-900">Số điện thoại (dùng để đăng nhập)</label>
                <div class="mt-2">
                    <input id="phone" require name="phone" type="text" required class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Mật khẩu</label>
                </div>
                <div class="mt-2">
                    <input id="password" require name="password" type="password" autocomplete="current-password" required class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-900">Địa chỉ</label>
                <div class="mt-2">
                    <input id="address" name="address" type="text" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                </div>
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-gray-900">Tuổi</label>
                <div class="mt-2">
                    <input id="age" name="age" type="number" min="1" class="pl-[12px] block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                </div>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            You don't have account?
            <a href="login.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Đăng nhập</a>
        </p>
    </div>
</div>