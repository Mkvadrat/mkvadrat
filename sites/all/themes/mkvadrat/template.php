<?php

/**
 * Add body classes if certain regions have content.
 */
function mkvadrat_preprocess_html(&$variables) {
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }

  if (!empty($variables['page']['triptych_first'])
    || !empty($variables['page']['triptych_middle'])
    || !empty($variables['page']['triptych_last'])) {
    $variables['classes_array'][] = 'triptych';
  }

  if (!empty($variables['page']['footer_firstcolumn'])
    || !empty($variables['page']['footer_secondcolumn'])
    || !empty($variables['page']['footer_thirdcolumn'])
    || !empty($variables['page']['footer_fourthcolumn'])) {
    $variables['classes_array'][] = 'footer-columns';
  }

  // Add conditional stylesheets for IE
  //drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  //drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function mkvadrat_process_html(&$variables) {
  // Hook into color.module.
//  if (module_exists('color')) {
//    _color_html_alter($variables);
//  }
}

/**
 * Override or insert variables into the page template.
 */
function mkvadrat_process_page(&$variables) {
  // Hook into color.module.
//  if (module_exists('color')) {
//    _color_page_alter($variables);
//  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function mkvadrat_preprocess_maintenance_page(&$variables) {
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'mkvadrat') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function mkvadrat_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function mkvadrat_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function mkvadrat_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }

    /**
     * Блоки на главной:
     *
     * block-block-1                       - Слайдер
     * block-block-2                       - Почему ? Нас выбирают
     * block-block-3                       - Потому-что мы знаем
     * block-block-4                       - Как мы работаем
     * block-block-5                       - От директора
     * block-webform-client-block-11       - Консультация
     * block-views-frontportfolio-block    - Портфолио
     * block-views-fronttestimonials-block - Отзывы
     */

    if (!empty($variables['block_html_id'])) {
        switch ($variables['block_html_id']) {
            case 'block-block-1':
                mkvadrat_replace_block_content($variables, 'slider.tpl.php');
                break;
            case 'block-block-2':
                mkvadrat_replace_block_content($variables, 'screen2.tpl.php');
                break;
            case 'block-block-3':
                mkvadrat_replace_block_content($variables, 'screen3.tpl.php');
                break;
            case 'block-block-4':
                mkvadrat_replace_block_content($variables, 'screen4.tpl.php');
                break;
            case 'block-block-5':
                mkvadrat_include_block_content($variables, 'screen5.tpl.php');
                break;
            case 'block-webform-client-block-11':
                mkvadrat_include_block_content($variables, 'consult.tpl.php');
                break;
            case 'block-views-frontportfolio-block':
                mkvadrat_include_block_content($variables, 'portfolio.tpl.php');
                break;
            case 'block-views-fronttestimonials-block':
                mkvadrat_include_block_content($variables, 'testimonials.tpl.php');
                break;
            case 'block-webform-client-block-12':
                mkvadrat_include_block_content($variables, 'call-back.tpl.php');
                break;

 case 'block-block-6':
    mkvadrat_include_block_content($variables, 'seo-top.tpl.php');
                break;

 case 'block-webform-client-block-13':
    mkvadrat_include_block_content($variables, 'audit.tpl.php');
                break;


 case 'block-block-7':
    mkvadrat_include_block_content($variables, '7-error.tpl.php');
                break;

case 'block-block-8':
    mkvadrat_include_block_content($variables, 'job-step.tpl.php');
                break;

case 'block-webform-client-block-14':
    mkvadrat_include_block_content($variables, 'consult-seo.tpl.php');
                break;


case 'block-webform-client-block-15';
mkvadrat_include_block_content($variables, 'zakaz-seo.tpl.php');
                break;

case 'block-block-10':
    mkvadrat_include_block_content($variables, 'slide-est.tpl.php');
                break;

 case 'block-webform-client-block-16':
                mkvadrat_include_block_content($variables, 'consult-expert.tpl.php');
                break;

case 'block-block-11':
    mkvadrat_include_block_content($variables, 'your_where.tpl.php');
                break;

 case 'block-webform-client-block-17':
                mkvadrat_include_block_content($variables, 'zapros-site.tpl.php');
                break;

case 'block-block-13':
    mkvadrat_include_block_content($variables, 'vopros-site.tpl.php');
                break;

 case 'block-webform-client-block-18':
                mkvadrat_include_block_content($variables, 'consultant.tpl.php');
                break;
        

case 'block-block-14':
                mkvadrat_include_block_content($variables, 'creat-slide.tpl.php');
                break;


 case 'block-webform-client-block-21':
                mkvadrat_include_block_content($variables, 'form-creat-bottom.tpl.php');
                break;


case 'block-webform-client-block-22':
    mkvadrat_include_block_content($variables, 'consult-creat-site.tpl.php');
                break;

case 'block-block-17':
    mkvadrat_include_block_content($variables, 'how-we-job.tpl.php');
                break;


}
    }
}

