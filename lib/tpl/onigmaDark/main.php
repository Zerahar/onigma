<?php
/**
 * DokuWiki Starter Template
 *
 * @link     http://dokuwiki.org/template:starter
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
$sidebarElement = tpl_getConf('sidebarIsNav') ? 'nav' : 'aside';
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
    
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Lora&display=swap" rel="stylesheet"> 
</head>

<body>
<script>document.addEventListener("DOMContentLoaded", function () {

    //dropdown menus
    const a = document.querySelectorAll(".node")
    for (let i = 0; i < a.length; i++) {
        a[i].addEventListener("click", toggleMenu);
    }

    // Close the dropdown menu if the user clicks outside of it
    // and image
    window.onclick = function (event) {

        if (!event.target.matches('.node')) {
            var dropdowns = document.getElementsByClassName("show");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                dropdowns[i].classList.remove('show');
            }
        }
        if (!event.target.matches('img')) {
            var images = document.getElementsByClassName("imageshow");
            var i;
            for (i = 0; i < images.length; i++) {
                images[i].classList.remove('imageshow');
            }
        }
    }
    //add parents to images
    //image popups
    const b = document.querySelectorAll("img.mediacenter, img.media, img.mediaright, img.medialeft")
    for (let i = 0; i < b.length; i++) {
        // `element` is the element you want to wrap
        var parent = b[i].parentNode;
        var wrapper = document.createElement('div');
        wrapper.classList.add("image-shadow")

        var innerWrapper = document.createElement('div');
        innerWrapper.classList.add("image-container")

        // set the wrapper as child (instead of the element)
        parent.replaceChild(wrapper, b[i]);
        // set element as child of wrapper
        wrapper.appendChild(innerWrapper);
        innerWrapper.appendChild(b[i]);
        wrapper.addEventListener("click", toggleImage);
    }

});

function toggleMenu(e) {
    e.target.querySelector("ul").classList.toggle("show")
}

function toggleImage(e) {
    e.target.parentNode.parentNode.classList.toggle("imageshow")
}

</script>
    <div id="dokuwiki__top" class="site <?php echo tpl_classes(); ?> <?php
        echo ($showSidebar) ? 'hasSidebar' : ''; ?>">

<div class="sidebar" id="sidebar">
<!-- ********** ASIDE ********** -->
<nav class="sidebar-nav">
<h1><?php tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?></h1>

                    <?php tpl_includeFile('sidebarheader.html') ?>
                    <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                    <?php tpl_includeFile('sidebarfooter.html') ?>
 
</nav>

             <!-- PAGE ACTIONS -->
             <?php if ($showTools): ?>
                <nav class="pagetools" aria-labelledby="dokuwiki__pagetools_heading">
                    <h3 class="a11y" id="dokuwiki__pagetools_heading"><?php echo $lang['page_tools'] ?></h3>
                    <ul>
                        <?php if (file_exists(DOKU_INC . 'inc/Menu/PageMenu.php')) {
                            echo (new \dokuwiki\Menu\PageMenu())->getListItems('action ', false);
                        } else {
                            _tpl_pagetools();
                        } ?>
                    </ul>
                </nav>
            <?php endif; ?>
</div>

<div class="main-content">
    <div class="navbar-top">
              <!-- USER TOOLS -->
                    <nav class="top tools-container" aria-labelledby="dokuwiki__usertools_heading">
                        <ul>

                            <?php if (file_exists(DOKU_INC . 'inc/Menu/UserMenu.php')) {
                                /* the first parameter is for an additional class, the second for if SVGs should be added */
                                echo (new \dokuwiki\Menu\UserMenu())->getListItems('action ', false);
                            } else {
                                /* tool menu before Greebo */
                                _tpl_usertools();
                            } ?>
                        </ul>

                        <?php tpl_searchform() ?>
                    </nav>


                
</div>
<main class="text-container">
<?php html_msgarea() /* occasional error and info messages on top of the page */ ?>

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
</main>
<div class="footer">
    <!-- SITE TOOLS -->
    <nav class="tools-container bottom" aria-labelledby="dokuwiki__sitetools_heading">
                    <h3 class="a11y" id="dokuwiki__sitetools_heading"><?php echo $lang['site_tools'] ?></h3>
                    <ul>
                        <?php if (file_exists(DOKU_INC . 'inc/Menu/SiteMenu.php')) {
                            echo (new \dokuwiki\Menu\SiteMenu())->getListItems('action ', false);
                        } else {
                            _tpl_sitetools();
                        } ?>
                    </ul>
                </nav>
</div>

</div>

    </div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>