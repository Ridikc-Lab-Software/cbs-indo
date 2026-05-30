<?php
function login()
{
    global $url, $key;

    $request_id_penjualan_voucher = new RequestString("code");

    if (isset($_POST['aksi'])) {
        $aksi = $_POST['aksi'];
        if ($aksi == "login") {
            $code = isset($_POST['code']) ? $_POST['code'] : "";
            $password = isset($_POST['password']) ? $_POST['password'] : "";
            if ($code != "" || $password != "") {
                $code = decrypt($code);
                $cek = QB::table("data_penjualan_voucher")->where("id_penjualan", $code)->where("password_voucher", $password)->first();
                if ($cek) {
                    $kodene = encrypt($cek->id_penjualan);
                    setcookie(ConfigHome::$LOGIN_KEY_NAME, $kodene, time() + (6000 * 6000), '/');

                    $ip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $token = sha1($ip . $useragent . $key);
                    $token = crypt($token, $key);
                    setcookie(ConfigHome::$LOGIN_KEY_USER, $token, time() + (6000 * 6000), '/');

                    header("location: index.php?p=home");
?>
                    <script>
                        window.location.href = 'index.php?p=home';
                    </script>
            <?php
                    die('redirect login berhasil.');
                }
            }
        }
    }

    if ($request_id_penjualan_voucher->isValid()) {
        $id_penjualan = decrypt($request_id_penjualan_voucher->getValue());
        $penjualan_voucher = QB::table("data_penjualan_voucher")->where("id_penjualan", $id_penjualan)->first();
        if ($penjualan_voucher) {
            ?>
            <style>
                #kt_app_wrapper {
                    margin-top: 0px;
                }
            </style>
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <!--begin::Image-->
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="<?= $url ?>/media/auth/agency.png" alt="">
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="<?= $url ?>/media/auth/agency-dark.png" alt="">
                        <!--end::Image-->
                        <!--begin::Title-->
                        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">E-Voucher CBS-INDO</h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="text-gray-600 fs-base text-center fw-semibold">Selamat datang di aplikasi e-voucher CBS-INDO.
                            <br>Silakan login untuk mengakses E-voucher.
                            <!-- <br>Jika Anda belum memiliki akun, <a href="#" class="opacity-75-hover text-primary me-1">daftar di sini</a> untuk membuat akun baru. -->
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--begin::Aside-->
                <!--begin::Body-->
                <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                    <!--begin::Wrapper-->
                    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                        <!--begin::Content-->
                        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                                <!--begin::Form-->
                                <?php
                                $query_url = http_build_query($_GET);
                                ?>
                                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                                    id="kt_sign_in_form" data-kt-redirect-url="" action="index.php?<?= $query_url ?>" method="POST">
                                    <!--begin::Heading-->
                                    <div class="text-center mb-11">
                                        <!--begin::Title-->
                                        <h1 class="text-dark fw-bolder mb-3">Login</h1>
                                        <!--end::Title-->
                                        <!--begin::Subtitle-->
                                        <div class="text-gray-500 fw-semibold fs-6">Masukkan password dibawah ini </div>
                                        <!--end::Subtitle=-->
                                    </div>
                                    <!--begin::Heading-->
                                    <!--begin::Login options-->
                                    <?php /*
                                                 <div class="row g-3 mb-9">
                                                     <!--begin::Col-->
                                                     <div class="col-md-6">
                                                         <!--begin::Google link=-->
                                                         <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                             <img alt="Logo" src="<?= $url ?>/media/svg/brand-logos/google-icon.svg" class="h-15px me-3">Sign in with Google</a>
                                                         <!--end::Google link=-->
                                                     </div>
                                                     <!--end::Col-->
                                                     <!--begin::Col-->
                                                     <div class="col-md-6">
                                                         <!--begin::Google link=-->
                                                         <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                             <img alt="Logo" src="<?= $url ?>/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3">
                                                             <img alt="Logo" src="<?= $url ?>/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3">Sign in with Apple</a>
                                                         <!--end::Google link=-->
                                                     </div>
                                                     <!--end::Col-->
                                                 </div>
                                                 */ ?>
                                    <!--end::Login options-->
                                    <!--begin::Separator-->
                                    <?php /*
                                                 <div class="separator separator-content my-14">
                                                     <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                                 </div>
                                                 <!--end::Separator-->
                                                 */ ?>
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-8 fv-plugins-icon-container">
                                        <!--begin::Email-->
                                        <input type="text" placeholder="Code" name="code" autocomplete="off"
                                            class="form-control bg-transparent" readonly
                                            value="<?= $request_id_penjualan_voucher->getValue() ?>">
                                        <!--end::Email-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group=-->
                                    <div class="fv-row mb-3 fv-plugins-icon-container">
                                        <!--begin::Password-->
                                        <input type="password" placeholder="Password Voucher " name="password" autocomplete="off"
                                            class="form-control bg-transparent">
                                        <!--end::Password-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                        <?php /*
                                                     <div></div>
                                                     <!--begin::Link-->
                                                     <a href="../../demo1/dist/authentication/layouts/overlay/reset-password.html" class="link-primary">Forgot Password ?</a>
                                                     <!--end::Link-->
                                                 */ ?>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Submit button-->
                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary" name="aksi"
                                            value="login">
                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">Masuk</span>
                                            <!--end::Indicator label-->
                                            <!--begin::Indicator progress-->
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            <!--end::Indicator progress-->
                                        </button>
                                    </div>
                                    <!--end::Submit button-->
                                    <!--begin::Sign up-->
                                    <?php /*
                                                 <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                                     <a href="../../demo1/dist/authentication/layouts/overlay/sign-up.html" class="link-primary">Sign up</a>
                                                 </div>
                                                 */ ?>
                                    <!--end::Sign up-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Languages-->
                                <div class="me-10">
                                  
                                  
                                    <!--end::Menu-->
                                </div>
                                <!--end::Languages-->
                                <!--begin::Links-->
                                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                    <a href="#" target="_blank">CopyRight © 2026 - E-Voucher CBS-INDO</a>
                              
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
    <?php
            return;
        }
    }

     header("Location: admin/");
    die();

    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.4/lottie.min.js"></script>

    <div class="d-flex flex-column flex-center text-center">
        <div class="card card-flush w-lg-650px py-5">
            <div class="card-body py-15 py-lg-20">
                <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="fw-semibold fs-2x text-gray-500 mb-3">Maaf, Link voucher tidak valid.</div>
                <!--begin::Illustration-->
                <div class="mb-3">
                    <div id="error_image" class="mw-100 mh-300px " alt="" />
                    <!-- <div class="mw-100 mh-300px theme-dark-show" alt="" /> -->
                </div>
                <!--end::Illustration-->
                <!--begin::Link-->
                <!-- <div class="mb-0"> -->
                <!--     <a href="../../demo1/dist/index.html" class="btn btn-sm btn-primary">Return Home</a> -->
                <!-- </div> -->
                <!--end::Link-->
            </div>
        </div>
    </div>
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('error_image'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '<?= $url ?>/media/auth/404-error.json' // Local path to the Lottie JSON file
        });
    </script>
<?php
}
?>