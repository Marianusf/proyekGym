<!-- <?php

        use App\Controllers\AdminController;
        use App\Controllers\MemberController;
        use App\Controllers\PemilikController;
        use CodeIgniter\Router\RouteCollection;

        /**
         * @var RouteCollection $routes
         */

        // Route untuk halaman utama (menuInformasi)
        $routes->get('/', 'LoginController::awalan');
        $routes->post('/loginCek', 'LoginController::login');



        $routes->get('/login', 'LoginController::index');
        $routes->post('/login', 'LoginController::index');

        $routes->get('/logout', 'LoginController::awalan'); //logout

        // R/ Route untuk admin
        $routes->group('admin', function ($routes) {
                $routes->add('dashboard', [AdminController::class, 'dashboard']);
        });

        // Route untuk pemilik
        $routes->group('pemilik', function ($routes) {
                $routes->add('dashboard', [PemilikController::class, 'dashboard']);
        });

        // Route untuk member
        $routes->group('member', function ($routes) {
                $routes->add('dashboard', [MemberController::class, 'dashboard']);
        });

        $routes->get('/pemilik/lihathasil', 'PaymentController::lihathasil'); //lihathasilmember

        $routes->get('/lihatpresensi', 'PresensiController::lihatpresensi');
        $routes->get('/profiladmin', 'AdminController::profiladmin');
        $routes->get('/dashboardadmin', 'AdminController::dashboard');



        $routes->get('/profile/editmember/(:num)', 'MemberController::editMember/$1');
        $routes->post('/profile/editmember/(:num)', 'MemberController::editMember/$1');


        //routes untuk member
        $routes->get('/profile', 'MemberController::profilmember');
        $routes->get('/dashboardmember', 'MemberController::dashboard');
        $routes->get('/dashboardmember', 'MemberController::dashboard');
        $routes->get('/register', 'MemberController::register');
        $routes->post('/registermember', 'MemberController::register');
        $routes->get('/registrasiview', 'MemberController::registrasiview');


        // Routes file
        $routes->get('/membershippesan', 'PaymentController::pilihpaket');
        $routes->post('/membership/order', 'PaymentController::processOrder');
        $routes->get('/payment/confirm', 'PaymentController::confirmPayment');
        $routes->post('/payment/validate', 'PaymentController::validatePayment');


        $routes->group('admin', function ($routes) {
                $routes->get('orders/pending', 'PaymentController::pendingOrders');
                $routes->get('admin/orders/pending', 'PaymentController::pendingOrders');
        });


        $routes->get('/pemiliklaporan', 'PaymentController::laporanbulanan');

        $routes->get('lihatmember', 'MemberController::listMembers');

        $routes->get('/admin/deleteMember/(:num)', 'MemberController::deleteMember/$1');
        $routes->get('admin/catatpresensi/(:num)/(:num)', 'PresensiController::catatpresensi/$1/$2');
        $routes->get('presensi/hapus/(:num)', 'PresensiController::hapuspresensi/$1');
