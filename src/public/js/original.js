var singleAnswer = document.getElementById("singleAnswer");
var multipleAnswer = document.getElementById("multipleAnswers");

function formSwitch() {
    check = document.getElementsByClassName("js-check");
    if (check[0].checked) {
        singleAnswer.style.display = "none";
        multipleAnswer.style.display = "none";
    } else if (check[1].checked) {
        singleAnswer.style.display = "block";
        multipleAnswer.style.display = "none";
    } else if (check[2].checked) {
        singleAnswer.style.display = "none";
        multipleAnswer.style.display = "block";
    } else {
        singleAnswer.style.display = "none";
        multipleAnswer.style.display = "none";
    }
}
window.addEventListener("load", formSwitch());

$(document).on("click", ".addSingleAnswer", function() {
    $("#inputSingleAnswer")
        .clone(true)
        .insertAfter($("#inputSingleAnswer"));
});
$(".deleteSingleAnswer").on("click", function() {
    if ($("#singleAnswer #inputSingleAnswer").length > 1) {
        $(this)
            .parent()
            .remove();
    }
});

$(document).on("click", ".addMultipleAnswer", function() {
    $("#inputMultipleAnswer")
        .clone(true)
        .insertAfter($("#inputMultipleAnswer"));
});
$(".deleteMultipleAnswer").on("click", function() {
    if ($("#multipleAnswers #inputMultipleAnswer").length > 1) {
        $(this)
            .parent()
            .remove();
    }
});
