<?php

/*================================================================
    テーマのスクリプトとスタイルシートを読み込む
================================================================ */
function my_theme_enqueue_scripts() {
  // Preconnect for Google Fonts
  wp_enqueue_style('google-fonts-preconnect', 'https://fonts.googleapis.com', array(), null);
  wp_enqueue_style('google-fonts-preconnect-gstatic', 'https://fonts.gstatic.com', array(), null, true);

  // Google Fonts
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Gotu&family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;500;700&display=swap', array(), null);

  // New Google Font: Lora
  wp_enqueue_style('google-fonts-lora', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap', array(), null);

  // Animate.css
  wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), null);

  // Swiper CSS
  wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);

  // Custom Stylesheet
  wp_enqueue_style('my-custom-styles', get_theme_file_uri('/assets/css/style.css'), array(), null);

  // jQuery - WordPress includes jQuery, but if you need a specific version or CDN:
  wp_enqueue_script('jquery-cdn', 'https://code.jquery.com/jquery-3.6.0.js', array(), null, true);

  // Swiper JS
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery-cdn'), null, true);

  // WOW.js
  wp_enqueue_script('wow-js', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array('jquery-cdn'), null, true);

  // Custom Scripts
  wp_enqueue_script('my-custom-script', get_theme_file_uri('/assets/js/script.js'), array('jquery-cdn'), null, true);

  // jQuery inview Plugin
  wp_enqueue_script('jquery-inview', get_theme_file_uri('/assets/js/jquery.inview.min.js'), array('jquery-cdn'), null, true);

  // WOW.js初期化スクリプトをインラインで追加
  wp_add_inline_script('wow-js', 'new WOW().init();');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

// セットアップ
function my_setup() {
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'my_setup' );


/*================================================================
    アーカイブの表示件数変更
================================================================ */
function change_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() )
      return;

   // カスタム投稿タイプ 'campaign' のアーカイブで表示される投稿数を指定
  if ( $query->is_archive('campaign') ) { //カスタム投稿タイプを指定
      $query->set( 'posts_per_page', '4' ); //表示件数を指定
  }

  // カスタム投稿タイプ 'voice' のアーカイブで表示される投稿数を指定
  if ( $query->is_post_type_archive('voice') ) {
    $query->set( 'posts_per_page', '6' ); // 例として6に設定
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );

//date.phpの表示件数変更
function change_date_archive_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() )
      return;

  if ( $query->is_date() ) { // 日付アーカイブページを指定
      $query->set( 'posts_per_page', '10' ); // 表示件数を10件に設定
  }
}
add_action( 'pre_get_posts', 'change_date_archive_posts_per_page' );



/*================================================================
    投稿を人気順に表示する
================================================================ */
function set_post_view($post_id) {
  $count_key = 'post_views_count';
  $count = get_post_meta($post_id, $count_key, true);
  if ($count == '') {
      $count = 1;
      add_post_meta($post_id, $count_key, $count);
  } else {
      $count++;
      update_post_meta($post_id, $count_key, $count);
  }
}

/*================================================================
    投稿のみにカスタムフィールドを表示
================================================================ */
function my_custom_field_visibility($state) {
  if (get_post_type() == 'post') {
      return false;  // ACF によるカスタムフィールドメタボックスの削除を無効化
  }
  return $state;  // それ以外の場合は元の状態を保持
}
add_filter('acf/settings/remove_wp_meta_box', 'my_custom_field_visibility');


/*================================================================
    コンタクトフォームにカスタム投稿のタイトルを反映させる
================================================================ */
function filter_wpcf7_form_tag( $scanned_tag ) {
  if ( 'your-campaign' === $scanned_tag['name'] ) {
    $args = array(
      'post_type'      => 'campaign',
      'posts_per_page' => -1,
      'orderby'        => 'date',
      'order'          => 'DESC',
    );
    $posts_query = new WP_Query( $args );
    if ( $posts_query->have_posts() ) {
      $scanned_tag['raw_values'] = array(); // 初期化
      while ( $posts_query->have_posts() ) {
        $posts_query->the_post();
        $scanned_tag['values'][] = get_the_title();
        $scanned_tag['labels'][] = get_the_title();
        $scanned_tag['raw_values'][] = get_the_title();
      }
      wp_reset_postdata();
    }
  }
  return $scanned_tag;
}
add_filter( 'wpcf7_form_tag', 'filter_wpcf7_form_tag', 10, 1 );


//<p>タグを生成しない
add_filter('wpcf7_autop_or_not', '__return_false');


