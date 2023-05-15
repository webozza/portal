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

  // Send Report
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

  singleClientReports();
  singleClientBreadcrumbs();
  reportTypeFilter();
  addInsights();
  addActions();
  modalSendReport();
  downloadPDF();
});
