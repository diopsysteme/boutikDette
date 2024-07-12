
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded my-6 p-6">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Client Information</h1>
                    <p><strong>Name:</strong> John Doe</p>
                    <p><strong>Phone:</strong> +1234567890</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <form method="GET" action="">
                        <label for="filter" class="mr-2">Filter:</label>
                        <select id="filter" name="filter" class="border rounded p-2">
                            <option value="all">All Debts</option>
                            <option value="paid">Paid Debts</option>
                            <option value="unpaid">Unpaid Debts</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Apply</button>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">Debt Amount</th>
                            <th class="py-2 px-4 border">Paid Amount</th>
                            <th class="py-2 px-4 border">Remaining Amount</th>
                            <th class="py-2 px-4 border">Details</th>
                            <th class="py-2 px-4 border">Payments</th>
                            <th class="py-2 px-4 border">Make Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Sample data, replace this with actual database query
                        $debts = [
                            ['id' => 1, 'amount' => 100, 'paid' => 50, 'remaining' => 50],
                            ['id' => 2, 'amount' => 200, 'paid' => 200, 'remaining' => 0],
                            // Add more debts as needed
                        ];

                        foreach ($debts as $debt) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border'>{$debt['id']}</td>";
                            echo "<td class='py-2 px-4 border'>{$debt['amount']}</td>";
                            echo "<td class='py-2 px-4 border'>{$debt['paid']}</td>";
                            echo "<td class='py-2 px-4 border'>{$debt['remaining']}</td>";
                            echo "<td class='py-2 px-4 border'><button class='bg-gray-500 text-white px-4 py-2 rounded'>Details</button></td>";
                            echo "<td class='py-2 px-4 border'><button class='bg-green-500 text-white px-4 py-2 rounded'>Payments</button></td>";
                            echo "<td class='py-2 px-4 border'><button class='bg-red-500 text-white px-4 py-2 rounded'>Pay</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Previous</button>
                <span>Page 1 of 10</span>
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Next</button>
            </div>
        </div>
    </div>

</body>
</html>
