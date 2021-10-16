function DeleteRowAndColsSpan() {
    $('th[colspan="2"],td[colspan="2"]').each(function () {
        $(this).after($(this).clone().removeAttr("colspan"));
        $(this).removeAttr("colspan");
    });
    $('th[rowspan="2"],td[rowspan="2"]').each(function () {
        $(this).parent().next().append($(this).clone().removeAttr("rowspan"));
        $(this).removeAttr("rowspan");
    });
}
function MakingRowAndColsSpanValueTDBased() {
    let ToRemove = [];
    let Colspans = [];
    let Rowspans = [];

    $("th").each(function () {
        let Value = $(this).text();

        if (
            $(this)
                .parent()
                .next()
                .find("th:eq(" + $(this).index() + ")")
                .text() == Value
        ) {
            ToRemove.push(
                $(this)
                    .parent()
                    .next()
                    .find("th:eq(" + $(this).index() + ")")
            );
            Rowspans.push($(this));
        }
        if ($(this).next().text() == Value) {
            // $(this).next().attr('colspan',2);
            Colspans.push($(this).next());
            ToRemove.push($(this));
        }
    });
    Rowspans.forEach(function (element) {
        element.attr("rowspan", 2);
    });
    Colspans.forEach(function (element) {
        element.attr("colspan", 2);
    });
    ToRemove.forEach(function (element) {
        element.remove();
    });
}
function transposeTable(){
    DeleteRowAndColsSpan();
    let HeadRows = $("#thetable thead tr").length;
    let BodyRows = $("#thetable tbody tr").length;
    let HeadCols = $("#thetable thead tr:eq(0) th").length;
    let $NewTable = $("<table></table>");

    $($NewTable).addClass("table  table-hover text-center table-bordered ");
    $($NewTable).attr("id", "NewTable");
    for (Row = 0; Row < HeadCols; Row++) {
      $NewRow = $("<tr></tr>");
      for (Col = 0; Col < HeadRows; Col++) {
        $NewTd = $(
          "#thetable thead tr:eq(" + Col + ") th:eq(" + Row + ")"
        ).clone();
        // $($NewTd).addClass('fixed-left');
        $($NewRow).append($NewTd);
      }
      for (Col = 0; Col < BodyRows; Col++) {
        if (Row == 0) {
          $NewTd = $(
            "#thetable tbody tr:eq(" + Col + ") th:eq(" + Row + ")"
          ).clone();
          // $($NewTd).addClass('fixed-left');
        } else {
          // Row=Row==1?Row-1:Row;
          $NewTd = $(
            "#thetable tbody tr:eq(" + Col + ") td:eq(" + (Row - 1) + ")"
          ).clone();
        }
        $($NewRow).append($NewTd);
      }
      $($NewTable).append($NewRow);
    }
    $("#TableTransposedArea").append($NewTable);
    $($NewTable).hide();
    MakingRowAndColsSpanValueTDBased();
}