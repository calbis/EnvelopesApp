$(document).ready(function () {

    $(".editControlSwitch").click(function () {
        $(".editControls").toggleClass("hiddenEditControls");
    });

    $(".datePicker").datepicker();

    /*Envelopes/Index*/
    $(".filterMe-txt").keyup(function () {
        Filter(this);
    });

    function Filter(id) {
        var title = $(id).attr("title");
        var find = $(id).val();

        if (find.length > 0) {
            $("." + title + ":not(:Contains('" + find + "'))").addClass("hideRow");
            $("." + title + ":Contains('" + find + "')").removeClass("hideRow");

            $("tr > td.hideRow").parent().addClass("hiddenRow");
            $("tr > td:not(.hideRow)").parent().removeClass("hiddenRow");
        }
        else {
            $("." + title).removeClass("hideRow");
        }

        $("tr").each(function () {
            if ($(this).find("td.hideRow").size() > 0) {
                $(this).addClass("hiddenRow").hide();
            }
            else {
                $(this).removeClass("hiddenRow").show();
            }
        });
    }

    jQuery.expr[':'].Contains = function (a, i, m) {
        return jQuery(a).text().toUpperCase()
        .indexOf(m[3].toUpperCase()) >= 0;
    };
    /*Wnd Envelopes/Index*/

    /*Transactions/index*/
    $(".aMovePendingForEnvelope").click(function () {
        if (confirm("This will move pending for every transaction in this envelope")) {
            return true;
        }
        else {
            event.preventDefault;
            return false;
        }
    });
    /*End Transactions/index*/

    /*Filter*/
    $("#divFilterTransactions").click(function () {
        $("#divSearchContainer").fadeToggle();
    });
    /*End Filter*/

    /*Dialog*/
    $(".showDialog").click(function () {
        if ($("body").hasClass("wide")) {
            var title = $(this).attr("title");
            event.preventDefault();
            $.get($(this).attr("href"), function (data) {
                ShowDialog(title, data);
            })
            .fail(function () {
                $(this).click();
            });

        }
    });

    function ShowDialog(title, data) {
        $("#dialog").attr("title", title);
        $("#dialog").html(data);
        $("#dialog").dialog({
            width: 'auto'
        });
        $(".datePicker").datepicker();
    }
    /*END Dialog*/

    /*Width based classes*/
    function adjustStyle(width) {
        $("body").removeClass("phone");
        $("body").removeClass("tablet");
        $("body").removeClass("medium");
        $("body").removeClass("wide");

        width = parseInt(width);
        if (width < 600) {
            $("body").addClass("phone");
        }
        else if (width < 900) {
            $("body").addClass("tablet");
        }
        else if (width < 1200) {
            $("body").addClass("medium");
        }
        else {
            $("body").addClass("wide");
        }
    }

    $(function () {
        adjustStyle($(this).width());
        $(window).resize(function () {
            adjustStyle($(this).width());
        });
    });
    /*END Width Based Classes*/

    /*Quick Links*/
    $(".liShowEnvelopes").click(function () {
        $(this).nextAll().slideDown();
        $(this).slideUp();
    });
    /*END Quick Links*/


    /*Add Paycheck Screen*/
    $(".txtAddPaycheckAmount").keyup(function () {
        AddPaycheck_UpdateRemainingAmount();
    });
    $(".txtAddPaycheckPending").keyup(function () {
        AddPaycheck_UpdateRemainingAmount();
    });

    function AddPaycheck_UpdateRemainingAmount() {
        var amount = 0.00;
        var pending = 0.00;

        $(".txtAddPaycheckAmount").each(function () {
            if (this.value.length > 0) {
                amount = amount + Math.round(parseFloat(this.value) * 100) / 100;
            }
        });

        $(".txtAddPaycheckPending").each(function () {
            if (this.value.length > 0) {
                pending = pending + Math.round(parseFloat(this.value) * 100) / 100;
            }
        });

        var deposit = Math.round(parseFloat($("#txtDepositAmount").val()) * 100) / 100;

        $(".divAddPaycheckRemaining").html(Math.round((deposit - amount - pending) * 100) / 100);
    }
    /*END Add Paycheck Screen*/


    /*Context Menu*/
    function ContextMenuAction(action, id, useDialog) {
        var href = "/Transactions/" + action + "?id=" + id;

        if ($("body").hasClass("wide")) {
            event.preventDefault();

            if (!useDialog) {
                window.location = href;
            }

            $.get(href, function (data) {
                ShowDialog(action, data);
            })
            .fail(function () {
                window.location = href;
            });
        }
        else {
            window.location = href;
        }
    }

    function ParseTrId(id) {
        return id.substring(3);
    }

    $('tr.useContextMenu').contextMenu('myMenu1', {
        bindings: {
            'cmMovePending': function (t) {
                ContextMenuAction("MovePending", ParseTrId(t.id), false);
            },
            'cmEdit': function (t) {
                ContextMenuAction("Edit", ParseTrId(t.id), true);
            },
            'cmDetails': function (t) {
                ContextMenuAction("Details", ParseTrId(t.id), true);
            },
            'cmDelete': function (t) {
                ContextMenuAction("Delete", ParseTrId(t.id), true);
            }
        },
        onShowMenu: function (e, menu) {
            var id = $(e.currentTarget).attr("id");
            if ($("#" + id + " td.colPending").html() == 0) {
                $('#cmMovePending', menu).remove();
            }

            return menu;
        }
    });
    /*End Context Menu*/
});