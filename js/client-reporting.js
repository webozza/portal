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
    $(".single-client-reporting .filters a").click(function () {
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

  singleClientReports();
  singleClientBreadcrumbs();
  reportTypeFilter();
  addInsights();
  addActions();
});