//サンクスページへのリダイレクト
add_action('wp_footer', 'redirect_to_thanks_page');
function redirect_to_thanks_page() {
  if (is_page('contact')) {
    $homeUrl = esc_url(home_url());
    echo <<<EOD
    <script>
      document.addEventListener('wpcf7mailsent', function(event) {
        location = '{$homeUrl}/contact-thanks/';
      }, false);
    </script>
EOD;
  }
}


/*================================================================
    カスタム投稿タイプのデフォルトカテゴリー設定
================================================================ */

// 'campaign' のデフォルトカテゴリーを設定
function set_default_category_for_custom_post($post_id, $post, $update) {
  // 投稿がカスタム投稿タイプ 'campaign' かどうかを確認します
  if (get_post_type($post_id) == 'campaign') {
      // 投稿に 'campaign_category' タクソノミーのカテゴリが付いているかどうかを確認します
      $categories = wp_get_post_terms($post_id, 'campaign_category');

      // カテゴリが空の場合、デフォルトカテゴリーを設定します
      if (empty($categories)) {
          // デフォルトカテゴリーIDを設定します。実際のデフォルトカテゴリーIDに置き換えてください。
          $default_category_id = 6; // 例として1を使用しています。デフォルトカテゴリーIDに置き換えてください。

          // カテゴリーを設定します
          wp_set_post_terms($post_id, array($default_category_id), 'campaign_category');
      }
  }
}
add_action('save_post', 'set_default_category_for_custom_post', 10, 3);

// 'voice' のデフォルトカテゴリーを設定
function set_default_category_for_voice_post($post_id, $post, $update) {
  // 投稿がカスタム投稿タイプ 'voice' かどうかを確認します
  if (get_post_type($post_id) == 'voice') {
      // 投稿に 'voice_category' タクソノミーのカテゴリが付いているかどうかを確認します
      $categories = wp_get_post_terms($post_id, 'voice_category');

      // カテゴリが空の場合、デフォルトカテゴリーを設定します
      if (empty($categories)) {
          // デフォルトカテゴリーIDを設定します。実際のデフォルトカテゴリーIDに置き換えてください。
          $default_category_id = 13; // 例として1を使用しています。デフォルトカテゴリーIDに置き換えてください。

          // カテゴリーを設定します
          wp_set_post_terms($post_id, array($default_category_id), 'voice_category');
      }
  }
}
add_action('save_post', 'set_default_category_for_voice_post', 10, 3);


/*================================================================
    管理画面の投稿一覧にアイキャッチ画像を表示
================================================================ */
// アイキャッチ画像をサポート
function my_theme_setup() {
  add_theme_support('post-thumbnails'); // すべての投稿とページにアイキャッチ画像を追加
  add_post_type_support('post', 'thumbnail'); // 標準投稿タイプにアイキャッチ画像のサポートを追加
}
add_action('after_setup_theme', 'my_theme_setup');

// 投稿リストにアイキャッチ画像のカラムを追加
function add_thumbnail_column($columns) {
  $columns['thumbnail'] = 'Featured Image';
  return $columns;
}
add_filter('manage_post_posts_columns', 'add_thumbnail_column');

// アイキャッチ画像をカラムに表示
function display_thumbnail_column($column, $post_id) {
  if ($column == 'thumbnail') {
      $post_thumbnail_id = get_post_thumbnail_id($post_id);
      if ($post_thumbnail_id) {
          $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
          echo '<img src="' . esc_url($post_thumbnail_img[0]) . '" width="150" height="120" style="object-fit: cover;"/>';
      } else {
          echo '—';
      }
  }
}
add_action('manage_post_posts_custom_column', 'display_thumbnail_column', 10, 2);

// カスタム投稿タイプ 'campaign' にアイキャッチ画像のカラムを追加
add_filter('manage_campaign_posts_columns', 'add_thumbnail_column');
add_action('manage_campaign_posts_custom_column', 'display_thumbnail_column', 10, 2);

// カスタム投稿タイプ 'voice' にアイキャッチ画像のカラムを追加
add_filter('manage_voice_posts_columns', 'add_thumbnail_column');
add_action('manage_voice_posts_custom_column', 'display_thumbnail_column', 10, 2);


