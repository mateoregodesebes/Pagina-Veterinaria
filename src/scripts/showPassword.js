$(function () {
  $('.toggle-password').on('click', function () {
    const $btn = $(this);
    const $input = $btn.prev('input'); // input inmediatamente anterior
    const $icon = $btn.find('i');

    if ($input.attr('type') === 'password') {
      $input.attr('type', 'text');
      $icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      $input.attr('type', 'password');
      $icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });
});
