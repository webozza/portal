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

  let validateEmptyBriefs = () => {
    // Background
    let background = tinymce.get("background");
    background.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Campaign objective
    let campaignObjective = tinymce.get("campaign_objective");
    campaignObjective.on("keyup", function (e) {
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

    // Deliverables
    let deliverables = tinymce.get("deliverables");
    deliverables.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Key messages
    let keyMessages = tinymce.get("key_messages");
    keyMessages.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
      }
    });

    // Desired action
    let desiredAction = tinymce.get("desired_action");
    desiredAction.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
        $(".btn-co-approval").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
        $(".btn-co-approval").removeClass("active");
      }
    });

    // Budget
    let budget = tinymce.get("budget");
    budget.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
        $(".btn-co-approval").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
        $(".btn-co-approval").removeClass("active");
      }
    });

    // Expected return
    let expectedReturn = tinymce.get("expected_return");
    expectedReturn.on("keyup", function (e) {
      let thisContent = this.getContent();
      if (thisContent !== "") {
        $(".cure-next-slide").addClass("active");
        $(".btn-co-approval").addClass("active");
      } else {
        $(".cure-next-slide").removeClass("active");
        $(".btn-co-approval").removeClass("active");
      }
    });

    // Metrics to track
    let metricsToTrack = tinymce.get("metrics_to_track");
    metricsToTrack.on("keyup", function (e) {
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

  let slideValidationBriefs = () => {
    let swiperSlides = $(".swiper-slide").length - 1;

    swiper.on("slideChange", function () {
      let background = tinymce.get("background").getContent();
      let campaignObjective = tinymce.get("campaign_objective").getContent();
      let audience = tinymce.get("audience").getContent();
      let deliverables = tinymce.get("deliverables").getContent();
      let keyMesssages = tinymce.get("key_messages").getContent();
      let desiredAction = tinymce.get("desired_action").getContent();
      let budget = tinymce.get("budget").getContent();
      let expectedReturn = tinymce.get("expected_return").getContent();
      let metricsToTrack = tinymce.get("metrics_to_track").getContent();
      let supportingFiles = tinymce.get("metrics_to_track").getContent();

      $(".cure-next-slide").removeClass("active");

      if (background !== "" && swiper.activeIndex == 0) {
        $(".cure-next-slide").addClass("active");
      } else if (campaignObjective !== "" && swiper.activeIndex == 1) {
        $(".cure-next-slide").addClass("active");
      } else if (audience !== "" && swiper.activeIndex == 2) {
        $(".cure-next-slide").addClass("active");
      } else if (deliverables !== "" && swiper.activeIndex == 3) {
        $(".cure-next-slide").addClass("active");
      } else if (keyMesssages !== "" && swiper.activeIndex == 4) {
        $(".cure-next-slide").addClass("active");
      } else if (desiredAction !== "" && swiper.activeIndex == 5) {
        $(".cure-next-slide").addClass("active");
      } else if (budget !== "" && swiper.activeIndex == 6) {
        $(".cure-next-slide").addClass("active");
      } else if (expectedReturn !== "" && swiper.activeIndex == 7) {
        $(".cure-next-slide").addClass("active");
      } else if (metricsToTrack !== "" && swiper.activeIndex == 8) {
        $(".cure-next-slide").addClass("active");
      } else if (supportingFiles !== "" && swiper.activeIndex == 9) {
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

  let createNewBrief = () => {
    $(".cure-modal.new-brief .modal-submit").click(async function () {
      let client = $(".nb-select-client").find(":selected").val();
      let template = $(".nb-select-template").find(":selected").val();
      let draftsDate = $(".nb-drafts-date").val();
      let deliveryDate = $(".nb-delivery-date").val();
      let inMarketDate = $(".nb-in-market-date").val();
      $('#new-brief [name="client"]').val(client);
      $('#new-brief [name="template"]').val(template);
      $('#new-brief [name="drafts_date"]').val(draftsDate);
      $('#new-brief [name="delivery_date"]').val(deliveryDate);
      $('#new-brief [name="in_market_date"]').val(inMarketDate);

      if (
        client !== "" &&
        template !== "" &&
        draftsDate !== "" &&
        deliveryDate !== "" &&
        inMarketDate !== ""
      ) {
        $(".cure-modal.new-brief form").submit();
      } else {
        $(this).parent().parent().parent().find(".error-msg").fadeIn();
      }
    });
  };

  let noClients = () => {
    let clientCount = $(".nb-select-client option").length;
    if (clientCount == 0) {
      $(".nb-select-client")
        .parent()
        .append(
          `<p style="color:red">There are no approved client overviews</p>`
        );
    }
  };

  const _ProjectBriefData = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      background: "",
      campaign_objective: "",
      audience: "",
      deliverables: "",
      key_messages: "",
      desired_action: "",
      budget: "",
      expected_return: "",
      metrics_to_track: "",
      drafts_date: cure.draftsDate,
      delivery_date: cure.deliveryDate,
      in_market_date: cure.inMarketDate,
      template: cure.template,
      status: "Pending Approval",
      prepared_for: cure.preparedFor,
      prepared_by: cure.preparedBy,
      briefing_date: cure.preparedDate,
    },
  };

  let fetchProjectBrief = async () => {
    const url = `${cure.root}/wp-json/wp/v2/project-brief`;
    let res = await fetch(url, {
      method: "POST",
      headers: {
        "X-WP-Nonce": cure.nonce,
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(_ProjectBriefData),
    });
    return await res.json();
  };

  let renderProjectBrief = async () => {
    let data = await fetchProjectBrief();
    console.log("project brief data saved =>", data);
  };

  let sendBriefApproval = async () => {
    $(".btn-co-approval").click(async function () {
      let background = tinymce.get("background").getContent();
      let campaignObjective = tinymce.get("campaign_objective").getContent();
      let audience = tinymce.get("audience").getContent();
      let deliverables = tinymce.get("deliverables").getContent();
      let keyMesssages = tinymce.get("key_messages").getContent();
      let desiredAction = tinymce.get("desired_action").getContent();
      let budget = tinymce.get("budget").getContent();
      let expectedReturn = tinymce.get("expected_return").getContent();
      let metricsToTrack = tinymce.get("metrics_to_track").getContent();
      _ProjectBriefData.acf.background = background;
      _ProjectBriefData.acf.campaign_objective = campaignObjective;
      _ProjectBriefData.acf.audience = audience;
      _ProjectBriefData.acf.deliverables = deliverables;
      _ProjectBriefData.acf.key_messages = keyMesssages;
      _ProjectBriefData.acf.desired_action = desiredAction;
      _ProjectBriefData.acf.budget = budget;
      _ProjectBriefData.acf.expected_return = expectedReturn;
      _ProjectBriefData.acf.metrics_to_track = metricsToTrack;
      if (
        confirm(
          "Are you sure you want to send this in for approval? Make sure to doublecheck for careless mistakes and save others the hassle of having to correct you!"
        ) == true
      ) {
        renderProjectBrief();
        $(".project-brief-success").fadeIn().css("display", "flex");
      }
    });
  };

  if (window.location.href.indexOf("?co_client") > -1) {
    validateEmpty();
    cureSlideControls();
    cureSlideValidation();
    sendForApproval();
  } else if (window.location.href.indexOf("?client") > -1) {
    cureSlideControls();
    validateEmptyBriefs();
    slideValidationBriefs();
    sendBriefApproval();
  } else {
    createNewBrief();
    noClients();
  }
});
