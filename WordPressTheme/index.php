<?php get_header(); ?>

    <main>
      <!-- mv -->
      <section class="mv">
        <div class="mv__inner">
          <div class="mv__header">
            <h2 class="mv__title">DIVING</h2>
            <p class="mv__subtitle">into the ocean</p>
          </div>
          <div class="swiper mv__swiper js-mv-swiper">
            <div class="swiper-wrapper mv__wrapper">
              <div class="swiper-slide mv__img">
                <picture>
                  <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-main-pc.webp"/>
                  <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-main.webp" alt="写真:透明度の高い海の中を海亀が泳いでいます。"/>
                </picture>
              </div>
              <div class="swiper-slide mv__img">
                <picture>
                  <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img-pc.webp"/>
                  <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img.webp" alt="写真:海亀と2人のダイビングをしている人たち。"/>
                </picture>
              </div>
              <div class="swiper-slide mv__img">
                <picture>
                  <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img-2-pc.webp"/>
                  <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img-2.webp" alt="写真:晴れた空と海に浮かぶ船たち。"/>
                </picture>
              </div>
              <div class="swiper-slide mv__img">
                <picture>
                  <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img-3-pc.webp"/>
                  <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/mv-img-3.webp" alt="写真:砂浜と澄んだ水色の海で遊ぶ人たち。"/>
                </picture>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- campaign -->
      <?php
        $args = array(
          'post_type' => 'campaign', // カスタム投稿タイプのスラッグ
          'posts_per_page' => -1,
        );
        $custom_query = new WP_Query($args);

        if ($custom_query->have_posts()) :
        ?>

        <section class="campaign top-campaign">
          <div class="campaign__inner">
            <div class="campaign__title heading">
              <p class="heading__engtitle">Campaign</p>
              <h2 class="heading__jatitle">キャンペーン</h2>
            </div>
            <div class="swiper campaign__cards js-campaign-cards">
              <ul class="swiper-wrapper campaign__cards-wrapper">

                <?php
                while ($custom_query->have_posts()) : $custom_query->the_post();
                ?>

                <li class="swiper-slide campaign__cards-info-card">
                  <div class="info-card">
                    <div class="info-card__img">

                    <?php
                        // アイキャッチ画像が設定されていればそのURLを使用
                        if (has_post_thumbnail()) {
                            $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                            $image_alt = esc_attr(get_the_title()); // 代替テキストとして投稿のタイトルを使用
                        } else {
                          // どちらもない場合はデフォルト画像のURLを指定
                            $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                            $image_alt = esc_attr('画像がありません。'); // 代替テキスト
                        }
                        // 画像タグの出力
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/>';
                    ?>

                    </div>
                    <div class="info-card__content">
                      <div class="info-card__wrapper">

                        <?php
                        // 現在の投稿に関連付けられているタームを取得
                        $terms = get_the_terms(get_the_ID(), 'campaign_category');
                        if (!empty($terms) && !is_wp_error($terms)) :
                          // ターム名を配列に追加
                          $term_names = array_map(function($term) {
                            return esc_html($term->name);
                          }, $terms);
                          // ターム名のリストをカンマ区切りで表示
                          $term_list = join(', ', $term_names);
                        ?>
                        <p class="info-card__category"><?php echo esc_html($term_list); ?></p>
                        <?php endif; ?>

                      </div>
                      <h3 class="info-card__title"><?php echo esc_html(get_the_title()); ?></h3>
                      <p class="info-card__lead">全部コミコミ(お一人様)</p>
                      <div class="info-card__layout">
                        <?php
                        $list_price = get_field('campaign-list-price');
                        $discount_price = get_field('campaign-discount-price');
                        ?>
                        <div class="info-card__before"><span><?php echo esc_html($list_price ? $list_price : '準備中'); ?></span></div>
                        <div class="info-card__after"><?php echo esc_html($discount_price ? $discount_price : '準備中'); ?></div>
                      </div>
                    </div>
                  </div>
                </li>

                <?php endwhile; ?>

              </ul>
            </div>
            <div class="campaign__wrap">
              <div class="swiper-button-prev campaign__prev"></div>
              <div class="swiper-button-next campaign__next"></div>
            </div>
            <div class="campaign__button">
              <a href="<?php echo esc_url(home_url('/campaign/')); ?>" class="button"><span>View more</span></a>
            </div>
          </div>
        </section>

        <?php else : ?>
          <section class="campaign top-campaign">
            <div class="campaign__inner">
              <div class="campaign__title heading">
                <p class="heading__engtitle">Campaign</p>
                <h2 class="heading__jatitle">キャンペーン</h2>
              </div>
              <div class="campaign__no-posts no-posts">
                <p class="no-posts__text">投稿がありません。</p>
              </div>
            </div>
          </section>
        <?php endif; wp_reset_postdata(); ?>

      <!-- about -->
      <section class="about top-about">
        <div class="about__inner">
          <div class="about__content">
            <div class="about__title heading">
              <p class="heading__engtitle">About us</p>
              <h2 class="heading__jatitle">私たちについて</h2>
            </div>
            <div class="about__image-design image-design">
              <div class="image-design__img">
                <div class="image-design__img-small">
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/about1.jpeg')); ?>" alt="<?php echo esc_attr('写真:屋根に乗っているシーサー。'); ?>"/>
                </div>
                <div class="image-design__img-large">
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/about2.jpeg')); ?>" alt="<?php echo esc_attr('写真:海の中を泳ぐ二匹の熱帯魚。'); ?>"/>
                </div>
              </div>
              <div class="image-design__body">
                <p class="image-design__title">Dive into <br/>the Ocean</p>
                <div class="image-design__box">
                  <p class="image-design__text">
                    ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。<br/>
                    ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキスト
                  </p>
                  <div class="image-design__button">
                    <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="button"><span>View more</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- information -->
      <section class="information top-information">
        <div class="information__inner inner">
          <div class="information__title heading">
            <p class="heading__engtitle">Information</p>
            <h2 class="heading__jatitle">ダイビング情報</h2>
          </div>
          <div class="information__course course">
            <div class="course__img">
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/information.jpeg')); ?>" alt="<?php echo esc_attr('写真:サンゴ礁に泳ぐ熱帯魚の群れ。'); ?>"/>
            </div>
            <div class="course__wrapper">
              <h3 class="course__title">ライセンス講習</h3>
              <p class="course__text">
                当店はダイビングライセンス（Cカード）世界最大の教育機関PADIの「正規店」として店舗登録されています。<br/>
                正規登録店として、安心安全に初めての方でも安心安全にライセンス取得をサポート致します。
              </p>
              <div class="course__button">
                <a href="<?php echo esc_url(home_url('/information/')); ?>" class="button"><span>View more</span></a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- blog -->
      <section class="blog top-blog">
        <div class="blog__inner">
          <div class="blog__title heading heading--blog">
            <p class="heading__engtitle heading__engtitle--blog">Blog</p>
            <h2 class="heading__jatitle heading__jatitle--blog">ブログ</h2>
          </div>

          <?php
          $args = array(
            'post_type' => 'post', // カスタム投稿タイプのスラッグ
            'posts_per_page' => 3,
          );
          $custom_query = new WP_Query($args);

          if ($custom_query->have_posts()) : ?>
            <ul class="blog__cards cards">
              <?php
              while ($custom_query->have_posts()) : $custom_query->the_post();
              ?>
                <li class="cards__item">
                  <a href="<?php echo esc_url(get_permalink()); ?>" class="card">
                    <div class="card__img">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()) . 'のアイキャッチ画像。'; ?>">
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg')); ?>" alt="画像がありません。">
                      <?php endif; ?>
                    </div>
                    <div class="card__content">
                      <time class="card__meta" datetime="<?php echo esc_attr(get_the_time('c')); ?>"><?php echo esc_html(get_the_time('Y.m.d')); ?></time>
                      <p class="card__title"><?php echo esc_html(get_the_title()); ?></p>
                      <p class="card__text">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 85, '')); ?>
                      </p>
                    </div>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
            <div class="blog__button">
              <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="button"><span>View more</span></a>
            </div>
          <?php else : ?>
            <div class="blog__no-posts no-posts">
              <p class="no-posts__text">投稿がありません。</p>
            </div>
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </section>

      <!-- voice -->
      <section class="voice top-voice">
        <div class="voice__inner inner">
          <div class="voice__title heading">
            <p class="heading__engtitle">Voice</p>
            <h2 class="heading__jatitle">お客様の声</h2>
          </div>

          <?php
          $args = array(
            'post_type' => 'voice', // カスタム投稿タイプのスラッグ
            'posts_per_page' => 2,
          );
          $custom_query = new WP_Query($args);

          if ($custom_query->have_posts()) : ?>
            <ul class="voice__testimonial-list testimonial-list">
              <?php
              while ($custom_query->have_posts()) : $custom_query->the_post();
              ?>

              <li class="testimonial-list__item testimonial-item">
                <div class="testimonial-item__box">
                  <div class="testimonial-item__layout">
                    <div class="testimonial-item__group">
                      <p class="testimonial-item__personal"><?php echo esc_html(get_field('voice-era')); ?></p>
                      <?php
                        // 現在の投稿に関連付けられているタームを取得
                        $terms = get_the_terms(get_the_ID(), 'voice_category');
                        if (!empty($terms) && !is_wp_error($terms)) :
                          // ターム名を配列に追加
                          $term_names = array_map(function($term) {
                            return esc_html($term->name);
                          }, $terms);
                          // ターム名のリストをカンマ区切りで表示
                          $term_list = join(', ', $term_names);
                      ?>
                      <p class="testimonial-item__category"><?php echo esc_html($term_list); ?></p>
                      <?php endif; ?>
                    </div>
                    <h3 class="testimonial-item__title">
                      <?php
                        $title = get_the_title();
                        echo esc_html(mb_substr($title, 0, 21));
                      ?>
                    </h3>
                  </div>
                  <div class="testimonial-item__img">
                    <?php
                      // アイキャッチ画像が設定されていればそのURLを使用
                      if (has_post_thumbnail()) {
                        $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                        $image_alt = esc_attr(get_the_title()); // 代替テキストとして投稿のタイトルを使用
                      } else {
                        // どちらもない場合はデフォルト画像のURLを指定
                        $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                        $image_alt = esc_attr('画像がありません。'); // 代替テキスト
                      }
                      // 画像タグの出力
                      echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/>';
                    ?>
                  </div>
                </div>
                <p class="testimonial-item__text">
                  <?php
                    $text = get_field('voice-text');
                    $trimmed_text = mb_substr($text, 0, 173);
                    echo nl2br(esc_html($trimmed_text));
                  ?>
                </p>
              </li>
              <?php endwhile; ?>
            </ul>
            <div class="voice__button">
              <a href="<?php echo esc_url(home_url('/voice/')); ?>" class="button"><span>View more</span></a>
            </div>
          <?php else : ?>
            <div class="voice__no-posts no-posts">
              <p class="no-posts__text">投稿がありません。</p>
            </div>
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </section>

      <!-- price -->
      <section class="price top-price">
        <div class="price__inner inner">
          <div class="price__title heading">
            <p class="heading__engtitle">Price</p>
            <h2 class="heading__jatitle">料金一覧</h2>
          </div>
          <div class="price__content">
            <div class="price__img-sp">
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/price.webp')); ?>" alt="<?php echo esc_attr('写真:海の中でたくさんの魚がサンゴのそばを泳いでいる。'); ?>"/>
            </div>
            <div class="price__items">
              <?php
              // 特定の固定ページの投稿ID
              $post_id = 42;

              // ダイビングセクションのデータを取得
              $license_section_title = SCF::get('license_section_title', $post_id);
              $license_course_items = SCF::get('course_items', $post_id);

              $experience_section_title = SCF::get('experience_section_title', $post_id);
              $experience_course_items = SCF::get('experience_diving', $post_id);

              $fun_section_title = SCF::get('fun_section_title', $post_id);
              $fun_course_items = SCF::get('fun_diving', $post_id);

              $special_section_title = SCF::get('special_section_title', $post_id);
              $special_course_items = SCF::get('special_diving', $post_id);

              // セクションを表示する関数
              function display_price_section($section_title, $course_items, $item_name_key, $type_detail_key, $item_cost_key) {
                if (!empty($section_title) && !empty($course_items)) {
                  $has_valid_items = false;
                  foreach ($course_items as $item) {
                    $dive_name = isset($item[$item_name_key]) ? $item[$item_name_key] : '';
                    $item_cost = isset($item[$item_cost_key]) ? $item[$item_cost_key] : '';
                    if (!empty($dive_name) || !empty($item_cost)) {
                      $has_valid_items = true;
                      break;
                    }
                  }

                  if ($has_valid_items) {
                    echo '<div class="price__item">';
                    echo '<h3 class="price__sub-title">' . esc_html($section_title) . '</h3>';
                    echo '<dl class="price__group">';

                    foreach ($course_items as $item) {
                      $dive_name = isset($item[$item_name_key]) ? esc_html($item[$item_name_key]) : '';
                      $dive_type_detail = isset($item[$type_detail_key]) ? esc_html($item[$type_detail_key]) : '';
                      $item_cost = isset($item[$item_cost_key]) ? esc_html($item[$item_cost_key]) : '';

                      // 名前またはコストのどちらかが空の場合に「準備中」を表示
                      $dive_name = !empty($dive_name) ? $dive_name : '準備中';
                      $item_cost = !empty($item_cost) ? $item_cost : '準備中';

                      echo '<div class="price__layout">';
                      echo '<dt class="price__menu">' . esc_html($dive_name) . esc_html($dive_type_detail) . '</dt>';
                      echo '<dd class="price__cost">' . esc_html($item_cost) . '</dd>';
                      echo '</div>';
                    }

                    echo '</dl>';
                    echo '</div>';
                  }
                }
              }

              // 各セクションの表示
              display_price_section($license_section_title, $license_course_items, 'license_item_name', 'license_type_detail', 'license_item_cost');
              display_price_section($experience_section_title, $experience_course_items, 'experience_item_name', 'experience_type_detail', 'experience_item_cost');
              display_price_section($fun_section_title, $fun_course_items, 'fun_item_name', 'fun_type_detail', 'fun_item_cost');
              display_price_section($special_section_title, $special_course_items, 'special_item_name', 'special_type_detail', 'special_item_cost');
              ?>
            </div>
            <div class="price__img-pc">
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/price-pc.webp')); ?>" alt="<?php echo esc_attr('写真:海の中でたくさんの魚がサンゴのそばを泳いでいる。'); ?>"/>
            </div>
          </div>
          <div class="price__button">
            <a href="<?php echo esc_url(home_url('/price/')); ?>" class="button"><span>View more</span></a>
          </div>
        </div>
      </section>



<?php get_footer(); ?>