<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="<?php echo plugins_url('/src/assets/bootstrap/dist/css/bootstrap.min.css', __FILE__); ?>">
  <link rel="stylesheet" href="<?php echo plugins_url('/src/css/style.css', __FILE__); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 px-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>">All
                    projects</a></li>
              </ul>
            </li>
          </ul>
          <form role="search" class="d-flex search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input class="form-control me-2" type="search" name="s"
              placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
              value="<?php echo get_search_query(); ?>" aria-label="Search">
            <input type="hidden" name="post_type" value="portfolio">
            <button class="btn btn-outline-success me-2"
              type="submit"><?php echo _x('Search', 'submit button'); ?></button>
            <?php if (!empty(get_search_query())): ?>
              <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="btn btn-outline-secondary"
                role="button" style="align-content: center;">Reset</a>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </nav>
  </header>