jQuery(document).ready(function ($) {
  let createNewGuide = () => {
    $(".cure-modal.new-guide .modal-submit").click(function () {
      $(this).parent().parent().parent().find("form").submit();
    });
  };
  createNewGuide();
});
