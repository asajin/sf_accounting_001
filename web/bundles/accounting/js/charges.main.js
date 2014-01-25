var chargesGrid = {
    grid : null,
    params : {
        dataSource: chargesSourceObj,
        height: 350,
        scrollable: true,
        sortable: true,
        filterable: false,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        toolbar: ["create"],
        editable: "popup",
        columns: chargesColumns.columns
    }
};

$(document).ready(function() {
    
    chargesGrid.grid = $("#grid");
    chargesGrid.grid.kendoGrid(chargesGrid.params);
    
    chargesSearch.init();
    chargesColumns.init();
});
