let constructUserModal = async () => {
  $(".cure-modal.new-user .modal-submit").click(async function () {
    $(".cure-modal.new-user form").submit();
  });

  // Working Days Added
  $(".days-of-the-week > div").click(async function () {
    let daysAdded = [];
    $(this).toggleClass("active");
    let daysCount = $(".days-of-the-week > div.active").length;
    $('[name="working_days_per_week"]').val(daysCount);

    $(".days-of-the-week > div.active").each(function () {
      let getFullDay = $(this).data("day");
      daysAdded.push(getFullDay);
    });

    $('[name="working_days_selected"]').val(JSON.stringify(daysAdded));
  });
};

constructUserModal();

// CHECKING USER IDS ON PH
let fetchPeople = async () => {
  const url = `https://curecollective.proofhub.com/api/v3/people`;
  let res = await fetch(url, {
    headers: {
      "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
    },
  });
  return await res.json();
};
let checkIDs = async () => {
  let response = await fetchPeople();
  console.log(response);
  response.map((entries) => {
    $(`.user-management .cr-table tbody tr[data-id-ph="${entries.id}"]`)
      .find(".cure-user img")
      .attr("src", entries.image_url);
  });
};
checkIDs();
