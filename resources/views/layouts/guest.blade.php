<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css CDN for smooth animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Custom Fonts (Google Fonts) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom input focus effect */
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
            border-color: #6366f1; /* Indigo-500 */
        }
        /* Button gradient animation */
        .btn-gradient {
            background: linear-gradient(45deg, #6366f1, #4f46e5);
            background-size: 200% 200%;
            animation: gradientBG 3s ease infinite;
        }
        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-indigo-700 min-h-screen flex items-center justify-center px-6">
    {{ $slot }}
</body>
</html>
