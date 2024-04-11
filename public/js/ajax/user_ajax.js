function actionDelete(event) {
    event.preventDefault(); // cắt load lại trang
    let urlRequest = $(this).data("url");
    let buttons = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                success: function (data) {
                    if (data.code == 200) {
                        buttons.parent().parent().remove(); //xóa phần tử HTML cha của phần tử mà biến buttons đang tham chiếu đến
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    }
                },
                error: function () {},
            });
        }
    });
}
$(function () {
    $(document).on("click", ".action_delete", actionDelete);
});
