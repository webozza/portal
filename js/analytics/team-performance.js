let constructUserModal = async () => {
  let dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  $(".date-notice").text(dateRange);
  $(".cure-modal.new-user .modal-submit").click(async function () {
    $(".cure-modal.new-user form").submit();
  });
};

let compareHoursPH = async (start_date, end_date) => {
  $(".user-management .cr-table tbody tr").each(function () {
    let thisUser = $(this);
    let thisUserID = thisUser.data("id");
    let thisUserID_PH = thisUser.data("id-ph");
    let thisUserHoursPerDay = thisUser.data("hours-per-day");
    let thisUserDaysPerWeek = thisUser.data("days-per-week");
    let thisUserTarget = thisUserHoursPerDay * thisUserDaysPerWeek * 60;
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
        .find(".total-hours-hit > div > .percentage-hit")
        .text(`${thisUserHits.toFixed(2)}%`);

      // traffic lights
      thisUser.find(".total-hours-hit meter").val(thisUserHits);
      $(".status-text > img").hide();
      let bgColor;

      if (thisUserHits < 80) {
        thisUser.find(".user-status .under").show();
        bgColor = "#FF605C";
      } else if (thisUserHits >= 80 && thisUserHits <= 100) {
        thisUser.find(".user-status .on-target").show();
        bgColor = "#00CA4E";
      } else if (thisUserHits > 100) {
        thisUser.find(".user-status .over").show();
        bgColor = "green";
      }

      $(".status-text").attr(
        "style",
        `width: 12px;height: 12px;background-color: ${bgColor};border-radius: 50%;`
      );
    };
    renderUserTime();
  });
};

constructUserModal();
activeFilter();
compareHoursPH(cure.dates.wtd_start, cure.dates.today); // pull week to date metrics
$(".filters .filter a").click(function () {
  let dateRange;
  $(".status-text > img").show();
  $(".user-status > div").hide();
  let filterClicked = $(this).text();
  if (filterClicked == "WTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today);
    dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  } else if (filterClicked == "MTD") {
    compareHoursPH(cure.dates.mtd_start, cure.dates.today);
    dateRange = cureDateConverter(cure.dates.mtd_start, cure.dates.today);
  }
  $(".date-notice").text(dateRange);
});

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
