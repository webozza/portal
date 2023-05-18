jQuery(document).ready(function ($) {
  // Navigation
  let windowHeight = $(window).height();
  let bodyHeight = $("body").height();
  if (windowHeight > bodyHeight) {
    $("body, html").css("height", "100%");
  }

  // Navigation Footer
  let siteBranding = $(".site-branding").height();
  let extraBar = 12;
  let totalheight = Number(siteBranding) + Number(extraBar);
  console.log(totalheight);
  $(".nav-parent").height(windowHeight - totalheight);

  $(window).resize(function () {
    let windowHeight = $(window).height();
    $(".nav-parent").height(windowHeight - totalheight);
  });
});
