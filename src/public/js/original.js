var i = 1;

$("#addMenu").on("click", function() {
    var clone = $("#menus").clone(true);
    var pulldown = clone.children("#menu");
    pulldown.attr("name", "menus[" + i + "]");
    clone.insertBefore($("#addMenu"));
    i++;
});
$(".deleteMenu").on("click", function() {
    if ($("#menus #menu").length > 1) {
        $(this)
            .parent()
            .remove();
    }
});

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
    var clone = $("#inputSingleAnswer").clone(true);
    var input = clone.children(".q_option");
    input.attr("name", "singleAnswers[" + i + "]");
    input.val("");
    clone.insertBefore($("#addSingle"));
    i++;
});
$(".deleteSingleAnswer").on("click", function() {
    if ($("#singleAnswer #inputSingleAnswer").length > 1) {
        $(this)
            .parent()
            .remove();
    }
});

$(document).on("click", ".addMultipleAnswer", function() {
    var clone = $("#inputMultipleAnswer").clone(true);
    var input = clone.children(".q_option");
    input.attr("name", "multipleAnswers[" + i + "]");
    input.val("");
    clone.insertBefore($("#addMultiple"));
    i++;
});
$(".deleteMultipleAnswer").on("click", function() {
    if ($("#multipleAnswers #inputMultipleAnswer").length > 1) {
        $(this)
            .parent()
            .remove();
    }
});
