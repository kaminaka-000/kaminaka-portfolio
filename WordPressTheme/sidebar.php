    <aside class="sidebar">
        <?php if ( is_active_sidebar( 'sidebar' )) : ?>
            <?php dynamic_sidebar( 'sidebar' ); ?>
        <?php endif; ?>
        <ul class="sidebar__list">
            <li class="sidebar__item">
                <div class="sidebar__container">
                    <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/common/lotus4.svg" alt="" />
                    <h2 class="sidebar__sidebar-title">人気記事</h2>
                </div>
                <div class="sidebar__popular sidebar-popular">
                    <?php
                    $args = array(
                        'posts_per_page' => 3, // 表示する投稿数
                        'meta_key' => 'post_views_count', // カスタムフィールドのキー
                        'orderby' => 'meta_value_num', // メタ値として数値を指定
                        'order' => 'DESC', // 降順に並べ替え
                    );
                    $popular_posts = new WP_Query($args);

                    if ($popular_posts->have_posts()) :
                        while ($popular_posts->have_posts()) : $popular_posts->the_post();
                    ?>
                        <a href="<?php the_permalink(); ?>" class="sidebar-popular__item popular-item">
                            <div class="popular-item__box">
                                <time class="popular-item__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html(get_the_date('Y.m/d')); ?></time>
                                <p class="popular-item__title"><?php echo esc_html(get_the_title()); ?></p>
                            </div>
                            <div class="popular-item__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>のアイキャッチ画像。">
                                <?php else: ?>
                                    <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/common/no_image.jpeg" alt="画像がありません。">
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>人気の投稿はありません。</p>';
                    endif;
                    ?>
                </div>
            </li>
            <li class="sidebar__item">
                <div class="sidebar__container">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/lotus4.svg')); ?>" alt="" />
                    <h2 class="sidebar__sidebar-title">口コミ</h2>
                </div>
                <div class="sidebar__review sidebar-review">
                    <?php
                    $args = array(
                        'post_type' => 'voice', // カスタム投稿タイプ
                        'posts_per_page' => 1
                    );
                    $voice_query = new WP_Query($args);
                    if ($voice_query->have_posts()) :
                        while ($voice_query->have_posts()) : $voice_query->the_post();
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
                            echo '<div class="sidebar-review__img"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/></div>';

                            // user_attributesフィールドグループから年代と性別のカスタムフィールドを取得して表示
                            $user_attributes = get_field('user_attributes'); // user_attributesフィールドグループを取得
                            $age_group = $user_attributes['age_group']; // 年代のフィールドを取得
                            $gender = $user_attributes['gender']; // 性別のフィールドを取得
                            ?>
                            <p class="sidebar-review__age"><?php echo esc_html($age_group) . '（' . esc_html($gender) . '）'; ?></p>
                            <?php

                            // タイトルの文字数を21文字に制限
                            $title = get_the_title();
                            ?>
                            <h3 class="sidebar-review__title"><?php echo esc_html($title); ?></h3>
                            <div class="sidebar-review__button">
                                <a href="<?php echo esc_url(home_url('/voice/')); ?>" class="button"><span>View more</span></a>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p class="sidebar-review__text">口コミがありません。</p>
                    <?php endif; ?>
                </div>
            </li>
            <li class="sidebar__item">
                <div class="sidebar__container">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/lotus4.svg')); ?>" alt="" />
                    <h2 class="sidebar__sidebar-title">作品紹介</h2>
                </div>
                <div class="sidebar__cards sidebar-cards">
                    <?php
                    // カスタム投稿タイプ 'campaign' の最新の投稿を取得
                    $sidebar_campaigns = new WP_Query(array(
                        'post_type' => 'campaign',
                        'posts_per_page' => 2, // ここで表示したい投稿数を指定
                    ));

                    if ($sidebar_campaigns->have_posts()) :
                        while ($sidebar_campaigns->have_posts()) : $sidebar_campaigns->the_post();
                    ?>
                    <div class="sidebar__card sidebar-card">
                        <div class="sidebar-card__img">
                            <?php
                            // アイキャッチ画像が設定されていればそのURLを使用
                            if (has_post_thumbnail()) {
                                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                $image_alt = get_the_title(); // 代替テキストとして投稿のタイトルを使用
                            } else {
                                // アイキャッチ画像が設定されていない場合はデフォルト画像のURLを指定
                                $image_url = get_theme_file_uri('/assets/images/common/no_image.jpeg');
                                $image_alt = '画像がありません。'; // 代替テキスト
                            }
                            // 画像タグの出力
                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/>';
                            ?>
                        </div>
                        <div class="sidebar-card__content">
                            <h3 class="sidebar-card__title"><?php the_title(); ?></h3>
                            <p class="sidebar-card__lead">期間限定展示</p>
                            <div class="sidebar-card__layout">
                                <?php
                                $discount_price = get_field('campaign-discount-price');
                                ?>
                                <div class="sidebar-card__before">
                                    <span>作者</span>
                                </div>
                                <div class="sidebar-card__after"><?php echo nl2br(esc_html($discount_price ? $discount_price : '準備中')); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata(); // クエリのリセット
                    ?>
                    <div class="sidebar-card__button">
                        <a href="<?php echo esc_url(home_url('/campaign/')); ?>" class="button"><span>View more</span></a>
                    </div>
                    <?php else : ?>
                    <p>キャンペーンの投稿がありません。</p>
                    <?php endif; ?>
                </div>
            </li>
            <li class="sidebar__item">
                <div class="sidebar__container">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/lotus4.svg')); ?>" alt="ホームブログアイコン" />
                    <h2 class="sidebar__sidebar-title">アーカイブ</h2>
                </div>
                <ul class="sidebar__archive sidebar-archive">
                    <?php
                    global $wpdb;
                    // 年ごとの投稿を取得するクエリ
                    $years = $wpdb->get_results("
                    SELECT YEAR(post_date) AS `year`
                    FROM $wpdb->posts
                    WHERE post_type = 'post' AND post_status = 'publish'
                    GROUP BY YEAR(post_date)
                    ORDER BY post_date DESC
                    ", OBJECT);

                    if (!empty($years)) {
                    // 各年のデータをループ処理
                    foreach ($years as $year) {
                        echo '<li class="sidebar-archive__item archive-item">';
                        echo '<a href="' . esc_url(get_year_link($year->year)) . '" class="archive-item__past js-toggle-year">' . esc_html($year->year) . '</a>';

                        echo '<ul class="archive-item__months js-months-list" style="display: none;">';
                        // 月ごとの投稿を取得するクエリ
                        $months = $wpdb->get_results($wpdb->prepare("
                        SELECT MONTH(post_date) AS `month`, COUNT(ID) as posts
                        FROM $wpdb->posts
                        WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = %d
                        GROUP BY MONTH(post_date)
                        ORDER BY post_date DESC
                        ", $year->year), OBJECT);

                        // 各月のデータをループ処理
                        foreach ($months as $month) {
                        $dateObj = DateTime::createFromFormat('!m', $month->month);
                        $monthName = $dateObj->format('n月'); // 月番号を月名に変換
                        echo '<li class="archive-item__month">';
                        echo '<a href="' . esc_url(get_month_link($year->year, $month->month)) . '" class="archive-item__link">' . esc_html($monthName) . '</a>';
                        echo '</li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    }
                    } else {
                    echo '<li class="sidebar-archive__item archive-item">';
                    echo '<p class="archive-item__text">投稿がありません。</p>';
                    echo '</li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </aside>