<!DOCTYPE html>
<html lang="en">

<?php
require_once 'model/model_role.php';
$idPeran = $_GET['id'];

$objectRole = new Model_role();

$role = $objectRole->getRoleById(role_id: $idPeran);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Role</h2>
                <form action="../index.php?modul=role&fitur=update&id=<?php echo htmlspecialchars($role->role_id); ?>" method="POST">
                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Role:</label>
                        <input type="text" id="role_name" name="role_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($role->role_name); ?>" required>
                    </div>

                    <!-- Role Deskripsi -->
                    <div class="mb-4">
                        <label for="role_description" class="block text-gray-700 text-sm font-bold mb-2">Role Deskripsi:</label>
                        <textarea id="role_description" name="role_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" required><?php echo htmlspecialchars($role->role_description); ?></textarea>
                    </div>
                    
                    <!-- Role Status -->
                    <div class="mb-4">
                        <label for="role_status" class="block text-gray-700 text-sm font-bold mb-2">Role Status:</label>
                        <select id="role_status" name="role_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Pilih Status</option>
                            <option value=1>Active</option>
                            <option value=0>Inactive</option>
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
