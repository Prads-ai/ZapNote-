<?php partial('head')?>
<?php partial('nav')?>

<div class="min-h-screen pt-32 pb-12 px-6 flex items-center justify-center">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-[32px] shadow-2xl shadow-indigo-100 border border-slate-100 overflow-hidden">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 zap-gradient rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-slate-900">Welcome Back</h2>
                </div>
                <p class="text-sm text-slate-500">Sign in to access your notes</p>
            </div>

            <!-- Success Message -->
            <?php if(!empty($success)): ?>
                <div class="px-8 pt-6">
                    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-4">
                        <p class="text-sm text-green-700"><?php echo htmlspecialchars($success); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Error Messages -->
            <?php if(!empty($errors) && is_array($errors) && count($errors) > 0): ?>
                <div class="px-8 pt-6">
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <ul class="list-disc list-inside space-y-1">
                                    <?php foreach ($errors as $key => $error): ?>
                                        <li class="text-sm text-red-700"><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="/login" method="POST" class="p-8">
                <div class="mb-6">
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="you@example.com"
                    />
                </div>

                <div class="mb-8">
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="••••••••"
                    />
                </div>

                <button type="submit" class="w-full px-6 py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    Sign In
                </button>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">
                        Don't have an account? 
                        <a href="/register" class="text-indigo-600 font-bold hover:text-indigo-700">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php partial('footer')?>

