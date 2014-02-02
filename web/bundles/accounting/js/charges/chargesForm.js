var chargesFormOptions = {
    title : "Create charge",
    form : $("#chargeForm"),
    window : $("#chargeNew"),
    url : {
        create : chargesUrlObj.createCharge
    },
    fields : {
        model : {
            name: { type: "string" }
        },
        form : {
            name: ""
        }
    },
    onClose : function(data) {
        chargesColumns.loadDropdowns(function(){
            chargesColumns.chargesDropDown.data('kendoDropDownList').setDataSource(chargesColumns.charges);
            chargesColumns.chargesDropDown.data('kendoDropDownList').refresh();
        });
    }
}

$(document).ready(function() {

    FormBind.init(chargesFormOptions);

});
