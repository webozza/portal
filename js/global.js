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
  $(".nav-parent").height(windowHeight - totalheight);

  $(window).resize(function () {
    let windowHeight = $(window).height();
    $(".nav-parent").height(windowHeight - totalheight);
  });

  // Navigation Hover
  let navIcons = {
    dashboard: `${cure.themeDir}/img/icons/dashboard.png`,
    client_reporting: `${cure.themeDir}/img/icons/client-reporting.png`,
    approvals: `${cure.themeDir}/img/icons/checklists.png`,
    briefing: `${cure.themeDir}/img/icons/briefing.png`,
  };
  let navIconsActive = {
    dashboard: `${cure.themeDir}/img/icons/dashboard-active.png`,
    client_reporting: `${cure.themeDir}/img/icons/client-reporting-active.png`,
    approvals: `${cure.themeDir}/img/icons/checklists-active.png`,
    briefing: `${cure.themeDir}/img/icons/briefing-active.png`,
  };

  // Mouse Enter
  $(".main-navigation li:not(.active)").mouseenter(function () {
    let thisLink = $(this);
    let thisLinkName = thisLink.find("a").text();

    if (thisLinkName == "Client Reporting") {
      thisLink.find("img").attr("src", navIconsActive.client_reporting);
    } else if (thisLinkName == "Approvals") {
      thisLink.find("img").attr("src", navIconsActive.approvals);
    } else if (thisLinkName == "Dashboard") {
      thisLink.find("img").attr("src", navIconsActive.dashboard);
    } else if (thisLinkName == "Project Briefs") {
      thisLink.find("img").attr("src", navIconsActive.briefing);
    }
  });

  // Mouse Leave
  $(".main-navigation li:not(.active)").mouseleave(function () {
    let thisLink = $(this);
    let thisLinkName = thisLink.find("a").text();

    if (thisLinkName == "Client Reporting") {
      thisLink.find("img").attr("src", navIcons.client_reporting);
    } else if (thisLinkName == "Approvals") {
      thisLink.find("img").attr("src", navIcons.approvals);
    } else if (thisLinkName == "Dashboard") {
      thisLink.find("img").attr("src", navIcons.dashboard);
    } else if (thisLinkName == "Project Briefs") {
      thisLink.find("img").attr("src", navIcons.briefing);
    }
  });

  // Logout confirmation
  $(".logout").click(function (e) {
    let logoutLink = $(this).attr("href");
    e.preventDefault();
    if (confirm(`Are you sure you want to logout`) == true) {
      window.location.href = logoutLink;
    }
  });

  // MODAL TRIGGER
  $(".trigger-modal").click(function () {
    let modalTrigger = $(this).data("modal");
    $(".cure-modal").each(function () {
      let thisModal = $(this);
      let modal = thisModal.data("modal");
      if (modal == modalTrigger) {
        thisModal.fadeIn().css("display", "flex");
      }
    });
  });

  // MODAL CLOSE
  $(".cure-modal .btn-close").click(function () {
    $(this).parent().parent().parent().parent().hide();
  });
  $(".cure-modal .close-modal").click(function () {
    $(this).parent().parent().parent().hide();
  });

  // Initiate Select2
  $(".has-select2").select2();

  // Current Date
  const date = new Date();
  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();
  let currentDate = `${day}-${month}-${year}`;
  cure["currentDate"] = currentDate;

  // Revisions Functionality
  let revisionComments = () => {
    $(".wpd-comment-label span").each(function () {
      let thisLabel = $(this);
      if (thisLabel.text() == "Author") {
        thisLabel.text("Assignee");
        thisLabel.parent().css("background-color", "var(--cure-primary-color)");
      }
    });
  };

  let runOnComment = () => {
    $(".wc_comm_submit ").click(function () {
      revisionComments();
      setTimeout(() => {
        revisionComments();
        profileImages();
      }, 600);
    });
  };

  $(".wpd-reply-button").click(function () {
    setTimeout(() => {
      runOnComment();
    }, 1000);
  });

  let profileImages = () => {
    let ronyChowdhury = `${tempDir}/img/users/rony-chowdhury.jpeg`;
    let shawnPeh = `${tempDir}/img/users/shawn-peh.jpeg`;
    let leeMorgan = `${tempDir}/img/users/lee-morgan.jpeg`;
    $(".wpd-avatar img").each(function () {
      let imgAlt = $(this).attr("alt");
      if (imgAlt == "Rony Chowdhury") {
        $(this).attr("src", ronyChowdhury);
        $(this).attr("srcset", ronyChowdhury);
      } else if (imgAlt == "Lee Morgan") {
        $(this).attr("src", leeMorgan);
        $(this).attr("srcset", leeMorgan);
      } else if (imgAlt == "Shawn Peh") {
        $(this).attr("src", shawnPeh);
        $(this).attr("srcset", shawnPeh);
      }
    });
  };

  if ($("body").hasClass("single")) {
    revisionComments();
    runOnComment();
    profileImages();
  }
});
