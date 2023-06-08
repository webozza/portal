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
      confirm(`Are you sure you want to approve this client overview?`) == true
    ) {
      renderClientOverview();
    }
  });
};

let editClientOverview = () => {
  // Activate edit mode
  $(".co-edit a").click(function () {
    $(this).parent().toggleClass("active");
    if ($(this).parent().hasClass("active")) {
      $(".cod-data").attr("contenteditable", "true");
      $(".cod-footer").show();
    } else {
      $(".cod-data").attr("contenteditable", "false");
      $(".cod-footer").hide();
    }
  });
  // Display loader on save
  $(".save--changes").click(function () {
    $(this).find("img").show();
  });
};

let updateClientOverview = () => {
  // Data to Push
  const _clientOverviewData = {
    title: "",
    content: "",
    status: "publish",
    acf: {
      about_client: "",
      key_contacts: "",
      objectives: "",
      audience: "",
      opportunities: "",
      competitors: "",
    },
  };

  let fetchClientOverview = async () => {
    const url = `${cure.root}/wp-json/wp/v2/client-overview/${cure.client_overview_id}`;
    let res = await fetch(url, {
      method: "PUT",
      headers: {
        "X-WP-Nonce": cure.nonce,
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(_clientOverviewData),
    });
    return await res.json();
  };

  // Post brief
  let postClientOverview = async () => {
    let response = await fetchClientOverview();
    // Attach View Status Link
    console.log("brief updated =>", response);
    $(".save--changes img").hide();
    $(".co-edit a").trigger("click");
  };

  $(".save--changes").click(async function () {
    _clientOverviewData.acf.about_client = $(
      ".cod-data.about-the-client"
    ).html();
    _clientOverviewData.acf.key_contacts = $(".cod-data.key-contact").html();
    _clientOverviewData.acf.objectives = $(".cod-data.objectives").html();
    _clientOverviewData.acf.audience = $(".cod-data.audience").html();
    _clientOverviewData.acf.opportunities = $(".cod-data.opportunities").html();
    _clientOverviewData.acf.competitors = $(".cod-data.competitors").html();
    postClientOverview();
  });
};

// runt the functions
approveClientOverview();
editClientOverview();
updateClientOverview();
