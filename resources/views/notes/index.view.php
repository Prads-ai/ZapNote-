<?php partial('head');?>
<?php partial('nav');?>
<div class="pt-28 pb-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap gap-6 justify-center">
            <?php if(isset($notes)):?>
                <?php foreach($notes as $note): ?>
                    <div class="group">
                        <?php component('note-card', ['note' => $note]) ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>