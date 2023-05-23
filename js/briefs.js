jQuery(document).ready(function ($) {
  // New Client Overview Submit
  $(".client-overview .modal-submit").click(function () {
    hasClientName = $('[name="co_client_name"]').val() !== "";
    if (hasClientName) {
      $(this).parent().parent().parent().find("form").submit();
    } else {
      $(this).parent().parent().parent().find("error-msg").show();
    }
  });
});
