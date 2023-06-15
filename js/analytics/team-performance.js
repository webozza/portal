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
  const users = $(".user-management .cr-table tbody tr");
  const workingDaysMap = {
    Monday: 1,
    Tuesday: 2,
    Wednesday: 3,
    Thursday: 4,
    Friday: 5,
  };

  const fetchUserTime = async (userID_PH, entries) => {
    const url = `https://curecollective.proofhub.com/api/v3/alltime?user_id=${userID_PH}&from_date=${start_date}&to_date=${end_date}&start=${entries}&limit=100`;
    const res = await fetch(url, {
      headers: {
        "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
      },
    });
    return res.json();
  };

  const processUserTime = async (user) => {
    const userID = user.data("id");
    const userID_PH = user.data("id-ph");
    const userHoursPerDay = user.data("hours-per-day");
    const userDaysPerWeek = user.data("days-per-week");
    const userDaysSelected = user.data("days-selected");
    const userName = user.find(".cure-user span").text();

    const workingDays = userDaysSelected.map((day) => workingDaysMap[day]);

    let userTarget;
    if (time_frame === "wtd") {
      userTarget = userHoursPerDay * userDaysPerWeek * 60;
    } else if (time_frame === "mtd") {
      userTarget =
        userHoursPerDay *
        countCertainDays(
          workingDays,
          new Date(cure.dates.mtd_start),
          new Date(cure.dates.mtd_end)
        ) *
        60;
    } else if (time_frame === "custom") {
      userTarget =
        userHoursPerDay *
        countCertainDays(
          workingDays,
          new Date(start_date),
          new Date(end_date)
        ) *
        60;
    }

    const records = [
      0, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200,
    ];

    const fetchUserTimePromises = records.map((entries) =>
      fetchUserTime(userID_PH, entries)
    );
    const responses = await Promise.all(fetchUserTimePromises);

    let fullRecord = [];
    let totalLoggedHours = 0;
    let totalLoggedMins = 0;

    responses.forEach((response) => {
      if (response.length !== 0) {
        fullRecord.push(response);
      }
    });

    fullRecord.forEach((entries) => {
      entries.forEach((entry) => {
        if (
          time_status === "all" ||
          (time_status === "billable" && entry.status === "billable") ||
          (time_status === "non-billable" && entry.status === "non-billable")
        ) {
          let loggedHours = entry.logged_hours || 0;
          let loggedMins = entry.logged_mins || 0;
          totalLoggedHours += loggedHours;
          totalLoggedMins += loggedMins;
        }
      });
    });

    let totalTimeLogged = totalLoggedHours * 60 + totalLoggedMins;
    let userHits = (totalTimeLogged / userTarget) * 100;
    user
      .find(".total-hours-hit > div > .percentage-hit")
      .text(`${userHits.toFixed(2)}%`);

    user.find(".total-hours-hit meter").val(userHits);
    $(".status-text > img").hide();
    let bgColor;

    if (userHits < 80) {
      user.find(".user-status > div").hide();
      user.find(".user-status .under").show();
      bgColor = "#FF605C";
    } else if (userHits >= 80 && userHits <= 120) {
      user.find(".user-status > div").hide();
      user.find(".user-status .on-target").show();
      bgColor = "#00CA4E";
    } else if (userHits > 120) {
      user.find(".user-status > div").hide();
      user.find(".user-status .over").show();
      bgColor = "#808080";
    }

    user
      .find(".status-text")
      .attr(
        "style",
        `width: 12px;height: 12px;background-color: ${bgColor};border-radius: 50%;`
      );

    $(".data--loader").hide();
  };

  const fetchUserTimePromises = users.map(function () {
    return processUserTime($(this));
  });

  await Promise.all(fetchUserTimePromises);
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
  let statusSelected = $(".f--status select").find(":selected").val();
  let dateRange;

  if ($(this).text() !== "Custom") {
    $(".status-text > img").show();
    $(".user-status > div").hide();
  }

  let filterClicked = $(this).text();

  if (filterClicked !== "Custom") {
    $(".data--loader").show();
  }

  // WTD + VARIABLES
  if (filterClicked == "WTD" && statusSelected == "all") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "all");
    dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  } else if (filterClicked == "WTD" && statusSelected == "billable") {
    compareHoursPH(cure.dates.wtd_start, cure.dates.today, "wtd", "billable");
    dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  } else if (filterClicked == "WTD" && statusSelected == "non-billable") {
    compareHoursPH(
      cure.dates.wtd_start,
      cure.dates.today,
      "wtd",
      "non-billable"
    );
    dateRange = cureDateConverter(cure.dates.wtd_start, cure.dates.today);
  }

  // MTD + VARIABLES
  if (filterClicked == "MTD" && statusSelected == "all") {
    compareHoursPH(cure.dates.mtd_start, cure.dates.today, "mtd", "all");
    dateRange = cureDateConverter(cure.dates.mtd_start, cure.dates.today);
  } else if (filterClicked == "MTD" && statusSelected == "billable") {
    compareHoursPH(cure.dates.mtd_start, cure.dates.today, "mtd", "billable");
    dateRange = cureDateConverter(cure.dates.mtd_start, cure.dates.today);
  } else if (filterClicked == "MTD" && statusSelected == "non-billable") {
    compareHoursPH(
      cure.dates.mtd_start,
      cure.dates.today,
      "mtd",
      "non-billable"
    );
    dateRange = cureDateConverter(cure.dates.mtd_start, cure.dates.today);
  }

  // Custom + VARIABLES
  if (filterClicked == "Custom") {
    $(".custom-date-selector").fadeToggle().css("display", "flex");
  }

  // If other than Custom filter is selected
  if (!$(this).hasClass("cds-filter")) {
    $(".custom-date-selector").hide();
  }

  // If cancel button is clicked on custom date filter
  $(".cds-btn-cancel").click(function () {
    $(".custom-date-selector").hide();
  });

  $(".date-notice").text(dateRange);
});

