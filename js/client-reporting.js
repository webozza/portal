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
      if (cure.approval_type !== "Monthly Report") {
        $(".report-body tbody tr:first-child td").each(function () {
          let wtdMets = $(this).text();
          wtdMetrics.push(wtdMets);
        });
      }

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

      let metrics = [];
      if (cure.approval_type !== "Monthly Report") {
        metrics = [metricHeaders, wtdMetrics, mtdMetrics];
      } else {
        metrics = [metricHeaders, mtdMetrics];
      }
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

  // Date Filter on Client Reporting Overview
  let croDateFilter = () => {
    // If custom date is defined
    if (dates.cds_start !== undefined) {
      $(".client-reporting-overview .date-notice").text(
        `${dates.cds_start} -- ${dates.cds_end}`
      );
    } else {
      $(".client-reporting-overview .date-notice").text(
        `${dates.wtd_first_day} — ${dates.today}`
      );
    }

    // A Filter gets clicked
    $(".client-reporting-overview .filter a").click(function () {
      // Active
      let thisFilter = $(this);
      $(".client-reporting-overview .filter").removeClass("active");
      thisFilter.parent().addClass("active");

      // Filter the data by wtd and mtd
      let presetDateSelected = $(this).text();

      // Just the Date Filter
      if (presetDateSelected == "WTD") {
        $(".client-reporting-overview .date-notice").text(
          `${dates.wtd_first_day} — ${dates.today}`
        );
      } else if (presetDateSelected == "MTD") {
        $(".client-reporting-overview .date-notice").text(
          `${dates.mtd_first_day} — ${dates.today}`
        );
      } else if (presetDateSelected == "Custom") {
        $(".custom-date-selector").fadeToggle().css("display", "flex");
      }

      // If other than Custom filter is selected
      if (!$(this).hasClass("cds-filter")) {
        $(".custom-date-selector").hide();
      }
    });

    // If cancel button is clicked on custom date filter
    $(".cds-btn-cancel").click(function () {
      $(".custom-date-selector").hide();
    });

    // Whenever the from date is changed
    $('[name="cds_from"]').change(function () {
      let thisDate = $(this);
      let cdsFrom = thisDate.val();
      let getDay = cdsFrom.slice(8);
      let getMonth = cdsFrom.slice(5, -3);
      let getYear = cdsFrom.slice(0, 4);
      let newDate = `${getYear}-${getMonth}-${getDay}`;

      $('form [name="start_date"]').val(newDate);
    });

    // Whenever the to/end date is changed
    $('[name="cds_to"]').change(function () {
      let thisDate = $(this);
      let cdsFrom = thisDate.val();
      let getDay = cdsFrom.slice(8);
      let getMonth = cdsFrom.slice(5, -3);
      let getYear = cdsFrom.slice(0, 4);
      let newDate = `${getYear}-${getMonth}-${getDay}`;
      $('form [name="end_date"]').val(newDate);

      // Project & Date Filter
      $(".client-reporting-overview .cure--project").each(function () {
        let thisProject = $(this);
        let client = thisProject.find("span").text();
        let ad_spend = thisProject.parent().parent().find(".td-ad-spend");
        let visitors = thisProject.parent().parent().find(".td-new-users");
        if (presetDateSelected == "WTD" && client == "Diabetes Qualified") {
          // WTD & DQ
          ad_spend.text(metricsByClient.diabetes_qualified.ad_spend_wtd);
          visitors.text(metricsByClient.diabetes_qualified.new_users_wtd);
        } else if (
          presetDateSelected == "MTD" &&
          client == "Diabetes Qualified"
        ) {
          // MTD & DQ
          ad_spend.text(metricsByClient.diabetes_qualified.ad_spend_mtd);
          visitors.text(metricsByClient.diabetes_qualified.new_users_mtd);
        }
      });
    });

    // Apply the custom date filter
    $(".cds-btn-submit").click(function () {
      let startDate = $('form [name="start_date"]').val();
      let endDate = $('form [name="end_date"]').val();

      let newStartDate = new Date(startDate);
      let newEndDate = new Date(endDate);

      if (startDate !== "" && endDate !== "" && newStartDate <= newEndDate) {
        $("#custom_date_filter").submit();
      }

      if (newStartDate > newEndDate) {
        $(".cds-error p").text(
          "Get some coffee! END date can't be lesser than START date!"
        );
      }

      if (startDate == "" || endDate == "") {
        $(".cds-error p").text("WOW! Empty dates ehh??");
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
  croDateFilter();
});
