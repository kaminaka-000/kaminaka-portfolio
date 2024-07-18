<?php get_header(); ?>

    <main>
      <!-- mv -->
      <section class="mv">
        <div class="mv__inner">
          <div class="mv__header">
            <h2 class="mv__title">Art Museum</h2>
            <p class="mv__subtitle">meets imagination</p>
          </div>
          <div class="swiper mv__swiper js-mv-swiper">
            <div class="swiper-wrapper mv__wrapper">
              <?php
              // Smart Custom Fieldsから画像を取得
              $top_imgs = SCF::get('top-img');
              $has_images = false; // 画像があるかどうかのフラグを初期化
              foreach ($top_imgs as $imgs) {
                // 繰り返しフィールド内の各画像をループして表示
                $pc_image_id = $imgs["top-img-pc"];
                $sp_image_id = $imgs["top-img-sp"];

                // PCサイズの画像URLとALT属性を取得
                $pc_image_url = $pc_image_id ? wp_get_attachment_image_url($pc_image_id, 'full') : '';
                $pc_image_alt = $pc_image_id ? get_post_meta($pc_image_id, '_wp_attachment_image_alt', true) : '';

                // SPサイズの画像URLとALT属性を取得
                $sp_image_url = $sp_image_id ? wp_get_attachment_image_url($sp_image_id, 'full') : '';
                $sp_image_alt = $sp_image_id ? get_post_meta($sp_image_id, '_wp_attachment_image_alt', true) : '';

                // ALT属性が両方ともある場合、PCサイズのALTを優先する
                $alt = !empty($pc_image_alt) ? $pc_image_alt : $sp_image_alt;

                // どちらかの画像が設定されている場合に表示
                if ($pc_image_url || $sp_image_url) {
                  $has_images = true; // 画像があることを示す
                  echo '<div class="swiper-slide mv__img">';
                  echo '<picture>';
                  // PC画像がない場合はSP画像をPCにも使う、SP画像がない場合はPC画像をSPにも使う
                  if ($pc_image_url && $sp_image_url) {
                    echo '<source media="(min-width: 768px)" srcset="' . esc_url($pc_image_url) . '"/>';
                    echo '<img src="' . esc_url($sp_image_url) . '" alt="' . esc_attr($alt) . '"/>';
                  } elseif ($pc_image_url) {
                    echo '<source media="(min-width: 768px)" srcset="' . esc_url($pc_image_url) . '"/>';
                    echo '<img src="' . esc_url($pc_image_url) . '" alt="' . esc_attr($alt) . '"/>';
                  } elseif ($sp_image_url) {
                    echo '<img src="' . esc_url($sp_image_url) . '" alt="' . esc_attr($alt) . '"/>';
                  }
                  echo '</picture>';
                  echo '</div>';
                }
              }

              // 画像がなかった場合のデフォルト画像表示
              if (!$has_images) {
                $default_pc_image_url = esc_url(get_theme_file_uri('/assets/images/common/lotus-pond.jpeg')); // デフォルトPC画像のパスを指定
                $default_sp_image_url = esc_url(get_theme_file_uri('/assets/images/common/lotus-pond-sp.jpeg')); // デフォルトSP画像のパスを指定
                echo '<div class="swiper-slide mv__img">';
                echo '<picture>';
                echo '<source media="(min-width: 768px)" srcset="' . $default_pc_image_url . '"/>';
                echo '<img src="' . $default_sp_image_url . '" alt="Default Image"/>';
                echo '</picture>';
                echo '</div>';
              }
              ?>
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
        ?>
        <section class="campaign top-campaign">
          <div class="campaign__inner">
            <div class="campaign__title heading">
              <p class="heading__engtitle wow animate__animated animate__fadeInUp">Art</p>
              <h2 class="heading__jatitle">作品紹介</h2>
            </div>
            <?php if ($custom_query->have_posts()) : ?>
              <div class="swiper campaign__cards js-campaign-cards">
                <ul class="swiper-wrapper campaign__cards-wrapper">
                  <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                  <li class="swiper-slide campaign__cards-info-card">
                    <a href="<?php echo esc_url(home_url('/campaign/')); ?>" class="info-card">
                      <div class="info-card__img">
                        <?php
                        if (has_post_thumbnail()) {
                            $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                            $image_alt = esc_attr(get_the_title() . 'のアイキャッチ画像。');
                        } else {
                            $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                            $image_alt = esc_attr('画像がありません。');
                        }
                        echo '<img src="' . $image_url . '" alt="' . $image_alt . '"/>';
                        ?>
                      </div>
                      <div class="info-card__content">
                        <div class="info-card__wrapper">
                          <?php
                          $terms = get_the_terms(get_the_ID(), 'campaign_category');
                          if (!empty($terms) && !is_wp_error($terms)) :
                            $term_names = array_map(function ($term) {
                                return esc_html($term->name);
                            }, $terms);
                            $term_list = join(', ', $term_names);
                          ?>
                          <p class="info-card__category"><?php echo $term_list; ?></p>
                          <?php endif; ?>
                        </div>
                        <h3 class="info-card__title"><?php echo esc_html(get_the_title()); ?></h3>
                        <p class="info-card__lead">期間限定展示</p>
                        <div class="info-card__layout">
                          <?php
                          $discount_price = get_field('campaign-discount-price');
                          ?>
                          <div class="info-card__before">
                            <span>作者</span>
                          </div>
                          <div class="info-card__after info-card__after--sub">
                            <span><?php echo nl2br(esc_html($discount_price ? $discount_price : '準備中')); ?></span>
                          </div>
                        </div>
                      </div>
                    </a>
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
            <?php else : ?>
              <div class="campaign__no-posts no-posts">
                <p class="no-posts__text">投稿がありません。</p>
              </div>
            <?php endif; wp_reset_postdata(); ?>
          </div>
        </section>


      <!-- about -->
      <section class="about top-about">
        <div class="about__inner">
          <div class="about__content">
            <div class="about__title heading">
              <p class="heading__engtitle wow animate__animated animate__fadeInUp">About us</p>
              <h2 class="heading__jatitle">当館について</h2>
            </div>
            <div class="about__image-design image-design">
              <div class="image-design__img">
                <div class="image-design__img-small">
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/about-20.jpeg')); ?>" alt="<?php echo esc_attr('写真:美術館の展示室で、様々な絵画が壁に掛けられている。'); ?>"/>
                </div>
                <div class="image-design__img-large">
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/about22.jpeg')); ?>" alt="<?php echo esc_attr('写真:美術館の内部、モダンなデザインの曲線を描く白い通路と照明パネルが設置された天井。'); ?>"/>
                </div>
              </div>
              <div class="image-design__body">
                <p class="image-design__title">Discover <br/>Art Today</p>
                <div class="image-design__box">
                  <p class="image-design__text">
                      蓮の池のほとりに位置する蓮池美術館では、静かな水面に映る美しい風景と共に、心に響くアート作品を鑑賞できます。<br>自然とアートの融合を感じながら、新しいインスピレーションを見つけてください。
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
            <p class="heading__engtitle wow animate__animated animate__fadeInUp">Information</p>
            <h2 class="heading__jatitle">展示情報</h2>
          </div>
          <div class="information__course course">
            <div class="course__img">
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/information-img.jpeg')); ?>" alt="<?php echo esc_attr('写真:薄暗いギャラリーに展示された数枚の絵画と資料。'); ?>"/>
            </div>
            <div class="course__wrapper">
              <h3 class="course__title">常設展示「アートの旅」</h3>
              <p class="course__text">
                  当館の常設展示「アートの旅」では、古代から現代までの多彩なアート作品を展示しています。<br/>
                  この展示では、絵画、彫刻、工芸品など、さまざまな時代やスタイルの芸術作品を鑑賞することができます。
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
            <p class="heading__engtitle heading__engtitle--blog wow animate__animated animate__fadeInUp">Blog</p>
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
            <p class="heading__engtitle wow animate__animated animate__fadeInUp">Voice</p>
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
              while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

              <li class="testimonial-list__item testimonial-item">
                <div class="testimonial-item__box">
                  <div class="testimonial-item__layout">
                    <div class="testimonial-item__group">
                      <?php
                      $user_attributes = get_field('user_attributes'); // user_attributesフィールドグループを取得
                      $age_group = $user_attributes['age_group']; // 年代のフィールドを取得
                      $gender = $user_attributes['gender']; // 性別のフィールドを取得
                      ?>
                      <p class="testimonial-item__personal">
                        <?php echo esc_html($age_group) . '（' . esc_html($gender) . '）'; ?>
                      </p>
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
                      echo esc_html($title);
                      ?>
                    </h3>
                  </div>
                  <div class="testimonial-item__img">
                    <?php
                    // アイキャッチ画像が設定されていればそのURLを使用
                    if (has_post_thumbnail()) {
                      $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                      $image_alt = esc_attr(get_the_title() . 'のアイキャッチ画像。'); // 代替テキストとして投稿のタイトルを使用し、その後に「のアイキャッチ画像」を追加
                    } else {
                      // どちらもない場合はデフォルト画像のURLを指定
                      $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                      $image_alt = esc_attr('画像がありません。'); // 代替テキスト
                    }
                    // 画像タグの出力
                    echo '<img src="' . $image_url . '" alt="' . $image_alt . '"/>';
                    ?>
                  </div>
                </div>
                <p class="testimonial-item__text">
                  <?php
                  $text = get_field('voice-text');
                  echo nl2br(esc_html($text));
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
                <p class="heading__engtitle wow animate__animated animate__fadeInUp">Price</p>
                <h2 class="heading__jatitle">料金一覧</h2>
            </div>
            <div class="price__content">
                <div class="price__img-sp">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/price-img2.jpeg')); ?>" alt="<?php echo esc_attr('写真:暗闇に浮かぶ色とりどりの三角形の光。'); ?>"/>
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
                                    $item_cost_display = !empty($item_cost) ? '￥' . number_format($item_cost) : '準備中';

                                    echo '<div class="price__layout">';
                                    echo '<dt class="price__menu">' . esc_html($dive_name) . esc_html($dive_type_detail) . '</dt>';
                                    echo '<dd class="price__cost">' . esc_html($item_cost_display) . '</dd>';
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
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/price-img1.jpeg')); ?>" alt="<?php echo esc_attr('写真:メガネをかけている老婦人の前に立ち止まるふたり。'); ?>"/>
                </div>
            </div>
            <div class="price__button">
                <a href="<?php echo esc_url(home_url('/price/')); ?>" class="button"><span>View more</span></a>
            </div>
        </div>
    </section>



<?php get_footer(); ?>