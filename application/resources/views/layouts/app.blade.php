<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Isi Bin - Control Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(59,130,246,0.3); }
            50% { box-shadow: 0 0 20px rgba(59,130,246,0.5); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bin-card {
            transition: all 0.3s ease;
            animation: slideIn 0.3s ease-out;
        }
        .bin-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 30px -15px rgba(0,0,0,0.3);
        }
        .bin-filled {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .bin-empty {
            background: linear-gradient(135deg, #ececec 0%, #d4d4d4 100%);
        }
        .level-bar {
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .category-header {
            position: relative;
            overflow: hidden;
        }
        .category-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine 3s infinite;
        }
        @keyframes shine {
            100% { left: 100%; }
        }
        .pill-status {
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    
    {{-- HEADER UNIK --}}
    <nav class="bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900 text-white shadow-2xl">
        <div class="container mx-auto px-4 py-5">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/10 p-3 rounded-2xl">
                        <i class="fas fa-database text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold tracking-wide">📦 INFORMASI ISI BIN</h1>
                        <p class="text-sm text-blue-200 mt-1">🎛️ Control Room Production Panel | Real-time Monitoring</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 px-4 py-2 rounded-full">
                        <i class="fas fa-microchip mr-2"></i>
                        <span class="text-sm font-semibold">Operator Panel v1.0</span>
                    </div>
                    <button onclick="location.reload()" class="bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg transition">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-xl mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>