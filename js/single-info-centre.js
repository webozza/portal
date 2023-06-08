let approveGuide = async () => {
  const _updateGuide = {
    title: $(".cod-header h2").text(),
    content: $(".cod-body").html(),
    status: "publish",
    acf: {
      status: "Approved",
    },
  };

  let fetchGuide = async () => {
    const url = `/wp-json/wp/v2/info-centre/${cure.guide_id}`;
    let res = await fetch(url, {
      method: "POST",
      headers: {
        "X-WP-Nonce": cure.nonce,
        "Content-Type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(_updateGuide),
    });
    return await res.json();
  };

  let renderUpdate = async () => {
    let response = await fetchGuide();
    console.log("Guide Approved => ", response);
    window.location.href = `${cure.root}/approvals`;
  };

  renderUpdate();
};

$(".main.single-guide .cr-approve a").click(async function () {
  if (confirm(`Are you sure you want to approve this guide?`) == true) {
    await approveGuide();
  }
});
