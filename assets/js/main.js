$(".panel-item").hover(function() {
    $(this).css("background", "#0066bd");
}, function() {
    $(this).css("background", "#004682");
});

$(".law-item").click(function() {
    $.post( "laws.php", { type: "editlaw", lawid: $(this).attr("data-lawid") } );
});

$(".report-law-item-tab").click(function() {
    var id = $(this).find(".lawlist-id").val();
    var lawtitle = $(this).find(".lawlist-title").html();
    var fine = $(this).find(".fine-amount").html();
    var months = $(this).find(".months-amount").html();
    var description = $(this).attr("title");
    $(".added-laws").append('<div class="report-law-item" data-toggle="tooltip" data-html="true" title="'+description+'"><input type="hidden" class="lawlist-id" value="'+id+'"><h5 class="lawlist-title">'+lawtitle+'</h5><p class="lawlist-fine">Boete: €<span class="fine-amount">'+fine+'</span></p><p class="lawlist-months">Cel: <span class="months-amount">'+months+'</span> maanden</p></div>')
    CalculatePunishment()
    $(".report-law-item").click(function() {
        $(this).remove();
        CalculatePunishment()
    });

});

$(".report-law-item").click(function() {
    $(this).remove();
    CalculatePunishment()
});

$("#togglelaws").click(function() {
    if ($(".laws").css("display") == "none") {
        $(".laws").css("display", "block");
    } else {
        $(".laws").css("display", "none");
    }
    CalculatePunishment()
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

function CalculatePunishment() {
    var totalFine = 0;
    var totalMonths = 0;
    var punishmentValue = "";
    $(".report-law-item").each(function( index ) {
        var fine = $(this).find(".fine-amount").html();
        var months = $(this).find(".months-amount").html();
        var id = $(this).find(".lawlist-id").val();
        totalFine += parseInt(fine);
        totalMonths += parseInt(months);
        punishmentValue =  punishmentValue + "," + id;
    });
    $(".total-punishment").html("Totaal: €"+totalFine+" - "+totalMonths+" maanden")
    $(".report-law-punishments").val(punishmentValue);
}


$('.lawsearch').keyup(function(){
    // get the category from the attribute
    var filterVal = $(this).val().toLowerCase();
    $(".report-law-item-tab").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(filterVal) > -1)
    });

    $(".law-item").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(filterVal) > -1)
    });
});


// the selector will match all input controls of type :checkbox
// and attach a click event handler 
$("input:checkbox").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
      // the name of the box is retrieved using the .attr() method
      // as it is assumed and expected to be immutable
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      // the checked state of the group/box on the other hand will change
      // and the current value is retrieved using .prop() method
      $(group).prop("checked", false);
      $box.prop("checked", true);
    } else {
      $box.prop("checked", false);
    }
  });