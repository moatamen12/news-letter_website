    <!-- Validation errors -->
    <?php if (!empty($contactErrors)): ?>
    <div class="alert alert-danger">
        <h5>Please fix the following errors:</h5>
        <ul>
            <?php foreach($contactErrors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>