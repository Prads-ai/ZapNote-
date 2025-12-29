<?php partial('head')?>
<?php partial('nav')?>

<div class="max-w-3xl mx-auto p-4 pt-28">
    <div class="bg-white rounded-[32px] shadow-2xl shadow-indigo-100 border border-slate-100 overflow-hidden">

        <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900">New Thought</h2>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Drafting in Workspace</p>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 bg-white border border-slate-200 rounded-full">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-bold text-slate-600 uppercase">AI Ready</span>
            </div>
        </div>

        <form action="/notes/create" method="POST" class="p-8">
            <div class="mb-6">
                <input
                    type="text"
                    name="title"
                    placeholder="Give your thought a title..."
                    class="w-full text-3xl font-bold text-slate-900 placeholder:text-slate-200 outline-none border-none focus:ring-0"
                />
            </div>

            <div class="mb-8">
                <textarea
                    name="body"
                    rows="8"
                    placeholder="Start writing your raw ideas here. Don't worry about the mess—ZapNote will distill the clarity for you."
                    class="w-full text-lg text-slate-600 placeholder:text-slate-300 outline-none border-none focus:ring-0 resize-none"
                ></textarea>
            </div>

            <div class="flex flex-wrap gap-3 mb-10">
                <div class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-sm font-medium hover:bg-slate-200 cursor-pointer transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Add Tags
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-sm font-medium hover:bg-slate-200 cursor-pointer transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Set Reminder
                </div>
            </div>
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

            <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                <button type="button" class="text-slate-400 font-bold hover:text-slate-600 transition">
                    Discard
                </button>

                <div class="flex gap-4">
                    <button type="button" class="px-6 py-3 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-50 transition">
                        Save Draft
                    </button>
                    <button type="submit" class="group relative px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold overflow-hidden transition-all hover:pr-12">
                        <span class="relative z-10">Zap & Save</span>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all">
                            <svg class="w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php partial('footer')?>