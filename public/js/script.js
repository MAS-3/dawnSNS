$(function () {
    //投稿編集モーダルの処理
    $('.modalopen').on('click', function () {//モーダル起動スイッチ
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
  });
  $('.modalClose,.modal-main').on('click', function () {
    $('.js-modal').fadeOut();
  });


});