jQuery(document).ready(function ($) {
  /* Fetch Clients
------------------------------------------------------------------------*/
  let fetchClients = async () => {
    const url = `https://curecollective.proofhub.com/api/v3/projects`;
    let res = await fetch(url, {
      headers: {
        "X-API-KEY": "bb7f3dfb14212df54449865a85627cb8ab207c6b",
      },
    });
    return await res.json();
  };
  let renderClients = async () => {
    let response = await fetchClients();
    $(".api-loader").fadeOut();
    console.log("All clients", response);
    response.map((entries) => {
      $(".client-performance tbody").append(`
        <tr data-id="${entries.id}">
            <td>
                <div class="client_name">
                    <div class="client-color" style="background-color:${entries.color}"></div>
                    <span>${entries.title}</span>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
      `);
    });
  };
  renderClients();
});
