<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-red-500 to-red-400 min-h-screen flex justify-center items-center">

    <div class="bg-black bg-opacity-70 p-8 rounded-lg shadow-lg w-full max-w-md">
        <header class="text-center mb-6">
            <h1 class="text-4xl font-bold text-white">📘 Placement Portal</h1>
        </header>

        <main>
            <div class="text-center">
                <h2 class="text-2xl text-white mb-4"><?php echo isset($_GET['role']) ? ucfirst($_GET['role']) : 'User'; ?> Login</h2>
                <p class="text-white mb-6">Please enter your credentials to access the <?php echo isset($_GET['role']) ? $_GET['role'] : 'user'; ?> dashboard.</p>
                
                <!-- Login Form -->
                <form action="login_process.php" method="POST" class="space-y-4">
                    <input type="hidden" name="role" value="<?php echo isset($_GET['role']) ? $_GET['role'] : ''; ?>">

                    <!-- Email Input -->
                    <div class="flex flex-col">
                        <label for="email" class="text-sm text-white mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required 
                               class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                    </div>

                    <!-- Password Input -->
                    <div class="flex flex-col">
                        <label for="password" class="text-sm text-white mb-2">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required
                               class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full py-2 bg-red-500 text-white rounded-md font-semibold hover:bg-red-600 transition duration-300">
                        Login
                    </button>
                </form>
                
                <!-- Back to Home Link -->
                <div class="mt-4">
                    <a href="../index.html" class="text-red-500 hover:text-white text-sm">Back to Home</a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-6 text-center text-white text-sm">
            <p>&copy; 2024 Placement Portal. All rights reserved.</p>
        </footer>
    </div>

</body>
</html>
