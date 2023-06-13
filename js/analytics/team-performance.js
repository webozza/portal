let constructUserModal = async () => {
  let dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  $(".date-notice").text(dateRange);
  $(".cure-modal.new-user .modal-submit").click(async function () {
    $(".cure-modal.new-user form").submit();
  });
};

let countCertainDays = (days, d0, d1) => {
  var ndays = 1 + Math.round((d1 - d0) / (24 * 3600 * 1000));
  var sum = function (a, b) {
    return a + Math.floor((ndays + ((d0.getDay() + 6 - b) % 7)) / 7);
  };
  return days.reduce(sum, 0);
};

let compareHoursPH = async (start_date, end_date, time_frame, time_status) => {
  $(".user-management .cr-table tbody tr").each(function () {
    let thisUser = $(this);
    let thisUserID = thisUser.data("id");
    let thisUserID_PH = thisUser.data("id-ph");
    let thisUserHoursPerDay = thisUser.data("hours-per-day");
    let thisUserDaysPerWeek = thisUser.data("days-per-week");
    let thisUserDaysSelected = thisUser.data("days-selected");

    let workingDays = [];
    thisUserDaysSelected.map((entries) => {
      if (entries == "Monday") {
        workingDays.push(1);
      }
      if (entries == "Tuesday") {
        workingDays.push(2);
      }
      if (entries == "Wednesday") {
        workingDays.push(3);
      }
      if (entries == "Thursday") {
        workingDays.push(4);
      }
      if (entries == "Friday") {
        workingDays.push(5);
      }
    });

    let thisUserTarget;
    if (time_frame == "wtd") {
      thisUserTarget = thisUserHoursPerDay * thisUserDaysPerWeek * 60;
    } else if (time_frame == "mtd") {
      console.log(
        countCertainDays(
          workingDays,
          new Date(cure.dates.mtd_start),
          new Date(cure.dates.mtd_end)
        )
      );
      thisUserTarget =
        thisUserHoursPerDay *
        countCertainDays(
          workingDays,
          new Date(cure.dates.mtd_start),
          new Date(cure.dates.mtd_end)
        ) *
        60;
    }

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

        if (time_status == "all") {
          // Logged Hours - TOTAL
          let loggedHours = entries.logged_hours;
          if (loggedHours == null) {
            loggedHours = 0;
          }
          totalLoggedHoursArray.push(loggedHours);

          let loggedMins = entries.logged_mins;
          totalLoggedMinsArray.push(loggedMins);
          // console.log(logggedStatus, loggedHours, loggedMins);
        } else if (time_status == "billable" && entries.status == "billable") {
          // Logged Hours - TOTAL
          let loggedHours = entries.logged_hours;
          if (loggedHours == null) {
            loggedHours = 0;
          }
          totalLoggedHoursArray.push(loggedHours);

          let loggedMins = entries.logged_mins;
          totalLoggedMinsArray.push(loggedMins);
        } else if (
          time_status == "non-billable" &&
          entries.status == "non-billable"
        ) {
          // Logged Hours - TOTAL
          let loggedHours = entries.logged_hours;
          if (loggedHours == null) {
            loggedHours = 0;
          }
          totalLoggedHoursArray.push(loggedHours);

          let loggedMins = entries.logged_mins;
          totalLoggedMinsArray.push(loggedMins);
        }
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

// Filters users
let filterUsers = async () => {
  // append users to filter
  let allUsers = [];
  $(".cure-user").each(function () {
    let userName = $(this).find("span").text();
    allUsers.push(userName);
  });
  let uniqueUsers = [...new Set(allUsers)];
  uniqueUsers.map((entries) => {
    $(".f--user select").append(`
        <option>${entries}</option>
      `);
  });

  // run the filter
  $(".f--user select").change(function () {
    let selectedUser = $(this).find(":selected").val();
    $(".user-management tbody tr").each(function () {
      let thisRow = $(this);
      let rowUser = thisRow.find(".cure-user span").text();

      let showRow = selectedUser === "All Users" || rowUser === selectedUser;
      thisRow.toggle(showRow);
    });
  });
};

constructUserModal();
activeFilter();
compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "all"); // pull week to date metrics
filterUsers();

$(".filters .filter a").click(function () {
  let dateRange;
  $(".status-text > img").show();
  $(".user-status > div").hide();
  let filterClicked = $(this).text();
  if (filterClicked == "WTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "all");
    dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  } else if (filterClicked == "MTD") {
    compareHoursPH(cure.dates.mtd_start, cure.dates.today, "mtd", "all");
    dateRange = cureDateConverter(cure.dates.mtd_start, cure.dates.today);
  }
  $(".date-notice").text(dateRange);
});

let runFilter = () => {
  let getSelected = $(this).find(":selected").val();
  let dateRangeSelected = $(this).find(".filters .filter.active a").text();

  // filter type 1
  if (getSelected == "all" && dateRangeSelected == "WTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "all");
  } else if (getSelected == "all" && dateRangeSelected == "MTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "mtd", "all");
  } else if (getSelected == "all" && dateRangeSelected == "Custom") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "custom", "all");
  }

  // filter type 2
  if (getSelected == "billable" && dateRangeSelected == "WTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "billable");
  } else if (getSelected == "billable" && dateRangeSelected == "MTD") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "mtd", "billable");
  } else if (getSelected == "billable" && dateRangeSelected == "Custom") {
    compareHoursPH(
      cure.dates.wtd_start,
      cure.dates.today,
      "custom",
      "billable"
    );
  }

  // filter type 3
  if (getSelected == "non-billable" && dateRangeSelected == "WTD") {
    compareHoursPH(
      cure.dates.wtd_start,
      cure.dates.today,
      "wtd",
      "non-billable"
    );
  } else if (getSelected == "non-billable" && dateRangeSelected == "MTD") {
    compareHoursPH(
      cure.dates.wtd_start,
      cure.dates.today,
      "mtd",
      "non-billable"
    );
  } else if (getSelected == "non-billable" && dateRangeSelected == "Custom") {
    compareHoursPH(
      cure.dates.wtd_start,
      cure.dates.today,
      "custom",
      "non-billable"
    );
  }
};

// Filters for status
$(".f--status select").change(function () {
  runFilter();
});

$(".filter-date-range a").click(function () {
  runFilter();
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
