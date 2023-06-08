let setCureRole = async () => {
  let cureRole = $(".select-user-role").find(":selected").val();
  $('[name="cure_role"]').val(cureRole);
};

let constructUserModal = async () => {
  $(".select-user-role").select2();
  $(".cure-modal.new-user .modal-submit").click(async function () {
    await setCureRole();
    $(".cure-modal.new-user form").submit();
  });
};

constructUserModal();
