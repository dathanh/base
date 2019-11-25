<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">
            <li <?= $this->request->getParam(['controller']) == 'AdminDashboard' ? 'class="active"' : '' ?> >
                <a href="<?= $this->Url->build(['controller' => 'AdminDashboard', 'action' => 'index']) ?>">
                    <i class="la la-columns"></i>
                    <span><?= __('Dashboard') ?></span></a>
            </li>
            <?php if (!empty($listMenu)) : ?>
                <?php foreach ($listMenu as $key => $menu) : ?>
                    <?php if (!empty($menu['controller'])) : ?>
                        <?php if (in_array($menu['controller'], $listMenuCanShow)) : ?>
                            <li>
                                <a href="#dropdown-<?= $key ?>" aria-expanded="<?= $this->request->getParam(['controller']) == $menu['controller'] ? 'true' : 'false' ?>" data-toggle="collapse">
                                    <i class="<?= $menu['icon'] ?>"></i><span><?= $menu['name'] ?></span>
                                </a>
                                <?php if (!empty($menu['subMenu'])) : ?>
                                    <ul id="dropdown-<?= $key ?>" class="collapse list-unstyled pt-0 <?= $this->request->getParam(['controller']) == $menu['controller'] ? 'show' : '' ?> ">
                                        <?php foreach ($menu['subMenu'] as $subMmenu) : ?>
                                            <li>
                                                <a
                                                <?= $this->request->getParam(['controller']) == $subMmenu['controller'] && $this->request->getParam(['action']) == $subMmenu['action'] ? 'class="active"' : '' ?>
                                                    href="<?= $this->Url->build(["controller" => $subMmenu['controller'], 'action' => $subMmenu['action']], true) ?>">
                                                        <?= $subMmenu['name'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li>
                            <span class="heading"><?= $menu['name'] ?></span>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </nav>
    <!-- End Side Navbar -->
</div>