/*================================================================
    ダッシュボードにウィジェットを追加する
================================================================ */
// 投稿と編集ページに移動できるウィジェットを表示する関数
function add_custom_widget() {
  $html = ''; // 変数を初期化
  $html .= '<div class="admin_panel">';
  $html .= '<p>クリックすると投稿と編集ページに移動します</p>';
  $html .= '<div class="widget-icons">';
  $html .= '<a href="edit.php"><div class="widget-icon"><span class="dashicons dashicons-admin-post"></span><p>『ブログ』投稿</p></div></a>';
  $html .= '<a href="edit.php?post_type=campaign"><div class="widget-icon"><span class="dashicons dashicons-clock"></span><p>『作品紹介』投稿</p></div></a>';
  $html .= '<a href="edit.php?post_type=voice"><div class="widget-icon"><span class="dashicons dashicons-smiley"></span><p>『お客様の声』投稿</p></div></a>';
  $html .= '<a href="post.php?post=37&action=edit"><div class="widget-icon"><span class="dashicons dashicons-format-gallery"></span><p>『ギャラリー画像』編集</p></div></a>';
  $html .= '<a href="post.php?post=42&action=edit"><div class="widget-icon"><span class="dashicons dashicons-money-alt"></span><p>『料金一覧』編集</p></div></a>';
  $html .= '<a href="post.php?post=44&action=edit"><div class="widget-icon"><span class="dashicons dashicons-editor-help"></span><p>『よくある質問』編集</p></div></a>';
  $html .= '</div>'; // divタグを閉じる
  $html .= '</div>'; // divタグを閉じる
  echo $html;
}

// 基本設定リンクを表示するウィジェットを追加する関数
function add_basic_settings_widget() {
  $html = ''; // 変数を初期化
  $html .= '<div class="admin_panel basic_settings_widget">';
  $html .= '<p>クリックすると設定ページに移動します</p>';
  $html .= '<ul class="widget-links">';
  $html .= '<li><a href="post.php?post=10&action=edit"><div class="widget-icon"><span class="dashicons dashicons-admin-generic"></span><p>【トップページのメインスライダー画像】設定へ</p></div></a></li>';
  $html .= '<li><a href="post.php?post=33&action=edit"><div class="widget-icon"><span class="dashicons dashicons-admin-generic"></span><p>【プライバシーポリシー】設定へ</p></div></a></li>';
  $html .= '<li><a href="post.php?post=293&action=edit"><div class="widget-icon"><span class="dashicons dashicons-admin-generic"></span><p>【利用規約】設定へ</p></div></a></li>';
  $html .= '</ul>'; // ulタグを閉じる
  $html .= '</div>'; // divタグを閉じる
  echo $html;
}

// 自作した情報をダッシュボードのウィジェットに登録する関数
function add_my_widget() {
wp_add_dashboard_widget('custom_widget', '投稿と編集', 'add_custom_widget');
wp_add_dashboard_widget('basic_settings_widget', 'サイト設定', 'add_basic_settings_widget');
}

// ダッシュボードのウィジェット設定読み込み時に②の処理を呼び出す
add_action('wp_dashboard_setup', 'add_my_widget');

// カスタムスタイルを追加する関数
function custom_dashboard_styles() {
  wp_enqueue_style('custom_dashboard_css', get_template_directory_uri() . '/custom-dashboard.css');
}

add_action('admin_enqueue_scripts', 'custom_dashboard_styles');

