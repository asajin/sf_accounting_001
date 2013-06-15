var spSourceObj = {
    type: "json",
    transport : {
        read: spIndexUrlObj.read
    },
    schema: spSchemaObj,
    pageSize: 10,
    group: {
        field: "price_date", 
        aggregates: [{
            field: "amount", 
            aggregate: "sum"
        }]
    },
    aggregate: [{
        field: "amount", 
        aggregate: "sum"
    }]
};

$(document).ready(function() {

    $("#grid").kendoGrid({
        dataSource: spSourceObj,
        height: 500,
        scrollable: true,
        sortable: true,
        filterable: {
            extra: false,
            operators: {
                string: {
                    contains: "Contains"
                }
            }
        },
        pageable: {
            pageSizes: true,
            refresh: true
        },
        columns: spColumnsObj
    });

});