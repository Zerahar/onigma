<?php
/**
 * DokuWiki Bushwick Template
 * Based on the starter template and a wordpress theme of the same name
 *
 * @link     http://dokuwiki.org/template:bushwick
 * @author   desbest <afaninthehouse@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <link rel='stylesheet' id='bushwick-lato-css'  href='https://fonts.googleapis.com/css?family=Lato%3A400%2C700%2C400italic%2C700italic%2C900&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
</head>

<body id="dokuwiki__top" class="site <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">

    <?php
    //get_template_part( 'sidebar', is_single() ? 'single' : 'index' );
    //get_sidebar();
    ?>

    <?php tpl_includeFile('header.html') ?>
     <?php /* how to insert logo instead (if no CSS image replacement technique is used):
        upload your logo into the data/media folder (root of the media manager) and replace 'logo.png' accordingly:
        tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','id="dokuwiki__top" accesskey="h" title="[H]"') */ ?>
    <div class="site-header"><header id="masthead" class="site-header " role="banner">
        <div class="site-branding">
            <h1 class="site-title"><?php tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?></h1>
            <?php if ($conf['tagline']): ?>
                <p class="site-description"><?php echo $conf['tagline'] ?></p>
            <?php endif ?>
            <ul class="a11y skip">
                <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a></li>
            </ul>
        </div>
    </header></div><!-- #masthead -->

    <div id="container">
    <div id="secondary" class="widget-area" role="complementary">
    <div class="widget-container" style="position: relative; height: 260.7px;">

    <aside id="search" class="widget" style="position: absolute; left: 0px; top: 0px;"><h1 class="widget-title">Search</h1> <!-- <ul>
    <li class="cat-item cat-item-1"><a href="http://localhost/wordpress/category/uncategorized/">Uncategorized</a></li>
    </ul> -->
    <?php tpl_searchform() ?>
    </aside>        

    <aside id="usertools" class="widget" style="position: absolute; left: 348px; /*! top: 97px; */">       <h1 class="widget-title">User Tools</h1>      <ul>
      <!-- USER TOOLS -->
        <?php if ($conf['useacl'] && $showTools): ?>
        <h3 class="a11y"><?php echo $lang['user_tools'] ?></h3>
            <?php
                if (!empty($_SERVER['REMOTE_USER'])) {
                    echo '<li class="user">';
                    tpl_userinfo(); /* 'Logged in as ...' */
                    echo '</li>';
                }
            ?>
            <?php /* the optional second parameter of tpl_action() switches between a link and a button,
                     e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
            ?>
            <?php tpl_toolsevent('usertools', array(
                'admin'     => tpl_action('admin', 1, 'li', 1),
                'userpage'  => _tpl_action('userpage', 1, 'li', 1),
                'profile'   => tpl_action('profile', 1, 'li', 1),
                'register'  => tpl_action('register', 1, 'li', 1),
                'login'     => tpl_action('login', 1, 'li', 1),
            )); ?>
        <?php endif ?>
    </ul>
    </aside>

    <aside>
      <!-- ********** ASIDE ********** -->
        <?php if ($showSidebar): ?>
            <div id="writtensidebar" class="widget">
                <?php tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                <?php tpl_includeFile('sidebarfooter.html') ?>
                <div class="clearer"></div>
            </div><!-- /aside -->
        <?php endif; ?>
    </aside>

    </div></div>    


    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

                <!-- // get_template_part( 'navigation' ); -->
                <nav id="site-navigation" class="navigation-main" role="navigation">
                <h1 class="menu-toggle genericon"></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
                <div class="menu-my-first-menu-container"><ul id="menu-my-first-menu" class="menu nav-menu">
                <!-- SITE TOOLS -->
                <h3 class="a11y"><?php echo $lang['site_tools'] ?></h3>
                <?php tpl_toolsevent('sitetools', array(
                    'recent'    => tpl_action('recent', 1, 'li', 1),
                    'media'     => tpl_action('media', 1, 'li', 1),
                    'index'     => tpl_action('index', 1, 'li', 1),
                )); ?>
                </ul></div>

                <?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                <a class="widget-handle genericon" href="#"></a>
                </nav><!-- #site-navigation -->     

                <!-- //get_template_part( 'content', 'single' ); -->

                <article class="post type-post status-publish format-standard hentry">
                <!-- <h1 class="entry-title">title</h1> -->

                <aside class="entry-summary">
                     <!-- BREADCRUMBS -->
                    <?php if($conf['breadcrumbs']){ ?>
                        <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                    <?php } ?>
                    <?php if($conf['youarehere']){ ?>
                        <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                    <?php } ?>
                </aside><!-- .entry-summary -->

                <aside class="entry-meta">
                    <span class="edit-link"></span>
                    <!-- PAGE ACTIONS -->
                    <?php if ($showTools): ?>
                    <h3 class="a11y"><?php echo $lang['page_tools'] ?></h3>
                    <?php tpl_toolsevent('pagetools', array(
                        'edit'      => tpl_action('edit', 1, 'span class=\'pagetoolitem\'', 1),
                        'discussion'=> _tpl_action('discussion', 1, 'span class=\'pagetoolitem\'', 1),
                        'revisions' => tpl_action('revisions', 1, 'span class=\'pagetoolitem\'', 1),
                        'backlink'  => tpl_action('backlink', 1, 'span class=\'pagetoolitem\'', 1),
                        'subscribe' => tpl_action('subscribe', 1, 'span class=\'pagetoolitem\'', 1),
                        'revert'    => tpl_action('revert', 1, 'span class=\'pagetoolitem\'', 1),
                        'top'       => tpl_action('top', 1, 'span class=\'pagetoolitem\'', 1),
                    )); ?>
                    <?php endif; ?>
                </aside>

                <div class="entry-content">

                        <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
                   
                        <!-- // the_content(); -->

                        <!-- ********** CONTENT ********** -->
                        <!-- <div id="dokuwiki__content"><div class="pad"> -->
                            <?php tpl_flush() /* flush the output buffer */ ?>
                            <?php tpl_includeFile('pageheader.html') ?>

                            <div class="page">
                                <!-- wikipage start -->
                                <?php tpl_content() /* the main content */ ?>
                                <!-- wikipage stop -->
                                <div class="clearer"></div>
                            </div>

                            <?php tpl_flush() ?>
                            <?php tpl_includeFile('pagefooter.html') ?>
                        <!-- </div></div> --><!-- /content -->

                         <?php
                        // wp_link_pages( array(
                        //     'before' => '<div class="page-links">' . __( 'Pages:', 'bushwick' ),
                        //     'after'  => '</div>',
                        // ) );
                    ?>
                </div><!-- .entry-content -->
                </article><!-- #post-## -->

                <!-- // If comments are open or we have at least one comment, load up the comment template. -->

        </main><!-- #main -->
    </div><!-- #primary -->
    </div><!-- #container -->


    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <?php //do_action( 'bushwick_credits' ); ?>
            <p><?php tpl_pageinfo() /* 'Last modified' etc */ ?></p>
            <p><a href="http://wordpress.org/" title="A Semantic Personal Publishing Platform" rel="generator">Powered by Dokuwiki</a>
            <a href="">Bushwick theme by James Dinsdale</a></p>
            <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
    <?php tpl_includeFile('footer.html') ?>
  
    <?php /* the "dokuwiki__top" id is needed somewhere at the top, because that's where the "back to top" button/link links to */ ?>
    <?php /* tpl_classes() provides useful CSS classes; if you choose not to use it, the 'dokuwiki' class at least
             should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>
    
   


    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <script defer type="text/javascript" src="<?php echo tpl_basedir();?>/mobileinputsize.js"></script>
    <script defer type="text/javascript" src="<?php echo tpl_basedir();?>/functions.js"></script>
    <script defer type="text/javascript" src="<?php echo tpl_basedir();?>/masonry3.3.8.min.js"></script>
    <!-- due to the way dokuwiki buffers output, this javascript has to
            be before the </body> tag and not in the <head> -->
</body>
</html>
