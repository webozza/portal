jQuery(document).ready(function ($) {
  /* Fetch Projects */
  let fetchProjects = async () => {
    const url = `https://curecollective.proofhub.com/api/v3/projects`;
    let res = await fetch(url, {
      headers: {
        "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
      },
    });
    return await res.json();
  };

  let renderProjects = async () => {
    let response = await fetchProjects();
    $(".api-loader").fadeOut();
    console.log("All clients", response);

    for (const entry of response) {
      $(".client-performance tbody").append(`
        <tr data-project-id="${entry.id}">
            <td>
                <div class="client_name">
                    <div class="client-color" style="background-color:${entry.color}"></div>
                    <span>${entry.title}</span>
                </div>
            </td>
            <td class="target-hit"></td>
            <td></td>
            <td></td>
        </tr>
      `);
      await renderProjectTime(entry.id, entry.title);
    }
  };

  /* Fetch Project Time */
  let fetchProjectTime = async (project_id) => {
    const url = `https://curecollective.proofhub.com/api/v3/projects/${project_id}/timesheets`;
    let res = await fetch(url, {
      headers: {
        "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
      },
    });
    return await res.json();
  };

  let renderProjectTime = async (project_id, project_name) => {
    return new Promise((resolve) => {
      setTimeout(async () => {
        let response = await fetchProjectTime(project_id);
        $(".api-loader").fadeOut();
        console.log(project_name, response);

        let targetHitCell = $(
          `tr[data-project-id="${project_id}"] .target-hit`
        );
        let tableHtml = "";

        for (const projectTime of response) {
          const loggedMinutes =
            projectTime.logged_hours * 60 + projectTime.logged_mins;
          const estimatedMinutes =
            projectTime.estimated_hours * 60 + projectTime.estimated_mins;
          const percentage = (loggedMinutes / estimatedMinutes) * 100;

          tableHtml += `<p>${
            projectTime.title
          }: <span style="color:red">${percentage.toFixed(2)}%</span></p>`;
        }

        // Update the "Target Hit" cell content
        targetHitCell.html(tableHtml);

        resolve();
      }, 100); // Delay in milliseconds (adjust as needed)
    });
  };

  /* Run Functions */
  renderProjects();
});
