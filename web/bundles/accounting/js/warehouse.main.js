var warehouseSourceObj = {
    serverFiltering: true,
    type: "json",
    transport : {
        read: {
            url:warehouseUrlObj.read,
            cache: false
        }
    },
    schema: {
        model: {
            fields: {
                    product_group: { type: "string", editable: false },
                    code: { type: "string", editable: false },
                    product_name: { type: "string", editable: false },
                    unit: { type: "string", editable: false },
                    price: { type: "number", editable: false },
                    first_stock: { type: "number", editable: false },
                    first_amount: { type: "number", editable: false },
                    first_date: { type: "date", editable: false },
                    income_stock: { type: "number" },
                    income_amount: { type: "number", editable: false },
                    expense_stock: { type: "number" },
                    expense_amount: { type: "number", editable: false },
                    last_stock: { type: "number", editable: false },
                    last_amount: { type: "number", editable: false },
                    last_date: { type: "date", editable: false }
                }
        }
    },
    pageSize: 10
};

function spPriceDateFilterRange(priceDateStartValue, priceDateEndValue) {
    var fieldFilter = {
        logic: 'and',
        filters: [
        {
            field: 'price_date',
            operator: "gte",
            value: priceDateStartValue
        },
        {
            field: 'price_date',
            operator: "lte",
            value: priceDateEndValue
        }
        ]
    };
    $("#grid").data("kendoGrid").dataSource.filter(fieldFilter);
}

$(document).ready(function() {

    var today = new Date();
    $("#monthpicker").kendoDatePicker({
        value: today,
        // defines the start view
        start: "year",

        // defines when the calendar should return date
        depth: "year",

        // display month and year in the input
        format: "MMMM yyyy"
    });

    $('#month_search').click(function(){

//        console.log($("#monthpicker").data("kendoDatePicker").value());

        var priceDateValue = $("#monthpicker").data("kendoDatePicker").value();
        var monthDate = new Date(priceDateValue);
        var nextMonthDate = new Date(priceDateValue);
        nextMonthDate.setMonth(monthDate.getMonth() + 1);

        spPriceDateFilterRange(priceDateValue, nextMonthDate);
    });

    $("#grid").kendoGrid({
        dataSource: warehouseSourceObj,
        height: 500,
        scrollable: true,
        sortable: true,
        filterable: false,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        editable: false,
        columns: [
        {
            field: "product_group",
            title: "Product Group"
        },
        {
            field: "code",
            title: "code",
            width: 70
        },
        {
            field: "product_name",
            title: "Product Name"
        },
        {
            field: "unit"
        },
        {
            field: "first_stock",
            title: "Stock<br>2012/10/31"
        },
        {
            field: "first_amount",
            title: "Amount<br>2012/10/31"
        },
        {
            field: "income_stock",
            title: "Income Stock"
        },
        {
            field: "income_amount",
            title: "Income Amount"
        },
        {
            field: "expense_stock",
            title: "Expense Stock"
        },
        {
            field: "expense_amount",
            title: "Expense Amount"
        },
        {
            field: "last_stock",
            title: "Stock<br>2012/11/30"
        },
        {
            field: "last_amount",
            title: "Amount<br>2012/11/30"
        },
    ]
    });
});


//$(document).ready(function() {
//    var dataSource = createWarehouse(10);
//$("#grid").kendoGrid({
//    dataSource: {
//        data: dataSource,
//        autoSync: true,
//        schema: {
//            model: {
//                fields: {}
//            }
//        },
//        pageSize: 10
//    },
//    height: 500,
//    scrollable: true,
//    //sortable: true,
//    //filterable: true,
//    pageable: {
//        pageSizes: true,
//        refresh: true
//    },
//    editable: false,
//    change: function(arg){
//        var grid = $("#grid").data("kendoGrid");
//        grid.saveRow();
//        grid.refresh();
//        console.log("save & refresh");
//    },
//    columns: []
//});
//});
