<?php
require("header.php");
include('required.php');
include('welcome.php');

$user_id = $row['id'];
$sql = "
    SELECT r.id AS registration_id, 
           u.name AS user_name, 
           u.phone AS user_phone, 
           u.address AS user_address, 
           u.age AS user_age, 
           s.name AS service_name, 
           s.price AS service_price, 
           s.description AS service_description, 
           r.status AS registration_status, 
           b.total AS bill_total, 
           b.payment_status AS bill_payment_status
    FROM registrations r
    JOIN users u ON r.user_id = u.id
    JOIN services s ON r.service_id = s.id
    LEFT JOIN bills b ON r.bill_id = b.id
    WHERE r.user_id = $user_id
    ORDER BY r.id ASC
";

$result = mysqli_query($connection, $sql);

echo '<div class="relative overflow-x-auto">';
echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 w-[40px]">
                    Mã đăng ký
                </th>
                <th scope="col" class="px-6 py-3 w-[150px]">
                    Tên người dùng
                </th>
                <th scope="col" class="px-6 py-3 w-[150px]">
                    Số điện thoại
                </th>
                <th scope="col" class="px-6 py-3 w-[200px]">
                    Dịch vụ
                </th>
                <th scope="col" class="px-6 py-3">
                    Giá dịch vụ
                </th>
                <th scope="col" class="px-6 py-3">
                    Trạng thái đăng ký
                </th>
                <th scope="col" class="px-6 py-3">
                    Tổng hóa đơn
                </th>
                <th scope="col" class="px-6 py-3 w-[200px]">
                    Trạng thái thanh toán
                </th>
            </tr>
        </thead>
        <tbody>';

    while ($row = mysqli_fetch_array($result)) {
        $registration_id = $row['registration_id'];
        $user_name = $row['user_name'];
        $user_phone = $row['user_phone'];
        $user_address = $row['user_address'];
        $user_age = $row['user_age'];
        $service_name = $row['service_name'];
        $service_price = number_format($row['service_price'], 2);
        $service_description = $row['service_description'];
        $registration_status = $row['registration_status'];
        $bill_total = number_format($row['bill_total'], 2);
        $payment_status = $row['bill_payment_status'];

        echo '<tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                    ' . $registration_id . ' 
                </th>
                <td class="px-6 py-4">
                    ' . $user_name . '
                </td>
                <td class="px-6 py-4">
                    ' . $user_phone . '
                </td>
                <td class="px-6 py-4 text-ellipsis overflow-hidden whitespace-nowrap">
                    ' . $service_name . '
                </td>
                <td class="px-6 py-4">
                    ' . $service_price . ' VNĐ
                </td>
                <td class="px-6 py-4">
                    ' . $registration_status . '
                </td>
                <td class="px-6 py-4">
                    ' . $bill_total . ' VNĐ
                </td>
                <td class="px-6 py-4 ">
                <span class="my-6 py-2 inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">   ' . $payment_status . '</span>
                </td>
            </tr>';
    }

echo '</tbody>
    </table>
</div>';

require("footer.php");
?>
