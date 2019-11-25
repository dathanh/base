<header class="header">
    <nav class="navbar fixed-top">         
        <!-- Begin Topbar -->
        <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
            <!-- Begin Logo -->
            <div class="navbar-header">
                <a href="<?= $this->Url->build(['controller' => 'AdminDashboard', 'action' => 'index']) ?>" class="navbar-brand">
                    <div class="brand-image brand-big">
                        <img src="/backend/assets/img/logo.gif.png" alt="logo" class="logo-big">
                    </div>
                    <div class="brand-image brand-small">
                        <img src="/backend/assets/img/logo.gif.png" alt="logo" class="logo-small">
                    </div>
                </a>
                <!-- Toggle Button -->
                <a id="toggle-btn" href="#" class="menu-btn active">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <!-- End Toggle -->
            </div>
            <!-- End Logo -->
            <!-- Begin Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                <!-- User -->
                <li class="nav-item dropdown">
                    <a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                        <i class="la la-user text-gradient-01"></i>
                    </a>
                    <ul aria-labelledby="user" class="user-size dropdown-menu">
                        <li>
                            <?= $this->Html->link(__('Profile'), ['controller' => 'AdminUsers', 'action' => 'view', $this->request->getSession()->read('Auth.Backend.User.id')], ['class' => 'btn btn-default btn-flat']) ?>
                        </li>
                        <li>
                            <a class="btn btn-default btn-flat" href="<?= $this->Url->build(['controller' => 'AdminUsers', 'action' => 'logout']); ?>"><?php echo __('Logout'); ?></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <span>
                        <?php $name = $this->request->getSession()->read('Auth.Backend.User.firstname') . ' ' . $this->request->getSession()->read('Auth.Backend.User.lastname'); ?>
                        <?php $name = ($name == ' ' ? $this->request->getSession()->read('Auth.Backend.User.email') : $name); ?>
                        <?= $name; ?>
                    </span>
                </li>
                <!-- End User -->
            </ul>
            <!-- End Navbar Menu -->
        </div>
        <!-- End Topbar -->
    </nav>
</header>