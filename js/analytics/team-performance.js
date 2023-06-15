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
    let thisUserName = thisUser.find(".cure-user span").text();

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
      thisUserTarget =
        thisUserHoursPerDay *
        countCertainDays(
          workingDays,
          new Date(cure.dates.mtd_start),
          new Date(cure.dates.mtd_end)
        ) *
        60;
    } else if (time_frame == "custom") {
      thisUserTarget =
        thisUserHoursPerDay *
        countCertainDays(
          workingDays,
          new Date(start_date),
          new Date(end_date)
        ) *
        60;
    }

    //console.log(thisUserID, thisUserID_PH, thisUserTarget);
    let records = [
      0, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200,
    ];
    let fullRecord = [];
    let loop = "true";
    if (loop == "true") {
      records.map((entries) => {
        let fetchUserTime = async () => {
          const url = `https://curecollective.proofhub.com/api/v3/alltime?user_id=${thisUserID_PH}&from_date=${start_date}&to_date=${end_date}&start=${entries}&limit=100`;
          let res = await fetch(url, {
            headers: {
              "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
            },
          });
          return await res.json();
        };
        let renderUserTime = async () => {
          let response = await fetchUserTime();

          let runActions = async () => {
            //console.log(thisUserName, response);
            if (response.length == 0) {
              loop = "false";
            }

            if (response.length !== 0) {
              fullRecord.push(response);
            }

            let totalLoggedHours = 0;
            let totalLoggedMins = 0;
            let totalLoggedHoursArray = [];
            let totalLoggedMinsArray = [];

            fullRecord.map((entries) => {
              entries.map((entries) => {
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
                } else if (
                  time_status == "billable" &&
                  entries.status == "billable"
                ) {
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

            /*
              Red - more than 20% under billed
              Amber - 10% underbilled
              Green - on target or over by up to 20%
              Grey - more than 20% over
          */

            if (thisUserHits < 80) {
              // Red - more than 20% under billed
              thisUser.find(".user-status > div").hide();
              thisUser.find(".user-status .under").show();
              bgColor = "#FF605C";
            } else if (thisUserHits >= 80 && thisUserHits <= 120) {
              // Green - on target or over by up to 20%
              thisUser.find(".user-status > div").hide();
              thisUser.find(".user-status .on-target").show();
              bgColor = "#00CA4E";
            } else if (thisUserHits > 120) {
              // Grey - more than 20% over
              thisUser.find(".user-status > div").hide();
              thisUser.find(".user-status .over").show();
              bgColor = "#808080";
            }

            thisUser
              .find(".status-text")
              .attr(
                "style",
                `width: 12px;height: 12px;background-color: ${bgColor};border-radius: 50%;`
              );
            $(".data--loader").hide();
          };
          await runActions();
        };
        renderUserTime();
      });
    }

    console.log(thisUserName, fullRecord);
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
checkIDs();

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
