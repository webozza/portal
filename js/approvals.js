jQuery(document).ready(function ($) {
  let deleteReport = () => {
    var deleteID;

    let prepareDeleteReport = async () => {
      const url = `${cure.root}/wp-json/wp/v2/reports/${deleteID}`;
      let res = await fetch(url, {
        method: "DELETE",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
          "X-WP-Nonce": cure.nonce,
        },
      });
      return await res.json();
    };

    let deleteReport = async () => {
      let res = await prepareDeleteReport();
      console.log(res);
    };

    $("tr.approval-row.client-reports .approval-delete").click(function () {
      let rowParent = $(this).parent().parent().parent();
      let theApproval = rowParent.find(".the-approval").text();
      deleteID = rowParent.data("id");
      if (confirm(`Are you sure you want to delete ${theApproval}?`) == true) {
        deleteReport();
        rowParent.remove();
      }
    });
  };

  let deleteClientOverview = () => {
    var deleteID;

    let prepareDeleteClientOverview = async () => {
      const url = `${cure.root}/wp-json/wp/v2/client-overview/${deleteID}`;
      let res = await fetch(url, {
        method: "DELETE",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
          "X-WP-Nonce": cure.nonce,
        },
      });
      return await res.json();
    };

    let deleteClientOverview = async () => {
      let res = await prepareDeleteClientOverview();
      console.log(res);
    };

    $("tr.approval-row.client-overview .approval-delete").click(function () {
      let rowParent = $(this).parent().parent().parent();
      let theApproval = rowParent.find(".the-approval").text();
      deleteID = rowParent.data("id");
      if (confirm(`Are you sure you want to delete ${theApproval}?`) == true) {
        deleteClientOverview();
        rowParent.remove();
      }
    });
  };

  let deleteProjectBrief = () => {
    var deleteID;

    let prepareDeleteProjectBrief = async () => {
      const url = `${cure.root}/wp-json/wp/v2/project-brief/${deleteID}`;
      let res = await fetch(url, {
        method: "DELETE",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
          "X-WP-Nonce": cure.nonce,
        },
      });
      return await res.json();
    };

    let deleteBrief = async () => {
      let res = await prepareDeleteProjectBrief();
      console.log(res);
    };

    $("tr.approval-row.project-brief .approval-delete").click(function () {
      let rowParent = $(this).parent().parent().parent();
      let theApproval = rowParent.find(".the-approval").text();
      deleteID = rowParent.data("id");
      if (confirm(`Are you sure you want to delete ${theApproval}?`) == true) {
        deleteBrief();
        rowParent.remove();
      }
    });
  };

  deleteReport();
  deleteClientOverview();
  deleteProjectBrief();
});
