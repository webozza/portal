jQuery(document).ready(function ($) {
  let createNewChecklist = async () => {
    $(".new-checklist .modal-submit").click(function () {
      const clientSelected = $(".nc-select-client").find(":selected").val();
      const templateSelected = $(".nc-select-template").find(":selected").val();
      $('[name="client"]').val(clientSelected);
      $('[name="template"]').val(templateSelected);
      $(this).parent().parent().parent().find("form").submit();
    });
  };

  createNewChecklist();
});