function mkvadrat_replace_block_content(&$variables, $file) {
    if (!file_exists(DRUPAL_ROOT . '/' . path_to_theme() . '/includes/'.$file)) return;
    $variables['block']->title = '';
    $variables['block']->subject = '';
    ob_start();
    include(DRUPAL_ROOT . '/' . path_to_theme() . '/includes/'.$file);
    $content = ob_get_clean();
    $variables['content'] = $content;
}

function mkvadrat_include_block_content(&$variables, $file) {
    if (!file_exists(DRUPAL_ROOT . '/' . path_to_theme() . '/includes/'.$file)) return;
    $text = $variables['content'];
    mkvadrat_replace_block_content($variables, $file);
    $variables['content'] = str_replace('<!--MKVADRAT_BLOCK_CONTENT-->', $text, $variables['content']);
}

/**
 * Implements theme_menu_tree().
 */
function mkvadrat_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function mkvadrat_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}

function mkvadrat_custom_main_menu() {
    $html='';

    $menu_titles = array(
        'site' => 'Создание сайтов',
        'seo' => 'Продвижение сайтов',
        'ads' => 'Cайты для агентств недвижимости',
        'portfolio' => 'Портфолио'
    );

    $menu_urls = array(
        'site' => 'site',
        'seo' => 'seo',
        'ads' => 'creat-site-estate',
        'portfolio' => 'portfolio'
    );

    $current_path = drupal_get_path_alias();

    foreach($menu_titles as $key=>$title) {
        $url = isset($menu_urls[$key]) ? url($menu_urls[$key]) : '#';
        if ($menu_urls[$key] == $current_path) $active = true;
        else $active = false;
        $html.='<li><a href="'.$url.'" class="menu-item-'.$key.($active ? ' active' : '').'"><span class="ico"></span>'.$title.'</a></li>';
    }

    return $html;
}

function mkvadrat_custom_left_menu() {
    $html='';

    $menu_titles = array(
        'about' => 'О нас',
        'work' => 'О работе',
        'testimonial' => 'Отзывы',
        'clients' => 'Клиенты',
        'contacts' => 'Контакты'
    );

    $menu_urls = array(
        'about' => 'about',
        'work' => 'job',
        'testimonial' => 'testimonials',
        'clients' => 'clients',
        'contacts' => 'contacts'
    );

    $current_path = drupal_get_path_alias();

    foreach($menu_titles as $key=>$title) {
        $url = isset($menu_urls[$key]) ? url($menu_urls[$key]) : '#';
        if ($menu_urls[$key] == $current_path) $active = true;
        else $active = false;
        $html.='<li><a href="'.$url.'" class="menu-item-'.$key.($active ? ' active' : '').'"><span class="ico"></span>'.$title.'</a></li>';
    }

    return $html;
}