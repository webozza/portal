// Remove empty paragraphs
let removeEmptyParas = () => {
  $(".report-header > p").remove();
  $(".single-reports .cure-report .inner > p").remove();
  $(".single-reports .cure-report .inner.active").removeClass("active");
  let initiatorLength = $(".edit-initiator").length;
  if (initiatorLength > 1) {
    $(".edit-initiator:not(:last-child)").remove();
  }
  $(".edit--report img").attr("src", `${tempDir}/img/icons/edit.png`);
  $(".edit-initiator br").remove();
  $("a.save--changes.btn-cure img").hide();
  $(".cr-insights-container li").attr("contenteditable", "false");
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

  $(".cr-send a").click(function () {
    let modalParent = $(this).parent().parent().parent();
    let ga_cost_wtd = $("tbody tr").eq(0).find("td").eq(1).text();
    let ga_cost_mtd = $("tbody tr").eq(1).find("td").eq(1).text();
    let visitors_wtd = $("tbody tr").eq(0).find("td").eq(2).text();
    let visitors_mtd = $("tbody tr").eq(1).find("td").eq(2).text();
    let conversion_rate_wtd = $("tbody tr").eq(0).find("td").eq(4).text();
    let conversion_rate_mtd = $("tbody tr").eq(1).find("td").eq(4).text();
    let enrolments_wtd = $("tbody tr").eq(0).find("td").eq(5).text();
    let enrolments_mtd = $("tbody tr").eq(1).find("td").eq(5).text();
    let cost_per_enrolments_wtd = $("tbody tr").eq(0).find("td").eq(6).text();
    let cost_per_enrolments_mtd = $("tbody tr").eq(1).find("td").eq(6).text();
    let sales_wtd = $("tbody tr").eq(0).find("td").eq(7).text();
    let sales_mtd = $("tbody tr").eq(1).find("td").eq(7).text();

    // Append the report ID
    $('[name="report_id"]').val(cure.report_id);

    // Append the metrics
    $('[name="ga_cost_wtd"]').val(ga_cost_wtd.replaceAll(/\s/g, ""));
    $('[name="ga_cost_mtd"]').val(ga_cost_mtd.replaceAll(/\s/g, ""));
    $('[name="visitors_wtd"]').val(visitors_wtd.replaceAll(/\s/g, ""));
    $('[name="visitors_mtd"]').val(visitors_mtd.replaceAll(/\s/g, ""));
    $('[name="conversion_rate_wtd"]').val(
      conversion_rate_wtd.replaceAll(/\s/g, "")
    );
    $('[name="conversion_rate_mtd"]').val(
      conversion_rate_mtd.replaceAll(/\s/g, "")
    );
    $('[name="enrolments_wtd"]').val(enrolments_wtd.replaceAll(/\s/g, ""));
    $('[name="enrolments_mtd"]').val(enrolments_mtd.replaceAll(/\s/g, ""));
    $('[name="cost_per_enrolments_wtd]').val(
      cost_per_enrolments_wtd.replaceAll(/\s/g, "")
    );
    $('[name="cost_per_enrolments_mtd"]').val(
      cost_per_enrolments_mtd.replaceAll(/\s/g, "")
    );
    $('[name="sales_wtd"]').val(sales_wtd.replaceAll(/\s/g, ""));
    $('[name="sales_mtd"]').val(sales_mtd.replaceAll(/\s/g, ""));

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
  });

  // Send Report
  $(".modal-submit").click(async function (e) {
    let modalParent = $(this).parent().parent().parent();
    let emailAddress = modalParent.find("form input[type='email']");
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

      // Submit the form
      $("#send_report").submit();
    }
  });

  // Dismiss success message
  $(".dismiss").click(function () {
    $(this).parent().parent().remove();
  });
};

// Save Changes after Edit Functionality
let saveChanges = () => {
  // Data to Push
  const _reportData = {
    content: "",
  };

  let fetchReport = async () => {
    const url = `${cure.root}/wp-json/wp/v2/reports/${cure.report_id}`;
    let res = await fetch(url, {
      method: "PUT",
      headers: {
        "X-WP-Nonce": cure.nonce,
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(_reportData),
    });
    return await res.json();
  };

  // Post Report
  let updateReport = async () => {
    let updateReport = await fetchReport();
    // Attach View Status Link
    console.log("Report updated =>", updateReport);
    $("a.save--changes.btn-cure img").hide();
    $(".single-reports .cure-report .inner.active .edit--report img").trigger(
      "click"
    );
  };

  $(".save--changes").click(async function () {
    $("a.save--changes.btn-cure img").show();
    _reportData.content = $(".cure-report")[0].outerHTML;
    updateReport();
  });
};

// Edit Functionality
let editReport = () => {
  let checkInitiator = $(".edit-initiator").length;
  if (checkInitiator == 0) {
    $(".cure-report .inner").append(`
        <div class="edit-initiator">
          <a class="edit--report" href="javascript:void(0)">
            <img src="${tempDir}/img/icons/edit.png">
          </a>
          <a class="save--changes btn-cure" href="javascript:void(0)">
            <img src="${tempDir}/img/live-update-loader.gif">
            SAVE CHANGES
          </a>
        </div>
      `);
  }

  $(".edit--report img").click(function () {
    // enable and disable the edit state
    $(".cure-report .inner").toggleClass("active");

    // disable edit state
    $(".cure-report .inner.active .edit--report img").attr(
      "src",
      `${tempDir}/img/icons/delete.png`
    );
    // enable save option
    $(".cure-report .inner.active .edit--report .save--changes")
      .show()
      .css("display", "flex");

    // enable edit state
    $(".cure-report .inner:not(.active) .edit--report img").attr(
      "src",
      `${tempDir}/img/icons/edit.png`
    );
    $(".cure-report .inner:not(.active) .edit--report .save--changes").hide();

    // add and remove the edit insights and actions icon
    $(
      ".cure-report .inner.active .cr-insights li, .cure-report .inner.active .cr-actions li"
    ).attr("contentEditable", "true");
    $(
      ".cure-report .inner:not('.active') .cr-insights li, .cure-report .inner:not('.active') .cr-actions li"
    ).attr("contentEditable", "false");
  });
};

// RUN THE INITIAL FUNCTIONS
downloadPDF();
removeEmptyParas();
modalSendReport();
editReport();
saveChanges();
