jQuery(document).ready(function ($) {
  let createNewGuide = () => {
    $(".cure-modal.new-guide .modal-submit").click(function () {
      $(this).parent().parent().parent().find("form").submit();
    });
  };

  let postNewGuide = async () => {
    const _GuideData = {
      title: $('[name="guide_title"]').val(),
      content: "",
      status: "publish",
      acf: {
        status: "Pending Approval",
      },
    };

    let fetchGuide = async () => {
      const url = `${cure.root}/wp-json/wp/v2/info-centre`;
      let res = await fetch(url, {
        method: "POST",
        headers: {
          "X-WP-Nonce": cure.nonce,
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(_GuideData),
      });
      return await res.json();
    };

    let renderGuide = async () => {
      let data = await fetchGuide();
      console.log("Guide data saved =>", data);
    };

    $(".btn-guide-publish").click(function () {
      _GuideData.content = tinymce.get("guide_content").getContent();
      if (confirm(`Are you sure you sent this for approval?`) == true) {
        renderGuide();
        $(".guideline-success").fadeIn().css("display", "flex");
      }
    });
  };

  let curLoc = window.location.href;

  if (curLoc.indexOf("?guide_title") > -1) {
    postNewGuide();
  } else {
    createNewGuide();
  }
});
