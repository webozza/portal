jQuery(document).ready(function ($) {
  let _updateApproval = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      status: "Approved",
    },
  };
  let approveProjectBrief = () => {
    let fetchProjectBrief = async () => {
      const url = `${cure.root}/wp-json/wp/v2/project-brief/${cure.brief_id}`;
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
    let renderProjectBrief = async () => {
      let response = await fetchProjectBrief();
      console.log("Approved this project brief =>", response);
      window.location.href = `${cure.root}/approvals`;
    };
    $(".cr-approve a").click(function () {
      if (
        confirm(`Are you sure you want to approve this client overview?`) ==
        true
      ) {
        renderProjectBrief();
      }
    });
  };

  // runt the functions
  approveProjectBrief();
});
