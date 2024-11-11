<?php
include('../layouts/header.php');
?>
<div class="flex flex-col gap-4">
    <h3 class="text-[23px]">Hệ thống quản lý</h3>
    <div class="p-4">
        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
            </div>
            <div class="flex-auto">
                <a href="" class="block font-semibold text-gray-900">
                    Xem thống kê khách hàng
                    <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">Thông tin thống kê user, dịch vụ tiêm</p>
            </div>
        </div>
        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
            </div>
            <div class="flex-auto">
                <a href="./user-management.php" class="block font-semibold text-gray-900">
                    Quán lý người dùng
                    <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">Quản lý thông tin người dùng</p>
            </div>
        </div>
        <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                </svg>
            </div>
            <div class="flex-auto">
                <a href="./service-management.php" class="block font-semibold text-gray-900">
                    Danh sách đăng ký
                    <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">Xem thông tin dịch vụ tiêm</p>
            </div>
        </div>
    </div>
</div>

<?php
include('../layouts/footer.php');
?>