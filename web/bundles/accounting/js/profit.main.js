var profitSourceObj = {
    type: "json",
    transport : {
        read: {
            url:profitUrlObj.read,
            cache: false
        }
    },
    schema: {
        model: {
            fields: {
                month: {type: "date"},
                sale_amount: {type: "number"},
                buy_amount: {type: "number"},
                direct_charges: {type: "number"},
                indirect_charges: {type: "number"},
                profit: {type: "number"}
            }
        }
    },
    pageSize: 10
};

$(document).ready(function() {

    $("#grid").kendoGrid({
        dataSource: profitSourceObj,
        height: 350,
        scrollable: true,
        sortable: true,
        filterable: true,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        columns: [
        {
            field: "Month",
            title: "month",
            width: 30
        },
        {
            field: "Products sales",
            title: "products_sales",
            width: 30
        },
        {
            field: "Products Costs",
            title: "products_costs",
            width: 30
        },
        {
            field: "Direct charges",
            title: "direct_charges",
            width: 30
        },
        {
            field: "Indirect charges",
            title: "indirect_charges",
            width: 30
        },
        {
            field: "Profit",
            title: "profit",
            width: 30
        }
        ]
    });
});

