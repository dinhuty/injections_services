<?php
include('header.php');
?>

<?php

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $hashed_password = md5($password);

    $query = "SELECT id, role FROM users WHERE phone = '$phone' AND password = '$hashed_password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Tên khoản hoặc mật khẩu không đúng.";
    }
}
?>
<div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    <?php if ($error): ?>
        <?php echo '<span class=" my-6 py-2 w-[384px]  inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">' . $error . '</span>'; ?>
    <?php endif; ?>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-900">Số điện thoại</label>
                <div class="mt-2">
                    <input id="phone" require name="phone" type="text" required class="pl-[12px] py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Mật khẩu</label>
                </div>
                <div class="mt-2">
                    <input id="password" require name="password" type="password" autocomplete="current-password" required class="pl-[12px] py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Bạn chưa có tài khoản?
            <a href="/vaccination_injections/register.php" class="font-semibold text-indigo-600 hover:text-indigo-500">Đăng ký ngay!</a>
        </p>
    </div>
</div>