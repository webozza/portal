jQuery(document).ready(function ($) {
  let deleteApprovals = () => {
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

  deleteApprovals();
});
