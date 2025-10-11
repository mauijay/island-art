<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Settings' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <?php foreach ($breadcrumb as $name => $url): ?>
                <?php if (empty($url)): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($name) ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?= esc($url) ?>"><?= esc($name) ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-<?= $category_config['icon'] ?? 'cog' ?> mr-2"></i>
                <?= esc($title) ?>
            </h1>
            <p class="text-muted"><?= esc($category_config['description'] ?? '') ?></p>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-warning" onclick="resetSettings()">
                <i class="fas fa-undo"></i> Reset to Defaults
            </button>
            <a href="/admin/settings" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Settings
            </a>
        </div>
    </div>

    <!-- Settings Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-<?= $category_config['icon'] ?? 'cog' ?> mr-2"></i>
                        <?= esc($category_config['title']) ?>
                    </h6>
                </div>
                <div class="card-body">
                    <form id="settingsForm" method="POST">
                        <?= csrf_field() ?>

                        <?php foreach ($category_config['fields'] as $fieldKey => $fieldConfig): ?>
                            <div class="form-group mb-3">
                                <label for="<?= esc($fieldKey) ?>" class="form-label">
                                    <?= esc($fieldConfig['label']) ?>
                                    <?php if ($fieldConfig['required']): ?>
                                        <span class="text-danger">*</span>
                                    <?php endif; ?>
                                </label>

                                <?php
                                $currentValue = $current_settings[$fieldKey] ?? '';
                                $placeholder = $fieldConfig['placeholder'] ?? '';
                                ?>

                                <?php if ($fieldConfig['type'] === 'textarea'): ?>
                                    <textarea
                                        class="form-control"
                                        id="<?= esc($fieldKey) ?>"
                                        name="<?= esc($fieldKey) ?>"
                                        placeholder="<?= esc($placeholder) ?>"
                                        rows="3"
                                        <?= $fieldConfig['required'] ? 'required' : '' ?>
                                    ><?= esc($currentValue) ?></textarea>
                                <?php elseif ($fieldConfig['type'] === 'checkbox'): ?>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="<?= esc($fieldKey) ?>"
                                            name="<?= esc($fieldKey) ?>"
                                            value="1"
                                            <?= $currentValue ? 'checked' : '' ?>
                                        >
                                        <label class="form-check-label" for="<?= esc($fieldKey) ?>">
                                            <?= esc($fieldConfig['label']) ?>
                                        </label>
                                    </div>
                                <?php else: ?>
                                    <input
                                        type="<?= esc($fieldConfig['type']) ?>"
                                        class="form-control"
                                        id="<?= esc($fieldKey) ?>"
                                        name="<?= esc($fieldKey) ?>"
                                        value="<?= esc($currentValue) ?>"
                                        placeholder="<?= esc($placeholder) ?>"
                                        <?= $fieldConfig['required'] ? 'required' : '' ?>
                                    >
                                <?php endif; ?>

                                <div class="invalid-feedback" id="<?= esc($fieldKey) ?>-error"></div>
                            </div>
                        <?php endforeach; ?>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                            <button type="button" class="btn btn-secondary ml-2" onclick="window.location.reload()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle mr-2"></i>
                        Current Settings
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Setting</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($current_settings as $key => $value): ?>
                                    <tr>
                                        <td class="font-weight-bold"><?= esc($key) ?></td>
                                        <td>
                                            <?php if (is_bool($value)): ?>
                                                <span class="badge badge-<?= $value ? 'success' : 'secondary' ?>">
                                                    <?= $value ? 'Yes' : 'No' ?>
                                                </span>
                                            <?php elseif (empty($value)): ?>
                                                <span class="text-muted">Not set</span>
                                            <?php else: ?>
                                                <small><?= esc(strlen($value) > 30 ? substr($value, 0, 30) . '...' : $value) ?></small>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast for notifications -->
<div id="toast-container" class="position-fixed" style="top: 20px; right: 20px; z-index: 1050;"></div>

<script>
function showToast(message, type = 'success') {
    const toastHtml = `
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header bg-${type} text-white">
                <strong class="mr-auto">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${type === 'success' ? 'Success' : 'Error'}
                </strong>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">
                    <span>&times;</span>
                </button>
            </div>
            <div class="toast-body">${message}</div>
        </div>
    `;

    const container = document.getElementById('toast-container');
    container.insertAdjacentHTML('beforeend', toastHtml);

    // Auto-remove after delay
    setTimeout(() => {
        const toasts = container.querySelectorAll('.toast');
        if (toasts.length > 0) {
            toasts[0].remove();
        }
    }, 5000);
}

function clearErrors() {
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
}

function showFieldError(fieldName, message) {
    const field = document.getElementById(fieldName);
    const errorDiv = document.getElementById(fieldName + '-error');

    if (field && errorDiv) {
        field.classList.add('is-invalid');
        errorDiv.textContent = message;
    }
}

document.getElementById('settingsForm').addEventListener('submit', function(e) {
    e.preventDefault();

    clearErrors();

    const formData = new FormData(this);
    const category = '<?= esc($category) ?>';

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    submitBtn.disabled = true;

    fetch(`/admin/settings/update/${category}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            if (data.redirect) {
                setTimeout(() => window.location.href = data.redirect, 1500);
            }
        } else {
            showToast(data.message, 'danger');

            // Show field-specific errors
            if (data.errors) {
                Object.keys(data.errors).forEach(fieldName => {
                    showFieldError(fieldName, data.errors[fieldName]);
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving settings', 'danger');
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

function resetSettings() {
    if (!confirm('This will reset all settings in this category to their default values. Are you sure?')) {
        return;
    }

    const category = '<?= esc($category) ?>';

    fetch(`/admin/settings/reset/${category}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while resetting settings', 'danger');
    });
}
</script>
<?= $this->endSection() ?>
