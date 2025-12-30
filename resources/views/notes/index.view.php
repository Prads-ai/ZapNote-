<?php partial('head');?>
<?php partial('nav');?>
<div class="pt-28 pb-12 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Success Message -->
        <?php if(!empty($success)): ?>
            <div class="mb-6 max-w-2xl mx-auto">
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                    <p class="text-sm text-green-700"><?php echo htmlspecialchars($success); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if(!empty($errors) && is_array($errors) && count($errors) > 0): ?>
            <div class="mb-6 max-w-2xl mx-auto">
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-red-800 mb-2">Error:</h3>
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

        <!-- Search Bar -->
        <div class="mb-8 max-w-2xl mx-auto">
            <form method="GET" action="/notes" class="relative">
                <input
                    type="text"
                    name="search"
                    value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>"
                    placeholder="Search your notes..."
                    class="w-full px-6 py-4 pl-14 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none shadow-sm"
                />
                <div class="absolute left-5 top-1/2 -translate-y-1/2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <?php if(!empty($searchQuery)): ?>
                    <a href="/notes" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Notes Grid -->
        <?php if(!empty($searchQuery)): ?>
            <div class="mb-4 text-center">
                <p class="text-sm text-slate-500">
                    Found <?php echo count($notes ?? []); ?> note(s) for "<?php echo htmlspecialchars($searchQuery); ?>"
                </p>
            </div>
        <?php endif; ?>

        <div class="flex flex-wrap gap-6 justify-center">
            <?php if(isset($notes)):?>
                <?php foreach($notes as $note): ?>
                    <a href="/notes/show?id=<?=$note['id']?>">
                        <div class="group">
                            <?php component('note-card', ['note' => $note]) ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<a href="/notes/create" class="fixed bottom-8 right-8 px-6 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl shadow-indigo-100 hover:bg-slate-800 transition-all hover:scale-105 flex items-center gap-3 z-50">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    <span>Add a new note</span>
</a>