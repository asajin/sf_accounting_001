var chargeTypeSourceObj = new kendo.data.DataSource({
    transport: {
        create: {
            url: chargesUrlObj.createCharge,
            dataType: "json",
            type: "PUT"
        },
        parameterMap: function(options, operation) {
            if (operation == "create") {
                return {
                    models: kendo.stringify(options.models)
                };
            }
        }
    },
    batch: true,
    schema: {
        model: {
            id: "id",
            fields: {
                name: {type: "string"}
            }
        },
        parse:function (data) {
            $("#chargeNew").data("kendoWindow").close();
            chargesColumns.loadDropdowns(function(){
                  chargesColumns.chargesDropDown.data('kendoDropDownList').setDataSource(chargesColumns.charges);
                  chargesColumns.chargesDropDown.data('kendoDropDownList').refresh();
            });
            return data;
        }
    }
});

$(document).ready(function() {

    kendo.bind($("#chargeForm"), kendo.observable({
        name: "",
        chargeSource: chargeTypeSourceObj,
        save: function() {
            console.log('update');
            this.chargeSource.add({
                name:this.name
            });
            this.chargeSource.sync();
            console.log('success sync');
        },
        cancel: function(e) {
            e.preventDefault();
            $("#chargeNew").data("kendoWindow").close();
        }
    }));

    $("#chargeNew").show();
    $("#chargeNew").kendoWindow({
        visible: false,
        modal: true,
        width: 300,
        title: "Create charge",
        actions: ["Close"]
    });

});