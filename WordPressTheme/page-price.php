<?php get_header(); ?>


<main>
      <!-- 下層ページのmv -->
      <section class="sub-mv">
        <div class="sub-mv__inner">
          <div class="sub-mv__header">
            <h1 class="sub-mv__title">Price</h1>
          </div>
          <div class="sub-mv__img">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/sub-price-mv-pc.jpeg"/>
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/sub-price-mv.jpeg" alt="写真:海面からわずかに突き出たスノーケリングをしている人。" />
            </picture>
          </div>
        </div>
      </section>

      <!-- パンくず -->
      <?php get_template_part('parts/breadcrumb'); ?>

      <!-- sub-price -->
      <section class="sub-price sub-price-spacing sub-layout">
        <div class="sub-price__inner inner">
            <?php
            // SCFでデータを取得する部分
            $license_section_title = SCF::get('license_section_title');
            $license_course_items = SCF::get('course_items');

            $experience_section_title = SCF::get('experience_section_title');
            $experience_course_items = SCF::get('experience_diving');

            $fun_section_title = SCF::get('fun_section_title');
            $fun_course_items = SCF::get('fun_diving');

            $special_section_title = SCF::get('special_section_title');
            $special_course_items = SCF::get('special_diving');

            // セクションを表示する関数
            function display_diving_section($section_id, $section_title, $course_items, $item_name_key, $type_detail_key, $item_cost_key) {
                if (!empty($section_title) && !empty($course_items)) {
                    $has_valid_items = false;

                    // アイテムのチェック
                    foreach ($course_items as $item) {
                        $dive_name = isset($item[$item_name_key]) ? $item[$item_name_key] : '';
                        $item_cost = isset($item[$item_cost_key]) ? $item[$item_cost_key] : '';

                        if (!empty($dive_name) || !empty($item_cost)) {
                            $has_valid_items = true;
                            break;
                        }
                    }

                    // 有効なアイテムがある場合のみ表示
                    if ($has_valid_items) {
                        echo '<div id="' . esc_attr($section_id) . '" class="sub-price__wrapper">';
                        echo '<div class="sub-price__title-group">';
                        echo '<h2 class="sub-price__title">' . esc_html($section_title) . '</h2>';
                        echo '</div>';

                        echo '<table class="sub-price__list">';
                        echo '<tbody>';

                        // 各アイテムの表示
                        foreach ($course_items as $item) {
                            $dive_name = isset($item[$item_name_key]) ? $item[$item_name_key] : '';
                            $dive_type_detail = isset($item[$type_detail_key]) ? $item[$type_detail_key] : '';
                            $item_cost = isset($item[$item_cost_key]) ? $item[$item_cost_key] : '';

                            // 名前またはコストのどちらかが空の場合に「準備中」を表示
                            $dive_name_display = !empty($dive_name) ? $dive_name : '準備中';
                            $item_cost_display = !empty($item_cost) ? '￥' . number_format($item_cost) : '準備中';

                            echo '<tr>';
                            echo '<td class="sub-price__data"><div class="sub-price__type"><span class="sub-price__name">' . esc_html($dive_name_display) . '<span class="sub-price__detail">' . esc_html($dive_type_detail) . '</span></span></div></td>';
                            echo '<td class="sub-price__cost">' . esc_html($item_cost_display) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
                }
            }

            // 各セクションの表示
            display_diving_section('sub-price-license', $license_section_title, $license_course_items, 'license_item_name', 'license_type_detail', 'license_item_cost');
            display_diving_section('sub-price-experience', $experience_section_title, $experience_course_items, 'experience_item_name', 'experience_type_detail', 'experience_item_cost');
            display_diving_section('sub-price-fan', $fun_section_title, $fun_course_items, 'fun_item_name', 'fun_type_detail', 'fun_item_cost');
            display_diving_section('sub-price-special', $special_section_title, $special_course_items, 'special_item_name', 'special_type_detail', 'special_item_cost');
            ?>

            <?php
            // CFSでデータを取得し表示する部分
            $courses = CFS()->get('courses');

            if (!empty($courses)) {
                foreach ($courses as $course_section) {
                    $section_title = $course_section['section_title'];
                    $section_courses = $course_section['section_courses'];

                    if (!empty($section_title) && !empty($section_courses)) {
                        echo '<div class="sub-price__wrapper">';
                        echo '<div class="sub-price__title-group">';
                        echo '<h2 class="sub-price__title">' . esc_html($section_title) . '</h2>';
                        echo '</div>';

                        echo '<table class="sub-price__list">';
                        echo '<tbody>';

                        foreach ($section_courses as $course_item) {
                            $course_name = $course_item['course_name'];
                            $course_detail = $course_item['course_detail'];
                            $course_fee = $course_item['course_fee'];

                            // 名前またはコストのどちらかが空の場合に「準備中」を表示
                            $course_name_display = !empty($course_name) ? $course_name : '準備中';
                            $course_fee_display = !empty($course_fee) ? '￥' . number_format($course_fee) : '準備中';

                            echo '<tr>';
                            echo '<td class="sub-price__data"><div class="sub-price__type"><span class="sub-price__name">' . esc_html($course_name_display) . '<span class="sub-price__detail">' . esc_html($course_detail) . '</span></span></div></td>';
                            echo '<td class="sub-price__cost">' . esc_html($course_fee_display) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </section>



<?php get_footer(); ?>