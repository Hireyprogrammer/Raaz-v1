<!DOCTYPE html>
<html dir="<?= $locale === 'ar' ? 'rtl' : 'ltr' ?>" lang="<?= esc($locale) ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secure Admin Login">
    <meta name="author" content="DaleelCom">
    
    <title><?= esc($title ?? 'Welcome Home...') ?></title>
    <link rel="icon" href="<?= base_url('public/assets/images/core/favicon.png') ?>" type="image/png" sizes="16x16">
    <link rel="canonical" href="https://daleelcom.net/" />

    <!-- Common CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.min.css') ?>">

    <!-- Locale-specific CSS -->
    <?php if ($locale === 'ar'): ?>
        <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.rtl.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('public/assets/css/font-arabic.css') ?>">
    <?php endif; ?>
</head>

<body dir="<?= $locale === 'ar' ? 'rtl' : 'ltr' ?>">
    <div class="main-wrapper mt-0">
        <div class="auth-wrapper d-flex justify-content-center align-items-center"
             style="background: url('<?= base_url('public/assets/images/core/backgroud_2.jpg') ?>') no-repeat left bottom; background-size: cover;">

            <div class="auth-box p-4 bg-white rounded shadow">
                <!-- Login Form -->
                <div id="loginfrm">
                    <div class="logo text-center">
                        <img src="<?= base_url('public/assets/images/core/logo2.jpg') ?>" alt="logo" height="130">
                        <h2 class="box-title mb-3"><b><?= lang('Site.login.title') ?></b></h2>
                    </div>

                    <div class="text-center mb-2">
                        <span id="err" class="text-danger fw-bold d-none"></span>
                    </div>

                    <div class="row px-4">
                        <div class="col-12">
                            <form id="login_form" class="form-horizontal mt-3" method="POST" action="<?= base_url("$locale/admin/login") ?>">
                                <?php if (session()->has('expired')): ?>
                                    <h3 class="text-danger"><?= esc(session('expired')) ?></h3>
                                <?php endif; ?>

                                <div class="form-group mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="<?= lang('Site.login.username') ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" name="password" id="pwd" class="form-control" placeholder="<?= lang('Site.login.password') ?>" required>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase"><?= lang('Site.login.btn') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reset Modal (optional, still inactive) -->
                <div id="reset_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?= lang('Site.message') ?></h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <h6 class="mb-3 text-center text-secondary"><?= lang('Site.message') ?></h6>
                                <form id="reset">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control text-dark border-dark" placeholder="<?= lang('Site.message') ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-primary btn-block"><b><?= lang('Site.message') ?></b></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Modal -->

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        $(document).ready(function () {
            const baseUrl = "<?= base_url($locale . '/admin') ?>";

            $('#login_form').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST', 
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    success(response) {
                        console.log('Response:', response);
                        if (response.success === 1) {
                            form[0].reset();
                            window.location.href = baseUrl;
                        } else {
                            $('#pwd').focus();
                            $('#err').text(response.message).fadeIn().removeClass('d-none');
                            setTimeout(() => $('#err').fadeOut(), 2500);
                        }
                    },
                    error(xhr, status, error) {
                        console.error('Error details:', xhr.responseText, status, error);
                        $('#err').text('Server error, please try again.').fadeIn().removeClass('d-none');
                        setTimeout(() => $('#err').fadeOut(), 2500);
                    }
                });
            });
        });
    </script>
</body>
</html>
