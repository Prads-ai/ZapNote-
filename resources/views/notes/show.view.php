<?php partial('head');?>
<?php partial('nav');?>
<div class="pt-28 pb-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap gap-6 justify-center">
            <?php if(isset($note)):?>
                    <a href="/notes/show?id=<?=$note['id']?>">
                        <div class="group">
                            <?php component('note-card', ['note' => $note]) ?>
                        </div>
                    </a>
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