<div class="bg-white rounded-[24px] p-6 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">

    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>

    <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                <?php echo isset($note['created_at']) ? date('M d, Y', strtotime($note['created_at'])) : date('M d, Y'); ?>
            </span>
        <div class="flex gap-2">
            <button class="text-slate-300 hover:text-indigo-500 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </button>
        </div>
    </div>

    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">
        <?php echo htmlspecialchars($note['title'] ?? 'Untitled Note'); ?>
    </h3>

    <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
        <?php echo htmlspecialchars($note['content'] ?? $note['body'] ?? 'No content available...'); ?>
    </p>

    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
        <div class="flex items-center gap-1.5 px-3 py-1 bg-indigo-50 rounded-full">
            <svg class="w-3 h-3 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span class="text-[10px] font-bold text-indigo-700 uppercase tracking-tight">AI Distilled</span>
        </div>

        <div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
            <!--Delete icon-->
            <form method="POST" action="/notes">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= htmlspecialchars($note['id'] ?? '') ?>">
                <button type="submit" class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-red-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
            <button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-indigo-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            </button>
        </div>
    </div>
</div>