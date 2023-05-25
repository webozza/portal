jQuery(document).ready(function ($) {
  let _updateApproval = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      status: "Approved",
    },
  };
  let approveClientOverview = () => {
    let fetchClientOverview = async () => {
      const url = `${cure.root}/wp-json/wp/v2/client-overview/${cure.client_overview_id}`;
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
    let renderClientOverview = async () => {
      let response = await fetchClientOverview();
      console.log("Approved this client overview =>", response);
      window.location.href = `${cure.root}/approvals`;
    };
    $(".cr-approve a").click(function () {
      if (
        confirm(`Are you sure you want to approve this client overview?`) ==
        true
      ) {
        renderClientOverview();
      }
    });
  };

  // runt the functions
  approveClientOverview();
});
