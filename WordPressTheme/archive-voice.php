<?php get_header(); ?>

    <main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Voice</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract5.jpeg')); ?>"/>
              <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract55.jpeg')); ?>" alt="写真:鮮やかな色彩とエネルギッシュな筆致で構成された抽象画。"/>
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>


    <!-- sub-voice -->
    <?php if (have_posts()) : // 記事があれば表示 ?>
      <section class="sub-voice sub-voice-spacing sub-layout">
        <div class="sub-voice__inner inner">
          <div class="sub-voice__wrapper">
            <div class="sub-voice__tab tab">
              <a href="<?php echo esc_url(get_post_type_archive_link('voice')); ?>" class="tab__menu is-active">ALL</a>
              <?php $genre_terms = get_terms('voice_category', array('hide_empty' => false)); ?>
              <?php foreach ($genre_terms as $genre_term) : ?>
                <a href="<?php echo esc_url(get_term_link($genre_term, 'voice_category')); ?>" class="tab__menu"><?php echo esc_html($genre_term->name); ?></a>
              <?php endforeach; ?>
            </div>

            <ul class="sub-voice__testimonial-list testimonial-list">
              <?php while (have_posts()) : the_post(); ?>
                <li class="testimonial-list__item testimonial-item">
                  <div class="testimonial-item__box">
                    <div class="testimonial-item__layout">
                      <div class="testimonial-item__group">
                        <!-- user_attributesフィールドグループから年代と性別のカスタムフィールドを取得して表示 -->
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
                              return $term->name;
                            }, $terms);
                            // ターム名のリストをカンマ区切りで表示
                            $term_list = join(', ', $term_names);
                        ?>
                          <p class="testimonial-item__category"><?php echo esc_html($term_list); ?></p>
                        <?php endif; ?>
                      </div>
                      <h2 class="testimonial-item__title">
                        <?php
                        $title = get_the_title();
                        echo esc_html($title);
                        ?>
                      </h2>
                    </div>
                    <div class="testimonial-item__img">
                      <?php
                      // アイキャッチ画像が設定されていればそのURLを使用
                      if (has_post_thumbnail()) {
                          $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                          $image_alt = esc_attr(get_the_title() . 'のアイキャッチ画像。'); // 代替テキストとして投稿のタイトルを使用し、その後に「のアイキャッチ画像」を追加
                      } else {
                          // アイキャッチ画像が設定されていない場合はデフォルト画像のURLを指定
                          $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                          $image_alt = esc_attr('画像がありません。'); // 代替テキスト
                      }
                      // 画像タグの出力
                      echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/>';
                      ?>
                    </div>
                  </div>
                  <?php
                    $text = get_field('voice-text');
                  ?>
                  <p class="testimonial-item__text">
                  <?php echo nl2br(esc_html($text ? $text : 'テキスト準備中')); ?>
                  </p>
                </li>
              <?php endwhile; ?>
            </ul>

            <!-- ページネーション -->
            <div class="pagenavi sub-pagenavi-spacing">
              <?php wp_pagenavi(); ?>
            </div>

          </div>
        </div>
      </section>
      <?php else : ?>
        <div class="testimonial-list__content">
          <p class="testimonial-list__text">投稿がありません。</p>
        </div>
      <?php endif; ?>




    <?php get_footer(); ?>