// Filters for status
$(".f--status select").change(async function () {
  $(".filter.filter-date-range.active a").trigger("click");
  let cdsFrom = $('[name="cds_from"]').val();
  let cdsTo = $('[name="cds_to"]').val();
  if ($(".filter-cds").hasClass("active") && cdsFrom !== "" && cdsTo !== "") {
    $(".cds-btn-submit").trigger("click");
  }
});

// Custom date range filter
$(".cds-btn-submit").click(function () {
  $(".data--loader").show();
  let fromDate = $('[name="cds_from"]').val();
  let toDate = $('[name="cds_to"]').val();
  let statusSelected = $(".f--status select").find(":selected").val();
  let dateNotice = cureDateConverter(fromDate, toDate);
  $(".custom-date-selector").fadeOut();

  // RUN hours
  compareHoursPH(fromDate, toDate, "custom", statusSelected);
  $(".date-notice").text(dateNotice);
});

/* ADD USER PROFILE IMAGE FROM PROOFHUB
------------------------------------------------------------------------*/
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
  console.log("All users", response);
  response.map((entries) => {
    $(`.user-management .cr-table tbody tr[data-id-ph="${entries.id}"]`)
      .find(".cure-user img")
      .attr("src", entries.image_url);
  });
};
setTimeout(() => {
  checkIDs();
}, 600);

/* EXPERIMENTS
------------------------------------------------------------------------*/
// let records = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
// let chunks = "true";

// records.map((entries) => {
//   let checkUserTime = async () => {
//     const url = `https://curecollective.proofhub.com/api/v3/alltime?user_id=10243611582&from_date=2023-04-01&to_date=2023-06-12&start=${entries}&limit=100`;
//     let res = await fetch(url, {
//       headers: {
//         "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
//       },
//     });
//     return await res.json();
//   };

//   let renderCheckTime = async () => {
//     let response = await checkUserTime();
//     if (response.length == 0) {
//       chunks = "false";
//     }
//     if (chunks == "true") {
//       setTimeout(() => {
//         console.log("check rony's time =>", response.length);
//       }, entries);
//     }
//   };

//   renderCheckTime();
// });
