<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PollManager - Instant Real-Time Polls</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">PollManager</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-600 hover:text-blue-600 font-medium transition">Features</a>
                    <a href="{{ route('admin.login') }}" class="text-slate-600 hover:text-blue-600 font-medium transition">Admin Login</a>
                    <a href="{{ route('admin.register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-full font-semibold shadow-xl shadow-blue-100 hover:bg-blue-700 hover:shadow-blue-200 transition">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl lg:text-7xl font-bold text-slate-900 leading-[1.1] mb-8">
                    Engage your audience with <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Real-Time</span> Polls.
                </h1>
                <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                    Create instant, interactive polls for your meetings, webinars, or social media. Watch the results roll in live with zero delay.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('admin.register') }}" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300">
                        Create Your First Poll
                    </a>
                    <a href="{{ route('admin.login') }}" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold text-lg hover:bg-slate-50 hover:border-slate-300 hover:-translate-y-1 transition-all duration-300">
                        Sign In to Dashboard
                    </a>
                </div>
            </div>

            <!-- Dashboard Preview Mockup -->
            <div class="mt-20 relative px-4">
                <div class="max-w-5xl mx-auto bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-200 p-4">
                    <div class="bg-slate-50 rounded-[1.5rem] p-8 min-h-[400px]">
                        <div class="flex items-center justify-between mb-12">
                            <div class="h-8 w-48 bg-slate-200 rounded-full animate-pulse"></div>
                            <div class="h-10 w-32 bg-blue-100 rounded-full animate-pulse"></div>
                        </div>
                        <div class="space-y-6">
                            <div class="h-20 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl"></div>
                                    <div class="h-4 w-64 bg-slate-100 rounded-full"></div>
                                </div>
                                <div class="h-4 w-12 bg-slate-100 rounded-full"></div>
                            </div>
                            <div class="h-20 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-50 rounded-xl"></div>
                                    <div class="h-4 w-48 bg-slate-100 rounded-full"></div>
                                </div>
                                <div class="h-4 w-12 bg-slate-100 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition group">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition duration-500">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Instant Updates</h3>
                    <p class="text-slate-600">Results broadcast automatically to all users using high-performance WebSockets.</p>
                </div>
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition group">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition duration-500">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Secure Voting</h3>
                    <p class="text-slate-600">Advanced logic prevents multiple votes by tracking IP addresses and user accounts.</p>
                </div>
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition group">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition duration-500">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Clean Reports</h3>
                    <p class="text-slate-600">Manage your polls from a minimal, easy-to-use admin dashboard with detailed analytics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-slate-100 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500">© 2026 PollManager. Built for developers and creators.</p>
        </div>
    </footer>
</body>
</html>
