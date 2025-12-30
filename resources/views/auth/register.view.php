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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-slate-900">Create Account</h2>
                </div>
                <p class="text-sm text-slate-500">Join ZapNote and start organizing your thoughts</p>
            </div>

            <!-- Error Messages -->
            <?php if(!empty($errors) && is_array($errors) && count($errors) > 0): ?>
                <div class="px-8 pt-6">
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-bold text-red-800 mb-2">Please fix the following errors:</h3>
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

            <!-- Registration Form -->
            <form action="/register" method="POST" class="p-8">
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="John Doe"
                    />
                </div>

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

                <div class="mb-6">
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="••••••••"
                    />
                    <p class="mt-1 text-xs text-slate-400">Must be at least 6 characters</p>
                </div>

                <div class="mb-8">
                    <label for="password_confirm" class="block text-sm font-bold text-slate-700 mb-2">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="••••••••"
                    />
                </div>

                <button type="submit" class="w-full px-6 py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    Create Account
                </button>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">
                        Already have an account? 
                        <a href="/login" class="text-indigo-600 font-bold hover:text-indigo-700">Sign in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php partial('footer')?>