/*================================================================
    管理画面にカスタムCSSを読み込む
================================================================ */
function load_custom_wp_admin_style() {
  wp_enqueue_style('custom_wp_admin_css', get_template_directory_uri() . '/assets/css/admin-styles.css', false, '1.0.0');
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

// 管理画面のメニューをカスタマイズ
function change_post_menu_label() {
  global $menu;
  global $submenu;
  $menu[5][0] = 'ブログ'; // メニューの名前を変更
  $submenu['edit.php'][5][0] = 'ブログ'; // 投稿一覧の名前を変更
  $submenu['edit.php'][10][0] = '新規ブログ追加'; // 新規追加の名前を変更
  // 他のサブメニューを必要に応じて変更
}
add_action('admin_menu', 'change_post_menu_label');

// コメントメニューを非表示にする
function remove_comments_menu() {
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comments_menu');

// 管理画面のメニューの並び順をカスタマイズ
function customize_menu_order($menu_order) {
  if (!$menu_order) return true;

  return array(
      'index.php', // ダッシュボード
      'edit.php', // ブログ（投稿）
      'edit.php?post_type=campaign', // キャンペーン
      'edit.php?post_type=voice', // お客様の声
      'upload.php', // メディア
      'edit.php?post_type=page', // 固定ページ
      // 'edit-comments.php', // コメント (この行をコメントアウトまたは削除)
      'wpcf7', // お問い合わせ（Contact Form 7 の例）
      'themes.php', // 外観
      'plugins.php', // プラグイン
      'users.php', // ユーザー
      'tools.php', // ツール
      'options-general.php', // 設定
      'ai1wm_export', // All-in-One WP Migration
      'edit.php?post_type=scf', // Smart Custom Fields（カスタムフィールドの例）
      'edit.php?post_type=acf', // ACF
      'admin.php?page=seo-pack', // SEO PACK
      'admin.php?page=cptui_main_menu', // CPT UI
  );
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'customize_menu_order');



/*================================================================
    管理画面のログイン画面のロゴを変更
================================================================ */
// ログイン画面のロゴ変更
function login_logo() {
  $logo_url = get_template_directory_uri() . '/assets/images/common/art-logo2.png';
  echo '<style type="text/css">
      .login h1 a {
          background-image: url("' . esc_url($logo_url) . '");
          width: 300px;
          background-size: contain;
          background-position: center;
          background-repeat: no-repeat;
          display: block;
      }
  </style>';
}
add_action('login_head', 'login_logo');

// ログイン画面のロゴURL
function custom_login_logo_url() {
  return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// ログイン画面のロゴタイトル
function custom_login_logo_url_title() {
  return 'トップページを表示';
}
add_filter('login_headertitle', 'custom_login_logo_url_title');


/*================================================================
    不要なエディタ部分を非表示
================================================================ */
function hide_specific_page_editors() {
  global $post;
  if (isset($post) && $post->post_type == 'page' && !in_array($post->post_name, ['terms-of-service', 'privacypolicy'])) {
      echo '
      <style>
      #postdivrich, .block-editor-block-list__layout {
          display: none;
      }
      </style>
      ';
  }
}
add_action('admin_head', 'hide_specific_page_editors');

function hide_custom_post_type_editors() {
  global $post;
  if (isset($post) && in_array($post->post_type, ['campaign', 'voice'])) {
      echo '
      <style>
      #postdivrich, .block-editor-block-list__layout {
          display: none;
      }
      </style>
      ';
  }
}
add_action('admin_head', 'hide_custom_post_type_editors');


function change_title_placeholder_text( $title ){
  $screen = get_current_screen();

  if ( 'campaign' == $screen->post_type ) {
      $title = '作品名をこちらに入力してください'; // プレースホルダーテキストをここで設定
  }

  return $title;
}
add_filter( 'enter_title_here', 'change_title_placeholder_text' );

/*================================================================
    作品紹介のnl2brで拾った<br>タグを<span>タグに変更し、cssを当てている
================================================================ */
function add_custom_js_to_footer() {
  ?>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const brElements = document.querySelectorAll('.info-card__after br');

      brElements.forEach(br => {
          // Create a new span element to replace the <br> tag
          const span = document.createElement('span');
          span.style.display = 'block';
          span.style.paddingTop = '3px';

          // Get the next sibling text node and move its content into the span
          const nextSibling = br.nextSibling;

          if (nextSibling && nextSibling.nodeType === 3) { // 3 is a text node
              span.textContent = nextSibling.textContent;
              nextSibling.textContent = ''; // Clear the original text node
          }

          // Replace the <br> tag with the new span element
          br.replaceWith(span);
      });
  });
  </script>
  <?php
}
add_action('wp_footer', 'add_custom_js_to_footer');

/*================================================================
    料金の部分の改行をナビ部分に表示させない
================================================================ */
function get_scf_section_titles($post_id) {
  $license_section_title = SCF::get('license_section_title', $post_id);

  // 改行で分割して最初の部分だけを取得
  $experience_section_title = SCF::get('experience_section_title', $post_id);
  $experience_section_title = explode("\n", str_replace("\r", "\n", $experience_section_title))[0];

  $fun_section_title = SCF::get('fun_section_title', $post_id);

  $special_section_title = SCF::get('special_section_title', $post_id);
  $special_section_title = explode("\n", str_replace("\r", "\n", $special_section_title))[0];


  return array(
      'sub-price-license' => $license_section_title,
      'sub-price-experience' => $experience_section_title,
      'sub-price-fan' => $fun_section_title,
      'sub-price-special' => $special_section_title
  );
}

/*================================================================
    固定ページでSEO SIMPLE PACKのディスクリプションメタタグを除去する
================================================================ */
function remove_duplicate_meta_description() {
  ob_start(function ($buffer) {
      // 重複するメタディスクリプションタグを削除
      $buffer = preg_replace('/<meta name="description" content=".*?">/', '', $buffer, 1);
      return $buffer;
  });
}
add_action('wp_head', 'remove_duplicate_meta_description', 1);


