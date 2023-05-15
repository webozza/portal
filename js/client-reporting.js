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
      let insights = $(".cr-insights li").length;
      let actions = $(".cr-actions li").length;

      $(".cure-modal").each(function () {
        if ($(this).data("model") == findModal) {
          if (insights > 0 && actions > 0) {
            $(this).fadeIn();
          } else {
            $(".crm-forgot-insights").fadeIn().css("display", "flex");
          }
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

    // Add Insights after forgetting to...
    $(".jump-to-add-insights").click(function () {
      let addInsightsOffset = $(".add-insights-container").offset().top;
      $(".crm-forgot-insights").hide();
      $(window).scrollTop(addInsightsOffset);
    });

    // Send Report
    $(".modal-submit").click(async function (e) {
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
        // Append the insights
        $(".cr-insights li").each(function () {
          let insights = $(this).text();
          $("#send_report").append(
            `<input type="hidden" name="insights[]" value="${insights}">`
          );
        });
        // Append the actions
        $(".cr-actions li").each(function () {
          let actions = $(this).text();
          $("#send_report").append(
            `<input type="hidden" name="actions[]" value="${actions}">`
          );
        });
        $("#send_report").submit();
      }
    });

    // Dismiss success message
    $(".dismiss").click(function () {
      $(this).parent().parent().remove();
    });
  };

  // Download PDF
  let downloadPDF = () => {
    $(".cr--download").click(function () {
      window.jsPDF = window.jspdf.jsPDF;
      var doc = new jsPDF();
      var y = 0;

      // Headers
      doc.setTextColor(238, 168, 81);
      doc.setFontSize(12);
      y = 20;
      doc.text(10, 20, $(".report-header h5").text());

      doc.setTextColor(0, 0, 0);
      doc.setFontSize(16);
      doc.text(10, 28, $(".report-header h4").text());

      // Add image
      let clientLogo = $(".report-header img").attr("src");
      doc.addImage(clientLogo, "PNG", 180, 15, 15, 0);

      // Add table
      // Supply data via script
      let metricHeaders = [];
      let wtdMetrics = [];
      let mtdMetrics = [];
      let crInsights = [];
      let crActions = [];
      $(".report-body thead th").each(function () {
        let headers = $(this).text();
        metricHeaders.push(headers);
      });
      $(".report-body tbody tr:first-child td").each(function () {
        let wtdMets = $(this).text();
        wtdMetrics.push(wtdMets);
      });
      $(".report-body tbody tr:last-child td").each(function () {
        let mtdMets = $(this).text();
        mtdMetrics.push(mtdMets);
      });
      $(".cr-insights li").each(function () {
        let insights = $(this).text();
        crInsights.push(insights);
      });
      $(".cr-actions li").each(function () {
        let actions = $(this).text();
        crActions.push(actions);
      });

      let metrics = [metricHeaders, wtdMetrics, mtdMetrics];
      // generate auto table with report metrics
      doc.autoTable({
        body: metrics,
        startX: 20,
        startY: 45,
        theme: "grid",
      });

      // Insights
      let hasInsights = $(".cr-insights li").length;
      if (hasInsights > 0) {
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(12);
        doc.text(10, 80, "Insights");
        let cY = 80;
        doc.setFontSize(10);
        crInsights.map((entries) => {
          doc.text(13, (cY += 5), "\u2022 " + entries);
        });
      } else {
        doc.setTextColor(238, 168, 81);
        doc.setFontSize(12);
        doc.text(10, 80, "Hey dummy, you forgot to add insights...");
      }

      // Actions
      let currentY = hasInsights * 5 + 80;
      currentY = currentY + 10;
      let hasActions = $(".cr-actions li").length;
      if (hasActions > 0) {
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(12);
        doc.text(10, currentY, "Actions");
        let cY = currentY;
        doc.setFontSize(10);
        crActions.map((entries) => {
          doc.text(13, (cY += 5), "\u2022 " + entries);
        });
      } else {
        doc.setTextColor(238, 168, 81);
        doc.setFontSize(12);
        doc.text(10, 80, "Hey dummy, you forgot to add actions...");
      }

      // Save the PDF
      let pdfName = $(".filter.active a").text();
      doc.save(`${pdfName}.pdf`);
    });
  };

  // Save Report
  let saveReport = async () => {
    // Empty Vars
    var postID;

    // Data to Push
    const _reportData = {
      title: "",
      content: "",
      status: "publish",
      acf: {
        approval_type: cure.approval_type,
        client: cure.client,
        status: "Pending Approval",
        sent_by: cure.current_user_id,
      },
    };

    // Fetch Reports
    let fetchReports = async () => {
      const url = `${cure.root}/wp-json/wp/v2/reports`;
      let res = await fetch(url, {
        method: "POST",
        headers: {
          "X-WP-Nonce": cure.nonce,
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(_reportData),
      });
      return await res.json();
    };

    // Post Report
    let postReports = async () => {
      let pushReport = await fetchReports();
      // Attach View Status Link
      postID = pushReport.id;
      console.log("Report sent for approval =>", pushReport);
    };

    $(".cr-send-for-approval a").click(async function () {
      let insights = $(".cr-insights li").length;
      let actions = $(".cr-actions li").length;
      if (insights > 0 && actions > 0) {
        _reportData.title = postID;
        _reportData.content = $(".cure-report")[0].outerHTML;
        if (
          confirm(
            "Are you sure you want to send this in for approval? Make sure to doublecheck for careless mistakes and save others the hassle of having to correct you!"
          ) == true
        ) {
          postReports();
        }
      }
    });
  };

  singleClientReports();
  singleClientBreadcrumbs();
  reportTypeFilter();
  addInsights();
  addActions();
  modalSendReport();
  downloadPDF();
  saveReport();
});
