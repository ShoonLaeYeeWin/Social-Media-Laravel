$(document).ready(function () {
    $(".auth-login").on("click", function () {
        $(".modal").css("display", "block");
    });
});

$(document).ready(function (e) {
    $("#image").change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("#preview-image").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
    $(".fa-xmark").on("click", function () {
        $(".alert").hide();
    });
});

$(document).ready(function () {
    $("#searchName").on("input", function () {
        if ($(this).val().length > 0) {
            $("#searchBtn").show();
            $("#cancelBtn").hide();
        } else {
            $("#searchBtn").hide();
            $("#cancelBtn").show();
        }
    });
    $("#searchEmail").on("input", function () {
        if ($(this).val().length > 0) {
            $("#searchBtn").show();
            $("#cancelBtn").hide();
        } else {
            $("#searchBtn").hide();
            $("#cancelBtn").show();
        }
    });
    $("#searchSelect").on("input", function () {
        if ($(this).val().length > 0) {
            $("#searchBtn").show();
            $("#cancelBtn").hide();
        } else {
            $("#searchBtn").hide();
            $("#cancelBtn").show();
        }
    });
});
