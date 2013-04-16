Kansas State University Drupal Theme
-------------------------------------
Based on a Zen child theme for Drupal 6.x. Originally created by Cole Cooper 
for the Department of Computing and Informaiton Sciences to match KSU branding.
The theme was originally created in 2011.

Original Author: Cole Cooper (colecoop@ksu.edu)
Last Modified By: Cole Cooper (colecoop@ksu.edu)
Last Modified Date: 4/16/2013

Installation
-------------------------------------
This theme is a Zen child theme, which requires than Zen be installed for it to
work. You may find the installation directions for Zen in the Zen theme 
documentation.

Zen Project: http://drupal.org/project/zen

To install this theme, simply copy the ksu2011/ folder into your Drupal site's
themes folder (/sites/all/themes/). Then go to /admin/build/themes on your site
and enable the Kansas State University Theme.

Configuration
-------------------------------------
To configure your theme, go to /admin/build/themes/settings/ksu2011

To configure Nice Menus, you must go to /admin/build/themes/settings and set
"Path to Custom Nice menus CSS file" to:
"sites/all/themes/ksu2011/css/nice_menus_default.css"

To configure Superfish Menus, you must go to /admin/build/block/list, find the 
block that has your menu, and ensure that the "Style" option is set to "None". 
Otherwise, Superfish's default stylesheet will override those in this theme.

To change what appears in the search box, edit js/header.js and change what the 
string value is inserted into the search box.

To change the footer image, simply replace images/footer.png with your own unit's
preferred image, also named footer.png. It must be 960px wide, and the height 
doesn't matter. 



Original Zen README.txt follows
-------------------------------------

BUILD YOUR OWN SUB-THEME
------------------------

*** IMPORTANT ***

* In Drupal 6, the theme system caches template files and which theme functions
  should be called. What that means is if you add a new theme or preprocess
  function to your template.php file or add a new template (.tpl.php) file to
  your sub-theme, you will need to rebuild the "theme registry." See
  http://drupal.org/node/173880#theme-registry

* Drupal 6 also stores a cache of the data in .info files. If you modify any
  lines in your sub-theme's .info file, you MUST refresh Drupal 6's cache by
  simply visiting the admin/build/themes page.


The base Zen theme is designed to be easily extended by its sub-themes. You
shouldn't modify any of the CSS or PHP files in the zen/ folder; but instead you
should create a sub-theme of zen which is located in a folder outside of the
root zen/ folder. The examples below assume zen and your sub-theme will be
installed in sites/all/themes/, but any valid theme directory is acceptable
(read the sites/default/default.settings.php for more info.)

  Why? To learn why you shouldn't modify any of the files in the zen/ folder,
  see http://drupal.org/node/245802

 1. Copy the STARTERKIT folder out of the zen/ folder and rename it to be your
    new sub-theme. IMPORTANT: Only lowercase letters and underscores should be
    used for the name of your sub-theme.

    For example, copy the sites/all/themes/zen/STARTERKIT folder and rename it
    as sites/all/themes/foo.

      Why? Each theme should reside in its own folder. To make it easier to
      upgrade Zen, sub-themes should reside in a folder separate from their base
      theme.

 2. In your new sub-theme folder, rename the STARTERKIT.info.txt file to include
    the name of your new sub-theme and remove the ".txt" extension. Then edit
    the .info file by editing the name and description field.

    For example, rename the foo/STARTERKIT.info file to foo/foo.info. Edit the
    foo.info file and change "name = Zen Sub-theme Starter Kit" to "name = Foo"
    and "description = Read..." to "description = A Zen sub-theme".

      Why? The .info file describes the basic things about your theme: its
      name, description, features, template regions, CSS files, and JavaScript
      files. See the Drupal 6 Theme Guide for more info:
      http://drupal.org/node/171205

    Then, visit your site's admin/build/themes to refresh Drupal 6's cache of
    .info file data.

 3. By default your new sub-theme is using a fixed-width layout. If you want a
    liquid layout for your theme, delete the unneeded layout-fixed.css and
    layout-fixed-rtl.css files and edit your sub-theme's .info file and replace
    the reference to layout-fixed.css with layout-liquid.css.

    For example, edit foo/foo.info and change this line:
      stylesheets[all][]   = css/layout-fixed.css
    to:
      stylesheets[all][]   = css/layout-liquid.css

      Why? The "stylesheets" lines in your .info file describe the media type
      and path to the CSS file you want to include. The format for these lines
      is:  stylesheets[MEDIA][] = path/to/file.css

    Then, visit your site's admin/build/themes to refresh Drupal 6's cache of
    .info file data.

    Alternatively, if you are more familiar with a different CSS layout method,
    such as Blueprint or 960.gs, you can replace the "css/layout-fixed.css" line
    in your .info file with a line pointing at your choice of layout CSS file.

 4. Edit the template.php and theme-settings.php files in your sub-theme's
    folder; replace ALL occurrences of "STARTERKIT" with the name of your
    sub-theme.

    For example, edit foo/template.php and foo/theme-settings.php and replace
    every occurrence of "STARTERKIT" with "foo".

    It is recommended to use a text editing application with search and
    "replace all" functionality.

 5. Log in as an administrator on your Drupal site and go to Administer > Site
    building > Themes (admin/build/themes) and enable your new sub-theme.


Optional:

 6. MODIFYING ZEN CORE TEMPLATE FILES:
    If you decide you want to modify any of the .tpl.php template files in the
    zen folder, copy them to your sub-theme's folder before making any changes.
    And then rebuild the theme registry.

    For example, copy zen/templates/page.tpl.php to foo/templates/page.tpl.php.

 7. THEMEING DRUPAL'S SEARCH FORM:
    Copy the search-theme-form.tpl.php template file from the modules/search/
    folder and place it in your sub-theme's folder. And then rebuild the theme
    registry.

    You can find a full list of Drupal templates that you can override in the
    templates/README.txt file or http://drupal.org/node/190815

      Why? In Drupal 6 theming, if you want to modify a template included by a
      module, you should copy the template file from the module's directory to
      your sub-theme's directory and then rebuild the theme registry. See the
      Drupal 6 Theme Guide for more info: http://drupal.org/node/173880

 8. FURTHER EXTENSIONS OF YOUR SUB-THEME:
    Discover further ways to extend your sub-theme by reading Zen's
    documentation online at:
      http://drupal.org/node/193318
    and Drupal 6's Theme Guide online at:
      http://drupal.org/theme-guide
