<!DOCTYPE html>
<html lang="<?= esc($locale) ?>" dir="<?= $locale === 'ar' ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Welcome Home...') ?></title>

    <link rel="icon" href="<?= base_url('public/assets/images/core/favicon.png') ?>" type="image/png">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php if ($locale === 'ar'): ?>
        <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.rtl.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('public/assets/css/font-arabic.css') ?>">
    <?php endif; ?>

    <style>
        .auth-wrapper { min-height: 100vh; }
        .auth-box { max-width: 400px; width: 100%; }
        .auth-box .logo img { max-height: 80px; object-fit: contain; }
        .btn-login {
            background-color: #1a2537;
            color: #fff;
            border: none;
            transition: 0.3s ease;
        }
        .btn-login:hover {
            background-color: #3e97ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: #3e97ff;
            box-shadow: 0 0 0 0.25rem rgba(62, 151, 255, 0.25);
        }
        .input-group-text {
            background: transparent;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
<div class="main-wrapper mt-0">
    <div class="auth-wrapper d-flex justify-content-center align-items-center" 
         style="background: url('<?= base_url('public/assets/images/core/backgroud_2.jpg') ?>') center center / cover no-repeat;">

        <div class="auth-box p-4 bg-white rounded shadow">
            <div id="loginfrm">
                <div class="logo text-center mb-4">
                    <img src="<?= base_url('public/assets/images/core/logo2.jpg') ?>" alt="Logo" class="mb-2">
                    <h3 class="fw-bold text-dark"><?= lang('Site.login.title') ?></h3>
                </div>

                <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                    <span id="err-message"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>

                <form id="login_form" method="POST" action="<?= base_url("$locale/admin/login") ?>">
                    <?php if (session()->has('expired')): ?>
                        <div class="alert alert-danger"><?= esc(session('expired')) ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="<?= lang('Site.login.username') ?>" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Site.login.password') ?>" required>
                            <span class="input-group-text toggle-password" title="Show/Hide"><i class="fas fa-eye-slash"></i></span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-login btn-lg fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i><?= lang('Site.login.btn') ?>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reset Modal (optional) -->
            <div id="reset_modal" class="modal fade" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="resetModalLabel"><?= lang('Site.message') ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-secondary">
                            <p><?= lang('Site.message') ?></p>
                            <form id="reset_form">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="<?= lang('Site.message') ?>" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i><?= lang('Site.message') ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Reset Modal -->
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>

<script>
$(function() {
    const baseUrl = "<?= base_url("$locale/admin") ?>";

    // Toggle password visibility
    $('.toggle-password').on('click', function() {
        const passwordField = $('#password');
        const icon = $(this).find('i');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    // Handle login form
    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');

        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...');
        $('#error-alert').addClass('d-none');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(res) {
                if (res.success) {
                    window.location.href = baseUrl;
                } else {
                    showError(res.message);
                }
            },
            error: function() {
                showError('Server error. Please try again later.');
            },
            complete: function() {
                submitBtn.prop('disabled', false).html('<i class="fas fa-sign-in-alt me-2"></i><?= lang('Site.login.btn') ?>');
            }
        });

        function showError(message) {
            $('#err-message').text(message);
            $('#error-alert').removeClass('d-none');
            $('#password').val('').focus();
        }
    });

    // Handle reset password (future)
    $('#reset_form').on('submit', function(e) {
        e.preventDefault();
        alert('Password reset functionality coming soon!');
    });
});
</script>
</body>
</html>
