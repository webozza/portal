let constructUserModal = async () => {
  $(".cure-modal.new-user .modal-submit").click(async function () {
    $(".cure-modal.new-user form").submit();
  });
};

let compareHoursPH = async (start_date, end_date) => {
  $(".user-management .cr-table tbody tr").each(function () {
    let thisUser = $(this);
    let thisUserID = thisUser.data("id");
    let thisUserID_PH = thisUser.data("id-ph");
    let thisUserTarget =
      thisUser.data("hours-per-day") * thisUser.data("days-per-week") * 60;
    //console.log(thisUserID, thisUserID_PH, thisUserTarget);

    let fetchUserTime = async () => {
      const url = `https://curecollective.proofhub.com/api/v3/alltime?user_id=${thisUserID_PH}&from_date=${start_date}&to_date=${end_date}`;
      let res = await fetch(url, {
        headers: {
          "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
        },
      });
      return await res.json();
    };
    let renderUserTime = async () => {
      let response = await fetchUserTime();

      let totalLoggedHours = 0;
      let totalLoggedMins = 0;
      let totalLoggedHoursArray = [];
      let totalLoggedMinsArray = [];

      response.map((entries) => {
        let logggedStatus = entries.status;

        // Logged Hours - TOTAL
        let loggedHours = entries.logged_hours;
        if (loggedHours == null) {
          loggedHours = 0;
        }
        totalLoggedHoursArray.push(loggedHours);

        let loggedMins = entries.logged_mins;
        totalLoggedMinsArray.push(loggedMins);
        // console.log(logggedStatus, loggedHours, loggedMins);
      });

      //console.log(totalLoggedHoursArray, totalLoggedMinsArray);

      totalLoggedHours = totalLoggedHoursArray.reduce((a, b) => a + b, 0);
      totalLoggedMins = totalLoggedMinsArray.reduce((a, b) => a + b, 0);
      //console.log(totalLoggedHours, totalLoggedMins);

      let totalTimeLogged =
        Number(totalLoggedHours * 60) + Number(totalLoggedMins);

      // Calculate the weektodate target (in mins)

      let thisUserHits = (totalTimeLogged / thisUserTarget) * 100;
      thisUser
        .find(".total-hours-hit > div > span")
        .text(`${thisUserHits.toFixed(2)}%`);

      // traffic lights
      if (thisUserHits < 80) {
        thisUser.find(".red").css("background-color", "#FF605C");
      } else if (thisUserHits >= 80 && thisUserHits <= 120) {
        thisUser.find(".green").css("background-color", "#00CA4E");
      }
    };
    renderUserTime();
  });
};

constructUserModal();
compareHoursPH(cure.dates.wtd_start, cure.dates.today); // pull week to date metrics

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
