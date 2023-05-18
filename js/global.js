jQuery(document).ready(function ($) {
  let windowHeight = $(window).height();
  let bodyHeight = $("body").height();
  if (windowHeight > bodyHeight) {
    $("body, html").css("height", "100%");
  }
});
