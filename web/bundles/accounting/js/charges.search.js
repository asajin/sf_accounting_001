var chargesSearch = {

    monthPicker : null,
    monthSearchButton : null,
    grid : null,

    init : function () {
        chargesSearch.monthPicker = $("#monthpicker");
        chargesSearch.monthSearchButton = $('#month_search');
        chargesSearch.grid = $('#grid');
        
        var today = new Date();
        chargesSearch.monthPicker.kendoDatePicker({
            value: today,
            start: "year",
            depth: "year",
            format: "MMMM yyyy"
        });
        
        chargesSearch.monthSearchButton.click(chargesSearch.search);
    },
    
    getFilter : function(priceDateStartValue, priceDateEndValue) {
        var filter = {
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
        return filter;
    },
    
    search : function() {
        var priceDateValue = chargesSearch.monthPicker.data("kendoDatePicker").value();
        
        var monthDate = new Date(priceDateValue);
        
        var nextMonthDate = new Date(priceDateValue);
        nextMonthDate.setMonth(monthDate.getMonth() + 1);
        
        var filter = chargesSearch.getFilter(priceDateValue, nextMonthDate);
        
        chargesSearch.grid.data("kendoGrid").dataSource.filter(filter);
    }
}
