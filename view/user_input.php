<?php
require_once 'model/model_role.php';
require_once 'model/model_User.php';

session_start();

$modelRole = new Model_role();
$listRoles = $modelRole->getAllRoles();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Input User -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">User Role</h2>
                <form action="index.php?modul=user&fitur=add" method="POST">
                    <!-- Nama User -->
                    <div class="mb-4">
                        <label for="user_nama" class="block text-gray-700 text-sm font-bold mb-2">Nama User:</label>
                        <input type="text" id="user_nama" name="user_nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Nama User" required>
                    </div>
                    <!-- Username -->
                    <div class="mb-4">
                        <label for="user_username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                        <input type="text" id="user_username" name="user_username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Username" required>
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="user_password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="password" id="user_password" name="user_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Password" required>
                    </div>
                    <!-- Role Name -->
                    <div class="mb-4">
                        <label for="user_role_id" class="block text-gray-700 text-sm font-bold mb-2">Role Name:</label>
                        <select id="user_role_id" name="user_role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($listRoles as $role) {
                                if ($role->role_status == 1) {
                            ?>
                                    <option value="<?php echo htmlspecialchars($role->role_id); ?>">
                                        <?php echo htmlspecialchars($role->role_name); ?>
                                    </option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>