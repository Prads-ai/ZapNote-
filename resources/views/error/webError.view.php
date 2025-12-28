<?php partial('head');?>

<div class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
    <div class="relative mb-12">
        <div class="absolute inset-0 bg-indigo-500/20 blur-[80px] rounded-full"></div>

        <div class="relative w-32 h-32 md:w-40 md:h-40 zap-gradient rounded-[32px] flex items-center justify-center shadow-2xl shadow-indigo-200 rotate-12">
            <svg class="w-20 h-20 text-white glitch-subtle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 5l14 14" class="opacity-30 text-slate-900"></path>
            </svg>
        </div>

        <div class="absolute -bottom-4 -right-4 bg-slate-900 text-white px-4 py-2 rounded-xl font-bold text-lg shadow-xl">
            <?php echo htmlspecialchars($code ?? 404); ?>
        </div>
    </div>

    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">
        <?php echo ($code ?? 404) == 404 ? 'Thought not found.' : 'Oops! Something went wrong.'; ?>
    </h1>

    <?php if (!empty($message)): ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 max-w-md mx-auto rounded">
            <p class="font-semibold">Error Details:</p>
            <p class="text-sm mt-1"><?php echo htmlspecialchars($message); ?></p>
        </div>
    <?php else: ?>
        <p class="text-slate-500 text-lg max-w-md mx-auto mb-10 leading-relaxed">
            It looks like this note has been distilled into thin air, or the link you followed is broken.
        </p>
    <?php endif; ?>

    <div class="flex flex-col sm:flex-row gap-4 w-full max-w-xs sm:max-w-none justify-center">
        <a href="/" class="px-8 py-4 zap-gradient text-white rounded-2xl font-bold text-lg hover:shadow-2xl hover:shadow-indigo-300 transition-all transform hover:-translate-y-1">
            Back to Dashboard
        </a>
        <button onclick="history.back()" class="px-8 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-bold text-lg hover:bg-slate-50 transition-all">
            Go Back
        </button>
    </div>

    <div class="mt-20">
        <div class="flex items-center justify-center gap-2 opacity-40">
            <div class="w-6 h-6 zap-gradient rounded flex items-center justify-center">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <span class="font-bold tracking-tight">ZapNote</span>
        </div>
    </div>
</div>

