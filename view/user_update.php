<!DOCTYPE html>
<html lang="en">

<?php
require_once 'model/model_user.php';
$user_id = $_GET['id'];
$obj_modelRole = new Model_role();
$obj_modelUser = new modelUser($obj_modelRole);
$user = $obj_modelUser->getUserById($user_id);
$listRoles = $obj_modelRole->GetAllRoles();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
            <!-- Formulir Update User -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update User</h2>
                <form action="index.php?modul=user&fitur=update&id=<?php echo $user->user_id; ?>" method="POST">

                    <!-- Nama User -->
                    <div class="mb-4">
                        <label for="user_nama" class="block text-gray-700 text-sm font-bold mb-2">Nama User:</label>
                        <input type="text" id="user_nama" name="user_nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="<?php echo htmlspecialchars($user->user_nama); ?>" required>
                    </div>

                    <!-- User Username -->
                    <div class="mb-4">
                        <label for="user_username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                        <input type="text" id="user_username" name="user_username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="<?php echo htmlspecialchars($user->user_username); ?>" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="user_password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="password" id="user_password" name="user_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="password baru (kosongkan jika tidak ingin mengubah)">
                    </div>


                    <!-- Role User -->
                    <div class="mb-4">
                        <label for="user_role_id" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
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
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>