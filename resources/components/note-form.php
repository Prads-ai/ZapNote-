<form method="POST" class="p-4">
    <div class="max-w-2xl mx-auto px-4 pb-4 pt-28">
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

            <form action="#" method="POST" class="p-8">
                <div class="mb-8">
                    <input
                        type="text"
                        placeholder="Give your thought a title..."
                        class="p-4 w-full text-3xl font-bold text-slate-900 placeholder:text-slate-200 outline-none border-none focus:ring-0 py-2"
                        name="title"
                    />
                </div>

                <div class="mb-10">
                    <textarea
                        rows="10"
                        placeholder="Start writing your raw ideas here. Don't worry about the mess—ZapNote will distill the clarity for you."
                        class="p-4 w-full text-lg text-slate-600 placeholder:text-slate-300 outline-none border-none focus:ring-0 resize-none py-2"
                        name="body"
                    ></textarea>
                </div>

                <div class="flex flex-wrap gap-3 mb-10 p-4">
                    <div class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-sm font-medium hover:bg-slate-200 cursor-pointer transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Add Tags
                    </div>
                    <div class=" p-4 flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-sm font-medium hover:bg-slate-200 cursor-pointer transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Set Reminder
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-sm font-medium hover:bg-slate-200 cursor-pointer transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Upload File
                    </div>

                    <input type="file" class="hidden" />
                </div>

                <div class="flex items-center justify-between pt-8 pb-2 border-t border-slate-100">
                    <button type="button" class="text-slate-400 font-bold hover:text-slate-600 transition py-2">
                        Discard
                    </button>

                    <div class="flex gap-4">
                        <button type="button" class="px-6 py-3 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-50 transition">
                            Save Draft
                        </button>
                        <button type="submit" class=" p-4 group relative px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold overflow-hidden transition-all hover:pr-12">
                            <span class="p-4 relative z-10">Zap & Save</span>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all">
                                <svg class="w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class=" p-4 absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</form>