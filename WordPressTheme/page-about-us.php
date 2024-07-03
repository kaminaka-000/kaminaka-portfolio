<?php get_header(); ?>


  <main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">About us</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract2.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/abstract22.jpeg" alt="写真:鮮やかな色彩が調和する抽象画。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>


      <!-- sub-about -->
      <section class="sub-about sub-about-spacing sub-layout sub-layout--about">
        <div class="sub-about__inner inner">
            <div class="sub-about__img">
              <div class="sub-about__img-small">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about-20.jpeg" alt="写真:美術館の展示室で、様々な絵画が壁に掛けられている。"/>
              </div>
              <div class="sub-about__img-large">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about22.jpeg" alt="写真:美術館の内部、モダンなデザインの曲線を描く白い通路と照明パネルが設置された天井。"/>
              </div>
            </div>
            <div class="sub-about__body">
              <p class="sub-about__title">Discover <br/>Art Today</p>
              <div class="sub-about__box">
                <p class="sub-about__text">
                  ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。<br>
                  ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。
                </p>
              </div>
            </div>
        </div>
      </section>

      <!--  gallery -->
      <?php
        // 'gallery-picture' というリピーターフィールドからデータを取得
        $gallery_images = SCF::get('gallery-picture');

        // 有効な画像が存在するかチェックするフラグ
        $has_valid_image = false;

        // 画像の存在をチェック
        if (!empty($gallery_images)) {
            foreach ($gallery_images as $item) {
                $image_id = isset($item['picture']) ? $item['picture'] : null;
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                if ($image_url) {
                    $has_valid_image = true;
                    break;
                }
            }
        }

      // 有効な画像が存在する場合のみセクションを表示
      if ($has_valid_image) {
      ?>
      <section class="gallery sub-gallery-spacing">
          <div class="gallery__inner inner">
              <div class="gallery__title heading">
                  <p class="heading__engtitle heading__engtitle--sub">Gallery</p>
                  <h2 class="heading__jatitle">フォト</h2>
              </div>

              <ul class="gallery__list gallery-list">
                  <?php
                  // 各エントリに対してループ処理
                  foreach ($gallery_images as $index => $item) {
                      // 'picture' キーから画像のIDを取得
                      $image_id = isset($item['picture']) ? $item['picture'] : null;

                      // 画像IDから代替テキストを取得
                      $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                      $alt_text = !empty($alt_text) ? $alt_text : 'ギャラリーの画像'; // 代替テキストが空の場合のデフォルト値

                      // 画像IDから画像のURLを取得
                      $image_url = wp_get_attachment_image_url($image_id, 'full');

                      // 画像が存在する場合、画像とモーダルのマークアップを出力
                      if ($image_url) {
                          $modal_id = 'modal-' . $index;  // モーダルのIDを生成
                          ?>
                          <li class="gallery-list__item gallery-item js-modal-open" data-target="<?php echo esc_attr($modal_id); ?>">
                              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($alt_text); ?>" />
                              <div class="gallery-item__modal js-modal" id="<?php echo esc_attr($modal_id); ?>">
                                  <div class="gallery-item__content js-modal-close">
                                      <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($alt_text); ?>" />
                                  </div>
                              </div>
                          </li>
                          <?php
                      }
                  }
                  ?>
              </ul>
          </div>
      </section>
      <?php
      }
      ?>


<?php get_footer(); ?>