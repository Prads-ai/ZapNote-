<?php partial('head')?>
<?php partial('nav')?>

<div class="min-h-screen pt-32 pb-20 px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-3 mb-6">
                <div class="w-16 h-16 zap-gradient rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-200">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight bg-clip-text text-transparent zap-gradient">
                    About ZapNote
                </h1>
            </div>
            <p class="text-xl text-slate-500 max-w-2xl mx-auto">
                Your thoughts, distilled.
            </p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-[32px] shadow-2xl shadow-indigo-100 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="prose prose-lg max-w-none">
                    <p class="text-lg text-slate-700 leading-relaxed mb-6">
                        ZapNote is an intelligent note app built with vanilla PHP, designed to capture your ideas and instantly transform them into clear, concise summaries. It helps you organize, review, and share your notes with clarity — whether you're brainstorming, studying, or planning your next move.
                    </p>

                    <div class="grid md:grid-cols-2 gap-8 mt-10">
                        <div class="p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 zap-gradient rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">Capture Everything</h3>
                            </div>
                            <p class="text-slate-600">
                                Don't worry about organizing as you write. Just capture your raw thoughts and let ZapNote handle the rest.
                            </p>
                        </div>

                        <div class="p-6 bg-purple-50 rounded-2xl border border-purple-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 zap-gradient rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">AI-Powered</h3>
                            </div>
                            <p class="text-slate-600">
                                Powered by AI to help you organize, review, and share your notes with clarity and precision.
                            </p>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 zap-gradient rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">Easy Search</h3>
                            </div>
                            <p class="text-slate-600">
                                Quickly find any note with our powerful search functionality that searches through titles and content.
                            </p>
                        </div>

                        <div class="p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 zap-gradient rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">Secure & Private</h3>
                            </div>
                            <p class="text-slate-600">
                                Your notes are secure and private. Only you can access your thoughts and ideas.
                            </p>
                        </div>
                    </div>

                    <div class="mt-12 p-8 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Perfect For</h2>
                        <ul class="space-y-3 text-slate-700">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Brainstorming</strong> - Capture ideas as they come, organize later</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Studying</strong> - Take notes and get instant summaries</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Planning</strong> - Organize your thoughts and plan your next move</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-12 text-center">
            <a href="/register" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                <span>Get Started Free</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<?php partial('footer')?>

