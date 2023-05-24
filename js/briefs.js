jQuery(document).ready(function ($) {
  // New Client Overview Submit
  $(".client-overview .modal-submit").click(async function () {
    // Pass values to form
    $('[name="co_date_created"]').val(cure.currentDate);
    $('[name="co_created_by"]').val(cure.current_user_id);

    // Conditional submission
    let hasClientName = $('[name="co_client_name"]').val() !== "";
    if (hasClientName) {
      $(this).parent().parent().parent().find("form").submit();
    } else {
      $(this).parent().parent().parent().find(".error-msg").show();
    }
  });

  // Initiate Client Overview Fields
  const swiper = new Swiper(".swiper", {
    // Optional parameters
    slidesPerView: 1,
    direction: "horizontal",
    loop: false,
    allowTouchMove: true,
  });

  let cureSlideControls = () => {
    $(".cure-next-slide").click(function () {
      swiper.slideNext();
    });
    $(".cure-prev-slide").click(function () {
      swiper.slidePrev();
    });
  };

  let validateEmpty = () => {
    // About the client
    let aboutTheClient = tinymce.get("about_the_client");
    aboutTheClient.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Key contacts
    let keyContacts = tinymce.get("key_contacts");
    keyContacts.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Objectives
    let objectives = tinymce.get("objectives");
    objectives.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Audience
    let audience = tinymce.get("audience");
    audience.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Opportunities
    let opportunities = tinymce.get("opportunities");
    opportunities.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Competitors
    let competitors = tinymce.get("competitors");
    competitors.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
        $(".btn-co-approval").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
        $(".btn-co-approval").removeClass("active");
      }
    });
  };

  let cureSlideValidation = () => {
    let swiperSlides = $(".swiper-slide").length - 1;

    swiper.on("slideChange", function () {
      let aboutTheClient = tinymce.get("about_the_client").getContent();
      let keyContacts = tinymce.get("key_contacts").getContent();
      let objectives = tinymce.get("objectives").getContent();
      let audience = tinymce.get("audience").getContent();
      let opportunities = tinymce.get("opportunities").getContent();
      let competitors = tinymce.get("competitors").getContent();

      $(".cure-next-slide").removeClass("active");

      if (keyContacts !== "" && swiper.activeIndex == 1) {
        $(".cure-next-slide").addClass("active");
      } else if (aboutTheClient !== "" && swiper.activeIndex == 0) {
        $(".cure-next-slide").addClass("active");
      } else if (objectives !== "" && swiper.activeIndex == 2) {
        $(".cure-next-slide").addClass("active");
      } else if (audience !== "" && swiper.activeIndex == 3) {
        $(".cure-next-slide").addClass("active");
      } else if (opportunities !== "" && swiper.activeIndex == 4) {
        $(".cure-next-slide").addClass("active");
      } else if (competitors !== "" && swiper.activeIndex == 5) {
        $(".cure-next-slide").addClass("active");
      }

      // Controls
      swiper.activeIndex !== 0
        ? $(".cure-prev-slide").show()
        : $(".cure-prev-slide").hide();

      swiper.activeIndex == swiperSlides
        ? $(".cure-next-slide").hide()
        : $(".cure-next-slide").show();
    });
  };

  const _clientOverviewData = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      status: "Pending Approval",
      prepared_date: cure.preparedDate,
      prepared_for: cure.preparedFor,
      prepared_by: cure.preparedBy,
      about_client: "",
      key_contacts: "",
      objectives: "",
      audience: "",
      opportunities: "",
      competitors: "",
    },
  };

  let fetchClientOverview = async () => {
    const url = `${cure.root}/wp-json/wp/v2/client-overview`;
    let res = await fetch(url, {
      method: "POST",
      headers: {
        "X-WP-Nonce": cure.nonce,
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(_clientOverviewData),
    });
    return await res.json();
  };

  let renderClientOverview = async () => {
    let data = await fetchClientOverview();
    console.log("client overview data saved =>", data);
  };

  let sendForApproval = async () => {
    $(".btn-co-approval").click(async function () {
      let aboutTheClient = tinymce.get("about_the_client").getContent();
      let keyContacts = tinymce.get("key_contacts").getContent();
      let objectives = tinymce.get("objectives").getContent();
      let audience = tinymce.get("audience").getContent();
      let opportunities = tinymce.get("opportunities").getContent();
      let competitors = tinymce.get("competitors").getContent();
      _clientOverviewData.acf.about_client = aboutTheClient;
      _clientOverviewData.acf.key_contacts = keyContacts;
      _clientOverviewData.acf.objectives = objectives;
      _clientOverviewData.acf.audience = audience;
      _clientOverviewData.acf.opportunities = opportunities;
      _clientOverviewData.acf.competitors = competitors;
      if (
        confirm(
          "Are you sure you want to send this in for approval? Make sure to doublecheck for careless mistakes and save others the hassle of having to correct you!"
        ) == true
      ) {
        renderClientOverview();
        $(".client-overview-success").fadeIn().css("display", "flex");
      }
    });
  };

  if (window.location.href.indexOf("?") > -1) {
    validateEmpty();
    cureSlideControls();
    cureSlideValidation();
    sendForApproval();
  }
});