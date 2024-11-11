<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require("../db/db.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Injections</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/tailwind-ui-components@1.0.0/dist/index.min.js
    "></script>
</head>

<body>
    <div class="flex flex-col gap-6">
        <nav class="bg-gray-700">
            <div class="mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative container mx-auto flex h-16 items-center justify-between">
                    <div class="flex gap-4">
                        <div class="flex flex-shrink-0 items-center">
                            <img class="h-8 w-auto" src="../assets/logo.svg" alt="Your Company">
                        </div>
                        <div>
                            <div class="flex space-x-4">
                                <a href="/vaccination_injections" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Trang chủ</a>
                                <a href="/vaccination_injections" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Dịch vụ tiêm chủng</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative ml-3">
                        <button class='hover:opacity-70'>
                            <?php
                            if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['user_id'] && $_SESSION['role']) {
                                $id = $_SESSION['user_id'];
                                $sql = "SELECT * FROM users WHERE id='$id'";
                                $query = mysqli_query($connection, $sql);
                                $row = mysqli_fetch_array($query);
                                echo '<div class="flex gap-4">';
                                if ($row['role'] == 'admin') {
                                    echo '<a href="/vaccination_injections/quanly" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Trang quản lý</a>';
                                }
                                echo '<a href="../logout.php" class="block px-4 py-2 text-sm text-white" role="menuitem" tabindex="-1" id="user-menu-item-0">Đăng xuất</a>';
                                echo '</div>';
                            } else {
                                echo '<button class="hover:opacity-70">
                            <a href="/vaccination_injections/login.php" class="block px-4 py-2 text-sm text-white" role="menuitem" tabindex="-1" id="user-menu-item-0">Đăng nhập</a>
                        </button>';
                            }

                            ?>
                        </button>
                    </div>

                </div>
            </div>
        </nav>

        <div class="relative w-full min-h-screen  container mx-auto flex flex-col gap-6">