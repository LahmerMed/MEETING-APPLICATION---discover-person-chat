<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        <p><?= $_SESSION['success'] ?></p>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        <p><?= $_SESSION['error'] ?></p>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
