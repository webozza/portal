jQuery(document).ready(function ($) {
  // Client Filter
  let singleClientReports = () => {
    $(".cure--project").click(function () {
      let slug = $(this).data("client");
      let projectName = $(this).find("span").text();
      $('[name="client"]').val(slug);
      $('[name="project_name"]').val(projectName);
      $('[name="client"]').parent().submit();
    });
  };

  // Single Client Breadcrumbs
  let singleClientBreadcrumbs = () => {
    $(".breadcrumb_parent").click(function () {
      let link = $(".menu li.active a").attr("href");
      window.location.href = link;
    });
  };

  // Report Type Filter
  let reportTypeFilter = () => {
    $(".single-client-reporting .filters")
      .eq(0)
      .find("a")
      .click(function () {
        let reportType = $(this).text();
        let reportTypeField = $('[name="report_type"]');
        reportTypeField.val(reportType);
        reportTypeField.parent().submit();
      });
  };

  // Add Insights
  let addInsights = () => {
    $(".add-insights a").click(function () {
      let newInsight = $(".add-insights textarea").val();
      if (newInsight !== "") {
        $(".cr-insights ul").append(`<li>${newInsight}</li>`);
        $(".add-insights textarea").val("");
      }
    });
  };

  // Add Actions
  let addActions = () => {
    $(".add-actions a").click(function () {
      let newInsight = $(".add-actions textarea").val();
      if (newInsight !== "") {
        $(".cr-actions ul").append(`<li>${newInsight}</li>`);
        $(".add-actions textarea").val("");
      }
    });
  };

  // Modal Send Report
  let modalSendReport = () => {
    // Open Modal
    $(".has-modal a").click(function () {
      let findModal = $(this).data("modal");
      $(".cure-modal").each(function () {
        if ($(this).data("model") == findModal) {
          $(this).fadeIn();
        }
      });
    });
    // Close Modal
    $(".close-modal").click(function () {
      $(this).parent().parent().parent().fadeOut();
    });
    $(".btn-close").click(function () {
      $(this).parent().parent().parent().parent().fadeOut();
    });

    // POST REQ
    $("#send_report").submit(function (e) {
      let formData = {
        client_email: $(this).find('input[type="email"]').val(),
        send_report: $(this).find('input[name="send_report"]').val(),
      };

      fetch("", {
        method: "POST",
        body: JSON.stringify(formData),
      })
        .then((resp) => {
          console.log(resp);
        })
        .catch((resp) => {
          console.log(resp);
        });

      e.preventDefault();
    });

    // Send Report
    $(".modal-submit").click(function (e) {
      let emailAddress = $(this)
        .parent()
        .parent()
        .parent()
        .find("form input[type='email']");
      if (
        emailAddress.val().indexOf("@") == -1 &&
        emailAddress.val().indexOf(".") == -1 &&
        $(".error-msg").length == 0
      ) {
        emailAddress.after(
          `<span class="error-msg">Email address is invalid</span>`
        );
      } else if (
        emailAddress.val().indexOf("@") > -1 &&
        emailAddress.val().indexOf(".") > -1
      ) {
        $(".error-msg").remove();
        $("#send_report").submit();
      }
    });
  };

  singleClientReports();
  singleClientBreadcrumbs();
  reportTypeFilter();
  addInsights();
  addActions();
  modalSendReport();
});
