<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) { echo ' : '; } ?><?php bloginfo( 'name' ); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta name="description" content="<?php bloginfo( 'description' ); ?>">

        <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700" rel="stylesheet">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
        <!-- header -->
        <header class="header" id="navbar-collapse-toggle">

            <!-- nav -->
            <?php portfolio_nav(); ?>
            <!-- /nav -->

            <!-- Mobile nav -->
            <nav role="navigation" class="d-block d-lg-none">
                <div id="menuToggle">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <?php portfolio_nav(true); ?>
                </div>
            </nav>
            <!-- /Mobile nav -->
        </header>
        <!-- /header -->
