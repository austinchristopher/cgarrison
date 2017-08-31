<header class="site-header__header" data-scroll-header>

  <!-- branding -->
  <div class="site-header__brand">
    <a href="/">Christopher<br><span class="bar-bg">Garrison</span></a>
  </div>

  <!-- desktop nav -->
  <nav class="site-header__main-nav">
    <?php wp_nav_menu(array('menu' => 'main')); ?>
  </nav>

  <!-- mobile nav -->
  <nav class="site-header__main-nav--mobile">
    <div class="main-nav__mobile-expander">
      <div class="mobile-expander__lines">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <?php wp_nav_menu(array('menu' => 'main')); ?>
  </nav>

</header>
