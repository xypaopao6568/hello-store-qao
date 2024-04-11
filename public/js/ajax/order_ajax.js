function actionUpdateStatus(event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của sự kiện (nếu có)

    let status = $(this).data("status");
    let urlRequest = $(this).data("url");
    let button = $(this);

    Swal.fire({
        title: "Are you sure?",
        text: "You want to update the status?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                data: { status: status }, // Truyền trạng thái cần cập nhật
                success: function (data) {
                    if (data.code == 200) {
                        // Cập nhật nút và văn bản trạng thái
                        button
                            .closest(".dropdown")
                            .find("button")
                            .html(
                                data.new_status + '<span class="caret"></span>'
                            );
                        Swal.fire(
                            "Updated!",
                            "Status has been updated.",
                            "success"
                        );
                    }
                },
                error: function () {
                    console.log("Error");
                },
            });
        }
    });
}
