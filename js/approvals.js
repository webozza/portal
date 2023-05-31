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

  let filterUsers = async () => {
    let allUsers = [];
    $(".the-user").each(function () {
      let userName = $(this).text();
      allUsers.push(userName);
    });
    let uniqueUsers = [...new Set(allUsers)];
    uniqueUsers.map((entries) => {
      $(".f--user select").append(`
        <option>${entries}</option>
      `);
    });
  };

  let filterClients = async () => {
    let allClients = [];
    $(".the-client").each(function () {
      let clientName = $(this).text();
      allClients.push(clientName);
    });
    let uniqueClients = [...new Set(allClients)];
    uniqueClients.map((entries) => {
      $(".f--client select").append(`
        <option>${entries}</option>
      `);
    });
  };

  let filterTypes = async () => {
    let allTypes = [];
    $(".the-approval").each(function () {
      let typeName = $(this).text();
      allTypes.push(typeName);
    });
    let uniqueTypes = [...new Set(allTypes)];
    uniqueTypes.map((entries) => {
      $(".f--type select").append(`
        <option>${entries}</option>
      `);
    });
  };

  let runFilter = async () => {
    // Get the selected filter values
    let selectedUser = $(".f--user select").val();
    let selectedClient = $(".f--client select").val();
    let selectedStatus = $(".f--status select").val();
    let selectedType = $(".f--type select").val();

    // Iterate over each approval row
    $(".approval-row").each(function () {
      let $row = $(this);
      let rowUser = $row.find(".the-user").text();
      let rowClient = $row.find(".the-client").text();
      let rowStatus = $row.find(".the-status").text();
      let rowType = $row.find(".the-approval a").text();

      // Check if the row matches the selected filters
      let showRow =
        (selectedUser === "All Users" || rowUser === selectedUser) &&
        (selectedClient === "All Clients" || rowClient === selectedClient) &&
        (selectedStatus === "Status" || rowStatus === selectedStatus) &&
        (selectedType === "All Types" || rowType === selectedType);

      // Show or hide the row based on the result
      $row.toggle(showRow);
    });
  };

  $(".main.approvals .filters select").change(function () {
    runFilter();
  });

  deleteReport();
  deleteClientOverview();
  deleteProjectBrief();
  filterUsers();
  filterClients();
  filterTypes();
});
