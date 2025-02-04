<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom CSS for Date Input */
        .date-input {
            border: 1px solid #4B5563;
            border-radius: 0.375rem;
            background-color: #1F2937;
            color: #E5E7EB;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .date-input:hover,
        .date-input:focus {
            border-color: #3B82F6;
            background-color: #374151;
        }

        /* Custom Styling for the Charts */
        .chart-container {
            background-color: #2D3748;
            border-radius: 0.375rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-container canvas {
            border-radius: 0.375rem;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4A90E2',
                        secondary: '#50E3C2',
                        accent: '#F5A623',
                        background: '#1F2937',
                        card: '#374151',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-background container mx-auto text-white font-sans">

    <div class="lg:flex flex-col h-screen">

        @include('layouts.header')

        <!-- Sidebar (Hidden on Mobile) -->
        @include('layouts.sidebar')

        @yield('content')

        <script>
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
    
            // Toggle Sidebar on Mobile
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        </script>
    
    </body>
    
    </html>