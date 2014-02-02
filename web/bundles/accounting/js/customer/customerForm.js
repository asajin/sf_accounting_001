var customerFormOptions = {
    title: "Create Customer",
    form : $("#customerForm"),
    window : $("#customerNew"),
    url : {
        create : saleUrlObj.createCustomer
    },
    fields : {
        model : {
            name: { type: "string" },
            address: { type: "string" },
            telephone: { type: "string" },
            description: { type: "string" }
        },
        form : {
            name: "",
            address: "",
            telephone: "",
            description: ""
        }
    },
    onClose : function(data) {
        newColumnsObj.loadDropdowns(function(){
            newColumnsObj.customersDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.customers);
            newColumnsObj.customersDropdown.data('kendoDropDownList').refresh();
        });
    }
}

$(document).ready(function() {

    FormBind.init(customerFormOptions);

});
