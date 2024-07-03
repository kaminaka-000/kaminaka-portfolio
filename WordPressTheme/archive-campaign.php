<?php get_header(); ?>

<main>
    <!-- 下層ページのmv -->
    <section class="sub-mv">
        <div class="sub-mv__inner">
            <div class="sub-mv__header">
                <h1 class="sub-mv__title">Art</h1>
            </div>
            <div class="sub-mv__img">
                <picture>
                    <source media="(min-width: 768px)" srcset="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract1.jpeg')); ?>"/>
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/common/abstract11.jpeg')); ?>" alt="写真:鮮やかな色彩と力強い筆遣いが特徴の抽象画です。赤、黄色、青、白が重なり合い、エネルギッシュな構成を生み出しています。"/>
                </picture>
            </div>
        </div>
    </section>

    <!-- パンくず -->
    <?php get_template_part('parts/breadcrumb'); ?>

    <!-- sub-campaign -->
    <?php if (have_posts()) : // 記事があれば表示 ?>
        <section class="sub-campaign sub-campaign-spacing sub-layout">
        <div class="sub-campaign__inner inner">
            <div class="sub-campaign__wrapper">

            <!-- タブの表示 -->
            <div class="sub-campaign__tab tab">
                <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>" class="tab__menu is-active">ALL</a>
                <?php
                $genre_terms = get_terms('campaign_category', array('hide_empty' => false));
                foreach ($genre_terms as $genre_term) :
                ?>
                <a href="<?php echo esc_url(get_term_link($genre_term, 'campaign_category')); ?>" class="tab__menu">
                    <?php echo esc_html($genre_term->name); ?>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- 投稿のリスト -->
            <ul class="sub-campaign__cards sub-cards">
                <?php
                // カスタムクエリを使用してキャンペーン投稿を取得
                $args = array(
                    'post_type' => 'campaign', // カスタム投稿タイプのスラッグ
                    'posts_per_page' => -1,
                );
                $custom_query = new WP_Query($args);
                ?>

                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <li class="sub-cards__info-card">
                    <div class="info-card">
                        <!-- アイキャッチ画像の表示 -->
                        <div class="info-card__img">
                        <?php
                        // アイキャッチ画像が設定されているかチェック
                        if (has_post_thumbnail()) {
                            // アイキャッチ画像のURLと代替テキストを取得
                            $image_url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
                            $image_alt = esc_attr(get_the_title() . 'のアイキャッチ画像。'); // 代替テキストとして投稿のタイトルを使用し、その後に「のアイキャッチ画像」を追加
                        } else {
                            // アイキャッチ画像がない場合はデフォルト画像のURLと代替テキストを設定
                            $image_url = esc_url(get_theme_file_uri('/assets/images/common/no_image.jpeg'));
                            $image_alt = esc_attr('画像がありません。'); // 代替テキスト
                        }
                        // 画像タグの出力
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"/>';
                        ?>
                        </div>
                        <!-- 投稿コンテンツの表示 -->
                        <div class="info-card__content info-card__content--sub">
                        <div class="info-card__wrapper">
                            <?php
                            // 現在の投稿に関連付けられているターム（カテゴリー）を取得
                            $terms = get_the_terms(get_the_ID(), 'campaign_category');
                            if (!empty($terms) && !is_wp_error($terms)) :
                            // ターム名を配列に追加
                            $term_names = array_map(function($term) {
                                return esc_html($term->name);
                            }, $terms);
                            // ターム名のリストをカンマ区切りで表示
                            $term_list = join(', ', $term_names);
                            ?>
                            <!-- ターム（カテゴリー）の表示 -->
                            <p class="info-card__category"><?php echo esc_html($term_list); ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- 投稿タイトルの表示 -->
                        <h2 class="info-card__title info-card__title--sub">
                            <?php echo esc_html(get_the_title()); ?>
                        </h2>
                        <p class="info-card__lead">期間限定展示</p>
                        <div class="info-card__layout">
                            <?php
                            // フィールド「作品名」を取得
                            $art_name = get_field('campaign-discount-price');
                            ?>
                            <!-- 作品名の表示 -->
                            <div class="info-card__before">
                            <span>作品名</span>
                            </div>
                            <div class="info-card__after info-card__after--sub">
                            <span><?php echo esc_html($art_name ? $art_name : '準備中'); ?></span>
                            </div>
                        </div>
                        <div class="info-card__pc u-desktop">
                            <?php
                            // グループフィールド「campaign_text」を取得
                            $campaign_text = get_field('campaign_text');
                            if ($campaign_text) {
                            // 説明文とキャンペーン期間を取得
                            $description = $campaign_text['campaign-description'];
                            $period = $campaign_text['campaign-period'];
                            // 説明文をトリミング（必要に応じて文字数を制限）
                            $trimmed_description = mb_substr($description, 0, 165);
                            ?>
                            <!-- 説明文の表示 -->
                            <p class="info-card__text">
                            <?php echo nl2br(esc_html($trimmed_description ? $trimmed_description : 'テキスト準備中')); ?>
                            </p>
                            <?php
                            // キャンペーン期間の開始日と終了日を取得
                            if (!empty($period['start_date']) && !empty($period['end_date'])) {
                            $start_date = new DateTime($period['start_date']);
                            $end_date = new DateTime($period['end_date']);

                            $start_date_formatted = $start_date->format('Y/n/j');
                            $end_date_formatted = $end_date->format('n/j');

                            if ($start_date->format('Y') !== $end_date->format('Y')) {
                                // 異なる年の場合は西暦も表示
                                $end_date_formatted = $end_date->format('Y/n/j');
                            }
                            ?>
                            <!-- キャンペーン期間の表示 -->
                            <p class="info-card__date">
                                <?php echo esc_html($start_date_formatted . ' - ' . $end_date_formatted); ?>
                            </p>
                            <?php } ?>
                            <?php } ?>
                            <!-- ボタンの表示 -->
                            <p class="info-card__button-text">ご予約・お問い合わせはコチラ</p>
                            <div class="info-card__button">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="button"><span>Contact us</span></a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
                </ul>

            <!-- ページネーション -->
            <div class="pagenavi sub-pagenavi-spacing">
                <?php wp_pagenavi(); ?>
            </div>

            </div>
        </div>
        </section>
        <?php else : ?>
        <div class="sub-cards__content">
        <p class="sub-cards__text">投稿がありません。</p>
        </div>
        <?php endif; ?>



<?php get_footer(); ?>
