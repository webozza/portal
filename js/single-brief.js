jQuery(document).ready(function ($) {
  let _updateApproval = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      status: "Approved",
    },
  };

  let approveProjectBrief = () => {
    let fetchProjectBrief = async () => {
      const url = `${cure.root}/wp-json/wp/v2/project-brief/${cure.brief_id}`;
      let res = await fetch(url, {
        method: "PUT",
        headers: {
          "X-WP-Nonce": cure.nonce,
          "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(_updateApproval),
      });
      return await res.json();
    };
    let sendEmailNotification = async () => {
      // For Email Notification - Approved
      $('[name="your-name"]').val(cure.preparedBy);
      $('[name="your-email"]').val(cure.preparedByEmail);
      $('[name="your-subject"]').val(``);
      $('[name="your-message"]').val(
        `A ${cure.template} brief has been approved! Please visit: ${cure.root}/project-brief/${cure.brief_id} to view the ${cure.template} brief.`
      );
      $(".wpcf7-submit").click();
    };
    let renderProjectBrief = async () => {
      let response = await fetchProjectBrief();
      console.log("Approved this project brief =>", response);
      await sendEmailNotification();
      setTimeout(() => {
        window.location.href = `${cure.root}/approvals`;
      }, 600);
    };
    $(".cr-approve a").click(function () {
      if (
        confirm(
          `Are you sure you want to approve this ${cure.template} brief?`
        ) == true
      ) {
        renderProjectBrief();
      }
    });
  };

  let editBrief = () => {
    // Activate edit mode
    $(".cb-edit a").click(function () {
      $(this).parent().toggleClass("active");
      if ($(this).parent().hasClass("active")) {
        $(".cod-data").attr("contenteditable", "true");
        $(".cod-footer").show();
      } else {
        $(".cod-data").attr("contenteditable", "false");
        $(".cod-footer").hide();
      }
    });
    // Display loader on save
    $(".save--changes").click(function () {
      $(this).find("img").show();
    });
  };

  let updateBrief = () => {
    // Data to Push
    const _briefData = {
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
      },
    };

    let fetchBrief = async () => {
      const url = `${cure.root}/wp-json/wp/v2/project-brief/${cure.brief_id}`;
      let res = await fetch(url, {
        method: "PUT",
        headers: {
          "X-WP-Nonce": cure.nonce,
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(_briefData),
      });
      return await res.json();
    };

    // Post brief
    let postBrief = async () => {
      let response = await fetchBrief();
      // Attach View Status Link
      console.log("brief updated =>", response);
      $(".save--changes img").hide();
      $(".cb-edit a").trigger("click");
    };

    $(".save--changes").click(async function () {
      _briefData.acf.background = $(".cod-data.background").html();
      _briefData.acf.campaign_objective = $(
        ".cod-data.campaign-objective"
      ).html();
      _briefData.acf.audience = $(".cod-data.audience").html();
      _briefData.acf.deliverables = $(".cod-data.deliverables").html();
      _briefData.acf.key_messages = $(".cod-data.key-messages").html();
      _briefData.acf.desired_action = $(".cod-data.desired-action").html();
      _briefData.acf.budget = $(".cod-data.budget").html();
      _briefData.acf.expected_return = $(".cod-data.expected-return").html();
      _briefData.acf.metrics_to_track = $(".cod-data.metrics-to-track").html();
      postBrief();
    });
  };

  // runt the functions
  approveProjectBrief();
  editBrief();
  updateBrief();
});
