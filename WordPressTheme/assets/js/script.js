"use strict";

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  /*================================================================
      ハンバーガーメニュー
  ================================================================ */
  $(function () {
    // ハンバーガーメニューのクリックイベントハンドラ
    $(".js-header-hamburger").on("click", function () {
      $(this).toggleClass("is-open");
      if ($(this).hasClass("is-open")) {
        openDrawer();
      } else {
        closeDrawer();
      }
    });

    // 背景またはページ内リンクをクリックでドロワーを閉じるイベントハンドラ
    $(".js-nav a[href]").on("click", function () {
      closeDrawer();
    });

    // ウィンドウのリサイズイベントハンドラ
    $(window).on('resize', function () {
      if (window.matchMedia("(min-width: 768px)").matches) {
        closeDrawer(); // 768px以上でドロワーを閉じる
      }
    });
  });

  // ドロワーを開く処理
  function openDrawer() {
    $(".js-nav").fadeIn();
    $("body").css({
      height: "100%",
      overflow: "hidden"
    });
    $(".header").addClass("header-drawer-open");
  }

  // ドロワーを閉じる処理
  function closeDrawer() {
    $(".js-nav").fadeOut();
    $(".js-header-hamburger").removeClass("is-open");
    $("body").css({
      height: "",
      overflow: ""
    });
    $(".header").removeClass("header-drawer-open");
  }

  /*================================================================
      mvスライダー
  ================================================================ */
  var swiper = new Swiper(".js-mv-swiper", {
    loop: true,
    effect: 'fade',
    // フェード効果を適用
    fadeEffect: {
      crossFade: true // クロスフェード効果を有効にする
    },

    speed: 3000,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false
    }
  });

  /*================================================================
      campaignスライダー
  ================================================================ */
  var swiper = new Swiper(".js-campaign-cards", {
    loop: true,
    slidesPerView: 1.26,
    spaceBetween: 24,
    breakpoints: {
      500: {
        slidesPerView: 2,
        spaceBetween: 40
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 40
      },
      1200: {
        slidesPerView: 3.5,
        spaceBetween: 40
      }
    },
    navigation: {
      nextEl: ".campaign__prev",
      prevEl: ".campaign__next"
    }
  });

  /*================================================================
      画像の出現アニメーション
  ================================================================ */
  var box = $('.course__img, .testimonial-item__img, .price__img-sp, .price__img-pc'),
    speed = 700;

  //.colorboxの付いた全ての要素に対して下記の処理を行う
  box.each(function () {
    $(this).append('<div class="color"></div>');
    var color = $(this).find($('.color')),
      image = $(this).find('img');
    var counter = 0;
    image.css('opacity', '0');
    color.css('width', '0%');
    //inviewを使って背景色が画面に現れたら処理をする
    color.on('inview', function () {
      if (counter == 0) {
        $(this).delay(200).animate({
          'width': '100%'
        }, speed, function () {
          image.css('opacity', '1');
          $(this).css({
            'left': '0',
            'right': 'auto'
          });
          $(this).animate({
            'width': '0%'
          }, speed);
        });
        counter = 1;
      }
    });
  });

  /*================================================================
      トップへ戻るボタン
  ================================================================ */
  var topBtn = $('.to-top');
  topBtn.hide();

  // フッターの要素
  var footer = $('.footer');

  // ボタンの表示設定
  $(window).scroll(function () {
    var scrollAmount = $(window).scrollTop();
    var windowHeight = $(window).height();
    var footerTop = footer.offset().top;
    if (scrollAmount > 150) {
      // 指定のpx以上のスクロールでボタンを表示
      topBtn.fadeIn();
    } else {
      // 指定のpx以上のスクロールでボタンを非表示
      topBtn.fadeOut();
    }

    // フッターが表示範囲に入ってきたらボタンの位置を上に移動
    if (scrollAmount + windowHeight > footerTop) {
      topBtn.css('position', 'absolute');
      topBtn.css('bottom', windowHeight - (scrollAmount + topBtn.outerHeight() - footerTop) + 'px');
    } else {
      topBtn.css('position', 'fixed');
      topBtn.css('bottom', '10px');
    }
  });

  /*================================================================
      モーダルウィンドウ
  ================================================================ */
  $(".js-modal-open").on("click", function () {
    var target = $(this).data("target");
    var modal = $("#" + target);
    $(modal).fadeIn();
    return false;
  });
  $(".js-modal-close").on("click", function () {
    $(".js-modal").fadeOut();
    return false;
  });
});
// モーダルウィンドウオープン時の背景固定
var scrollPosition; // スクロール位置を保存する変数

// モーダルオープン
$(function () {
  var scrollPosition; // スクロール位置を保存する変数

  // モーダルオープン
  $(".js-modal-open").on("click", function () {
    scrollPosition = $(window).scrollTop(); // 現在のスクロール位置を保存
    $("body").css({
      overflow: 'hidden',
      position: 'static' // 'fixed'を避けて、ページの位置を保持
    });
    // モーダル表示処理（省略）
    return false;
  });

  // モーダルクローズ
  $(".js-modal-close").on("click", function () {
    $("body").css({
      overflow: '',
      // スクロールを再度許可
      position: '' // 'body'のpositionをリセット
    }).scrollTop(scrollPosition); // スクロール位置を復元
    // モーダル非表示処理（省略）
    return false;
  });

  /*================================================================
      sub-informationタブメニュー
  ================================================================ */
  // クエリパラメータからタブのIDを取得する関数
  function getQueryParam(name) {
    var results = new RegExp('[?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
      return null;
    } else {
      return decodeURIComponent(results[1]) || 0;
    }
  }

  // ページが読み込まれたときにクエリパラメータをチェックし、対応するタブをアクティブにする
  $(document).ready(function () {
    var tabId = getQueryParam('tab');
    if (tabId) {
      $('.js-tab-second').removeClass('is-active');
      $('.js-tab-second-content').removeClass('is-active');

      // タブメニューをアクティブにする
      $('.js-tab-second[data-number="' + tabId + '"]').addClass('is-active');
      // 対応するタブコンテンツを表示する
      $('#' + tabId).addClass('is-active');
    }

    // タブメニューのクリックイベントを設定
    $('.js-tab-second').on('click', function () {
      $('.js-tab-second').removeClass('is-active');
      $('.js-tab-second-content').removeClass('is-active');
      $(this).addClass('is-active');
      var number = $(this).data("number");
      $('#' + number).addClass('is-active');
    });
  });

  //サイドバーブログアーカイブ
  $('.js-toggle-year').on('click', function (event) {
    event.preventDefault();
    $(this).toggleClass('archive-item__past--active');
    $(this).next('.js-months-list').slideToggle();
  });

  //faq
  $('.js-faq-question').on('click', function () {
    $(this).next().slideToggle();
    $(this).toggleClass('is-open');
  });

  /*================================================================
      コンタクトフォームエラー
  ================================================================ */
  jQuery(".button--form").click(function () {
    jQuery(".wpcf7-form-control-wrap").addClass("is-show");
  });
});