<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<?php if (isset($this->blocks['main-content'])): ?>
    <div id="main-content">
        <?= $this->blocks['main-content'] ?>
    </div>
<?php endif; ?>

<?php if (isset($this->blocks['secondary-one'])): ?>
    <div id="secondary-one">
        <?= $this->blocks['secondary-one'] ?>
    </div>
<?php endif; ?>

<?php $this->endContent(); ?>